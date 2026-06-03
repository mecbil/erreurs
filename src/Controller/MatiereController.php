<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Repository\MatiereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MatiereController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(MatiereRepository $matiereRepository): Response
    {
        $matieres = $matiereRepository->findAll();

        return $this->render('matiere/index.html.twig', [
            'matieres' => $matieres,
        ]);
    }

    #[Route('/matiere/{id}', name: 'app_matiere_show')]
    public function show(Matiere $matiere): Response
    {
        return $this->render('matiere/show.html.twig', [
            'matiere' => $matiere,
        ]);
    }

    #[Route('/matiere/add', name: 'app_matiere_add', methods: ['POST'])]
    public function add(
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $nom = trim($request->request->get('nom', ''));
        $couleur = $request->request->get('couleur', '#ffffff');

        if ($nom) {
            $matiere = new Matiere();
            $matiere->setNomMat($nom);
            $matiere->setCouleurMat($couleur);
            $em->persist($matiere);
            $em->flush();
        }

        return $this->redirectToRoute('app_accueil');
    }

    #[Route('/matiere/{id}/edit', name: 'app_matiere_edit', methods: ['POST'])]
    public function edit(
        Matiere $matiere,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $nom = trim($request->request->get('nom', ''));
        $couleur = $request->request->get('couleur', $matiere->getCouleurMat());

        if ($nom) {
            $matiere->setNomMat($nom);
            $matiere->setCouleurMat($couleur);
            $em->flush();
        }

        return $this->redirectToRoute('app_accueil');
    }

    #[Route('/matiere/{id}/delete', name: 'app_matiere_delete', methods: ['POST'])]
    public function delete(
        Matiere $matiere,
        EntityManagerInterface $em
    ): Response {
        $em->remove($matiere);
        $em->flush();

        return $this->redirectToRoute('app_accueil');
    }

    #[Route('/matiere/{id}/form', name: 'app_matiere_form')]
    public function form(Matiere $matiere): Response
    {
        return $this->render('matiere/_form.html.twig', [
            'matiere' => $matiere,
        ]);
    }
}