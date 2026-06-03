<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Matiere;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MatiereRepository;

final class CategorieController extends AbstractController
{
    #[Route('/categorie/add', name: 'app_categorie_add', methods: ['POST'])]
    public function add(
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $nom = trim($request->request->get('nom', ''));
        $matiereId = $request->request->get('matiere_id');

        if ($nom && $matiereId) {
            $matiere = $em->getReference(Matiere::class, $matiereId);
            $categorie = new Categorie();
            $categorie->setNomCat($nom);
            $categorie->setMatiere($matiere);
            $em->persist($categorie);
            $em->flush();
        }

        return $this->redirectToRoute('app_matiere_show', ['id' => $matiereId]);
    }

    #[Route('/categorie/{id}/edit', name: 'app_categorie_edit', methods: ['POST'])]
    public function edit(
        Categorie $categorie,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $nom = trim($request->request->get('nom', ''));

        if ($nom) {
            $categorie->setNomCat($nom);
            $em->flush();
        }

        return $this->redirectToRoute('app_matiere_show', ['id' => $categorie->getMatiere()->getId()]);
    }

    #[Route('/categorie/{id}/delete', name: 'app_categorie_delete', methods: ['POST'])]
    public function delete(
        Categorie $categorie,
        EntityManagerInterface $em
    ): Response {
        $matiereId = $categorie->getMatiere()->getId();
        $em->remove($categorie);
        $em->flush();

        return $this->redirectToRoute('app_matiere_show', ['id' => $matiereId]);
    }

    #[Route('/categorie/{id}/form', name: 'app_categorie_form')]
    public function form(
        int $id,
        Request $request,
        CategorieRepository $categorieRepository,
        EntityManagerInterface $em
    ): Response {
        if ($id === 0) {
            $categorie = new Categorie();
            $matiereId = $request->query->get('matiere_id');
            if ($matiereId) {
                $matiere = $em->getReference(Matiere::class, $matiereId);
                $categorie->setMatiere($matiere);
            }
        } else {
            $categorie = $categorieRepository->find($id);
        }

        return $this->render('categorie/_form.html.twig', [
            'categorie' => $categorie,
        ]);
    }
    #[Route('/categories', name: 'app_categories')]
    public function index(MatiereRepository $matiereRepository): Response
    {
        return $this->render('categorie/index.html.twig', [
            'matieres' => $matiereRepository->findAll(),
        ]);
    }

    #[Route('/categorie/{id}/erreurs', name: 'app_categorie_erreurs')]
    public function erreurs(Categorie $categorie): Response
    {
        return $this->render('categorie/erreurs.html.twig', [
            'categorie' => $categorie,
        ]);
    }
}