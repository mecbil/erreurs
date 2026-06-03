<?php

namespace App\Controller;

use App\Entity\Erreur;
use App\Repository\SousCategorieRepository;
use App\Repository\MatiereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ErreurController extends AbstractController
{
    // ─── AJOUTER ───────────────────────────────────────────────
    #[Route('/erreur/add', name: 'app_erreur_add', methods: ['POST'])]
    public function add(
        Request $request,
        SousCategorieRepository $sousCatRepo,
        MatiereRepository $matiereRepo,
        EntityManagerInterface $em
    ): Response {
        $sousCatId  = $request->request->getInt('sous_categorie_id');
        $matiereId  = $request->request->getInt('matiere_id');
        $erreurTxt  = trim($request->request->get('erreur', ''));
        $correction = trim($request->request->get('correction', ''));
        $statut     = $request->request->get('statut', 'À revoir');
        $revDays    = $request->request->getInt('revision', 1);

        $sousCat = $sousCatRepo->find($sousCatId);

        if ($sousCat && $erreurTxt && $correction) {
            $erreur = new Erreur();
            $erreur->setErreurTxt($erreurTxt);
            $erreur->setCorrectionTxt($correction);
            $erreur->setStatutErr($statut);
            $erreur->setAddedErr(new \DateTimeImmutable());
            $erreur->setRevisionErr(
                (new \DateTimeImmutable())->modify("+{$revDays} days")
            );
            $erreur->setSousCategorie($sousCat);
            $em->persist($erreur);
            $em->flush();
        }

        return $this->redirectToRoute('app_matiere_show', ['id' => $matiereId]);
    }

    // ─── CHANGER STATUT ────────────────────────────────────────
    #[Route('/erreur/{id}/statut/{direction}', name: 'app_erreur_statut', methods: ['POST'])]
    public function statut(
        Erreur $erreur,
        string $direction,
        EntityManagerInterface $em
    ): Response {
        $cycle = ['À revoir', 'En cours', 'Maîtrisé'];
        $current = array_search($erreur->getStatutErr(), $cycle);

        if ($direction === 'up' && $current < 2) {
            $erreur->setStatutErr($cycle[$current + 1]);
        } elseif ($direction === 'down' && $current > 0) {
            $erreur->setStatutErr($cycle[$current - 1]);
        }

        $em->flush();

        return $this->render('erreur/_badge.html.twig', [
            'erreur' => $erreur
        ]);
    }

    // ─── SUPPRIMER ─────────────────────────────────────────────
    #[Route('/erreur/{id}/delete', name: 'app_erreur_delete', methods: ['POST'])]
    public function delete(
        Erreur $erreur,
        EntityManagerInterface $em,
        Request $request
    ): Response {
        $matiereId = $request->request->getInt('matiere_id');
        $em->remove($erreur);
        $em->flush();

        return $this->redirectToRoute('app_matiere_show', ['id' => $matiereId]);
    }

    // ─── RESET MATIÈRE ─────────────────────────────────────────
    #[Route('/matiere/{id}/reset', name: 'app_matiere_reset', methods: ['POST'])]
    public function reset(
        int $id,
        MatiereRepository $matiereRepo,
        EntityManagerInterface $em
    ): Response {
        $matiere = $matiereRepo->find($id);
        if ($matiere) {
            foreach ($matiere->getCategories() as $cat) {
                foreach ($cat->getSousCategories() as $sousCat) {
                    foreach ($sousCat->getErreurs() as $erreur) {
                        $em->remove($erreur);
                    }
                }
            }
            $em->flush();
        }

        return $this->redirectToRoute('app_matiere_show', ['id' => $id]);
    }

    #[Route('/matiere/{id}/erreurs', name: 'app_erreur_filtre')]
    public function filtre(
        int $id,
        Request $request,
        MatiereRepository $matiereRepo
    ): Response {
        $matiere = $matiereRepo->find($id);
        $filtre = $request->query->get('filtre', 'all');

        return $this->render('erreur/_liste_filtree.html.twig', [
            'matiere' => $matiere,
            'filtre' => $filtre
        ]);
    }
    }