<?php

namespace App\Controller;

use App\Entity\SousCategorie;
use App\Entity\Categorie;
use App\Repository\SousCategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SousCategorieController extends AbstractController
{
    #[Route('/sous_categorie/add', name: 'app_souscategorie_add', methods: ['POST'])]
    public function add(
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $nom = trim($request->request->get('nom', ''));
        $categorieId = $request->request->get('categorie_id');
        $matiereId = $request->request->get('matiere_id');

        if ($nom && $categorieId) {
            $categorie = $em->getReference(Categorie::class, $categorieId);
            $sousCat = new SousCategorie();
            $sousCat->setNomSousCat($nom);
            $sousCat->setCategorie($categorie);
            $em->persist($sousCat);
            $em->flush();
        }

        return $this->redirectToRoute('app_matiere_show', ['id' => $matiereId]);
    }

    #[Route('/sous_categorie/{id}/edit', name: 'app_souscategorie_edit', methods: ['POST'])]
    public function edit(
        SousCategorie $sousCategorie,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $nom = trim($request->request->get('nom', ''));

        if ($nom) {
            $sousCategorie->setNomSousCat($nom);
            $em->flush();
        }

        $matiereId = $sousCategorie->getCategorie()->getMatiere()->getId();
        return $this->redirectToRoute('app_matiere_show', ['id' => $matiereId]);
    }

    #[Route('/sous_categorie/{id}/delete', name: 'app_souscategorie_delete', methods: ['POST'])]
    public function delete(
        SousCategorie $sousCategorie,
        EntityManagerInterface $em
    ): Response {
        $matiereId = $sousCategorie->getCategorie()->getMatiere()->getId();
        $em->remove($sousCategorie);
        $em->flush();

        return $this->redirectToRoute('app_matiere_show', ['id' => $matiereId]);
    }

    #[Route('/sous_categorie/{id}/form', name: 'app_souscategorie_form')]
    public function form(
        int $id,
        Request $request,
        SousCategorieRepository $sousCategorieRepository,
        EntityManagerInterface $em
    ): Response {
        if ($id === 0) {
            $sousCategorie = new SousCategorie();
            $categorieId = $request->query->get('categorie_id');
            $matiereId = $request->query->get('matiere_id');
            if ($categorieId) {
                $categorie = $em->getReference(Categorie::class, $categorieId);
                $sousCategorie->setCategorie($categorie);
            }
        } else {
            $sousCategorie = $sousCategorieRepository->find($id);
        }

        return $this->render('sous_categorie/_form.html.twig', [
            'sousCategorie' => $sousCategorie,
            'matiereId' => $request->query->get('matiere_id') ?? $sousCategorie->getCategorie()->getMatiere()->getId(),
        ]);
    }
}