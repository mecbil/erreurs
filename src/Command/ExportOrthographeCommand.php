<?php

namespace App\Command;

use App\Repository\CategorieRepository;
use App\Repository\ErreurRepository;
use App\Repository\MatiereRepository;
use App\Repository\SousCategorieRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:export-orthographe',
    description: 'Exporte la structure et les données pour Open Web UI',
)]
class ExportOrthographeCommand extends Command
{
    public function __construct(
        private MatiereRepository $matiereRepo,
        private CategorieRepository $categorieRepo,
        private SousCategorieRepository $sousCategorieRepo,
        private ErreurRepository $erreurRepo,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $matieres       = $this->matiereRepo->findAll();
        $categories     = $this->categorieRepo->findAll();
        $sousCategories = $this->sousCategorieRepo->findAll();
        $erreurs        = $this->erreurRepo->findAll();

        $export = [
            'matieres' => array_map(fn($m) => [
                'id'      => $m->getId(),
                'nom'     => $m->getNomMat(),
                'couleur' => $m->getCouleurMat(),
            ], $matieres),

            'categories' => array_map(fn($c) => [
                'id'      => $c->getId(),
                'nom'     => $c->getNomCat(),
                'matiere' => $c->getMatiere()?->getNomMat(),
            ], $categories),

            'sous_categories' => array_map(fn($s) => [
                'id'        => $s->getId(),
                'nom'       => $s->getNomSousCat(),
                'categorie' => $s->getCategorie()?->getNomCat(),
                'matiere'   => $s->getCategorie()?->getMatiere()?->getNomMat(),
            ], $sousCategories),

            'erreurs' => array_map(fn($e) => [
                'id'                 => $e->getId(),
                'erreur'             => $e->getErreurTxt(),
                'correction'         => $e->getCorrectionTxt(),
                'statut'             => $e->getStatutErr(),
                'date_ajout'         => $e->getAddedErr()?->format('Y-m-d'),
                'prochaine_revision' => $e->getRevisionErr()?->format('Y-m-d'),
                'sous_categorie'     => $e->getSousCategorie()?->getNomSousCat(),
                'categorie'          => $e->getSousCategorie()?->getCategorie()?->getNomCat(),
                'matiere'            => $e->getSousCategorie()?->getCategorie()?->getMatiere()?->getNomMat(),
            ], $erreurs),
        ];

        $json   = json_encode($export, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $chemin = __DIR__ . '/../../export_orthographe.json';
        file_put_contents($chemin, $json);

        $io->success('Export généré : export_orthographe.json');
        $io->table(
            ['Table', 'Nombre'],
            [
                ['Matières',        count($matieres)],
                ['Catégories',      count($categories)],
                ['Sous-catégories', count($sousCategories)],
                ['Erreurs',         count($erreurs)],
            ]
        );

        return Command::SUCCESS;
    }
}