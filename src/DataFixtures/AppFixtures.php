<?php

namespace App\DataFixtures;

use App\Entity\Matiere;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                'nomMat'    => 'Français',
                'couleurMat'=> '#c8a96e',
                'categories'=> [
                    [
                        'nomCat' => 'Homophones',
                        'sousCategories' => [
                            'a / à',
                            'on / ont',
                            'son / sont',
                            'ou / où',
                            'ce / se',
                            'mes / mais / met / mets',
                            'sans / sang / sent / s\'en',
                            'peu / peut / peux',
                            'si / s\'y',
                            'ni / n\'y',
                            'quand / quant / qu\'en',
                            'davantage / d\'avantage',
                        ],
                    ],
                    [
                        'nomCat' => 'Accord du verbe',
                        'sousCategories' => [
                            'Accord sujet-verbe simple',
                            'Accord avec sujet inversé',
                            'Accord avec sujet collectif',
                            'Accord avec "on"',
                            'Accord avec plusieurs sujets',
                        ],
                    ],
                    [
                        'nomCat' => 'Accord du participe passé',
                        'sousCategories' => [
                            'Avec être',
                            'Avec avoir (COD avant)',
                            'Avec avoir (COD après)',
                            'Verbes pronominaux',
                        ],
                    ],
                    [
                        'nomCat' => 'Conjugaison',
                        'sousCategories' => [
                            'Présent de l\'indicatif',
                            'Imparfait',
                            'Passé composé',
                            'Futur simple',
                            'Conditionnel présent',
                            'Subjonctif présent',
                            'Infinitif / participe présent',
                            '-er / -é / -ée (confusion)',
                        ],
                    ],
                    [
                        'nomCat' => 'Orthographe lexicale',
                        'sousCategories' => [
                            'Doublement de consonne',
                            'Accents (é / è / ê)',
                            'Mots invariables mal orthographiés',
                            'Confusion c / s / ss / ç',
                            'Confusion g / gu / ge',
                        ],
                    ],
                    [
                        'nomCat' => 'Ponctuation & syntaxe',
                        'sousCategories' => [
                            'Virgule manquante ou mal placée',
                            'Point oublié',
                            'Majuscule manquante',
                            'Phrase sans verbe',
                            'Phrase trop longue / mal construite',
                        ],
                    ],
                    [
                        'nomCat' => 'Accords dans le groupe nominal',
                        'sousCategories' => [
                            'Accord adjectif / nom',
                            'Accord déterminant / nom',
                            'Pluriel des noms composés',
                        ],
                    ],
                ],
            ],
            [
                'nomMat'    => 'Maths',
                'couleurMat'=> '#5a9fd4',
                'categories'=> [
                    [
                        'nomCat' => 'Numération & calcul',
                        'sousCategories' => [
                            'Fractions (simplification)',
                            'Fractions (opérations)',
                            'Nombres décimaux',
                            'Priorités opératoires',
                            'Puissances',
                            'Racines carrées',
                        ],
                    ],
                    [
                        'nomCat' => 'Algèbre',
                        'sousCategories' => [
                            'Développement / factorisation',
                            'Équations du 1er degré',
                            'Équations du 2e degré',
                            'Inéquations',
                            'Systèmes d\'équations',
                        ],
                    ],
                    [
                        'nomCat' => 'Géométrie plane',
                        'sousCategories' => [
                            'Théorème de Pythagore',
                            'Théorème de Thalès',
                            'Trigonométrie',
                            'Aires et périmètres',
                            'Angles',
                        ],
                    ],
                    [
                        'nomCat' => 'Géométrie dans l\'espace',
                        'sousCategories' => [
                            'Volumes (calcul)',
                            'Patrons',
                            'Sections de solides',
                        ],
                    ],
                    [
                        'nomCat' => 'Statistiques & probabilités',
                        'sousCategories' => [
                            'Moyenne / médiane / étendue',
                            'Diagrammes',
                            'Probabilités simples',
                            'Probabilités conditionnelles',
                        ],
                    ],
                    [
                        'nomCat' => 'Fonctions',
                        'sousCategories' => [
                            'Fonction affine',
                            'Fonction carré / racine',
                            'Lecture de graphique',
                            'Tableau de valeurs',
                        ],
                    ],
                    [
                        'nomCat' => 'Vocabulaire mathématique',
                        'sousCategories' => [
                            'Termes de géométrie',
                            'Termes d\'algèbre',
                            'Termes de statistiques',
                            'Notations ensemblistes',
                        ],
                    ],
                ],
            ],
            [
                'nomMat'    => 'Sciences',
                'couleurMat'=> '#7c6fcd',
                'categories'=> [
                    [
                        'nomCat' => 'Biologie',
                        'sousCategories' => [
                            'Cellule et organites',
                            'Reproduction',
                            'Photosynthèse',
                            'Chaînes alimentaires',
                            'Corps humain',
                        ],
                    ],
                    [
                        'nomCat' => 'Physique',
                        'sousCategories' => [
                            'Forces et mouvements',
                            'Électricité',
                            'Optique',
                            'Énergie',
                        ],
                    ],
                    [
                        'nomCat' => 'Chimie',
                        'sousCategories' => [
                            'Atomes et molécules',
                            'Réactions chimiques',
                            'États de la matière',
                            'Solutions et mélanges',
                        ],
                    ],
                    [
                        'nomCat' => 'Sciences de la Terre',
                        'sousCategories' => [
                            'Tectonique des plaques',
                            'Roches et minéraux',
                            'Météorologie',
                            'Écosystèmes',
                        ],
                    ],
                ],
            ],
            [
                'nomMat'    => 'Techno',
                'couleurMat'=> '#ba6fa0',
                'categories'=> [
                    [
                        'nomCat' => 'Matériaux',
                        'sousCategories' => [
                            'Propriétés des matériaux',
                            'Matériaux métalliques',
                            'Matériaux plastiques',
                            'Matériaux composites',
                        ],
                    ],
                    [
                        'nomCat' => 'Structures et mécanismes',
                        'sousCategories' => [
                            'Liaisons mécaniques',
                            'Chaînes d\'énergie',
                            'Chaînes d\'information',
                        ],
                    ],
                    [
                        'nomCat' => 'Numérique',
                        'sousCategories' => [
                            'Algorithmique de base',
                            'Réseaux informatiques',
                            'Objets connectés',
                        ],
                    ],
                ],
            ],
            [
                'nomMat'    => 'Histoire',
                'couleurMat'=> '#c87c4a',
                'categories'=> [
                    [
                        'nomCat' => 'Chronologie',
                        'sousCategories' => [
                            'Dates clés Antiquité',
                            'Dates clés Moyen-Âge',
                            'Dates clés Époque moderne',
                            'Dates clés Époque contemporaine',
                        ],
                    ],
                    [
                        'nomCat' => 'Vocabulaire historique',
                        'sousCategories' => [
                            'Régimes politiques',
                            'Termes économiques',
                            'Termes sociaux',
                            'Institutions',
                        ],
                    ],
                    [
                        'nomCat' => 'Événements & personnages',
                        'sousCategories' => [
                            'Révolution française',
                            'Guerres mondiales',
                            'Décolonisation',
                            'Construction européenne',
                        ],
                    ],
                ],
            ],
            [
                'nomMat'    => 'Géographie',
                'couleurMat'=> '#6fba8a',
                'categories'=> [
                    [
                        'nomCat' => 'Cartographie',
                        'sousCategories' => [
                            'Lecture de carte',
                            'Echelles',
                            'Légendes',
                        ],
                    ],
                    [
                        'nomCat' => 'Géographie humaine',
                        'sousCategories' => [
                            'Mondialisation',
                            'Migrations',
                            'Urbanisation',
                            'Développement durable',
                        ],
                    ],
                    [
                        'nomCat' => 'Géographie physique',
                        'sousCategories' => [
                            'Reliefs',
                            'Climat',
                            'Hydrographie',
                        ],
                    ],
                ],
            ],
            [
                'nomMat'    => 'EMC',
                'couleurMat'=> '#c8a96e',
                'categories'=> [
                    [
                        'nomCat' => 'Valeurs républicaines',
                        'sousCategories' => [
                            'Liberté',
                            'Égalité',
                            'Fraternité',
                            'Laïcité',
                        ],
                    ],
                    [
                        'nomCat' => 'Institutions',
                        'sousCategories' => [
                            'République française',
                            'Union européenne',
                            'Droits de l\'Homme',
                        ],
                    ],
                    [
                        'nomCat' => 'Citoyenneté',
                        'sousCategories' => [
                            'Droits et devoirs',
                            'Vie démocratique',
                            'Engagement citoyen',
                        ],
                    ],
                ],
            ],
            [
                'nomMat'    => 'Anglais',
                'couleurMat'=> '#6fba8a',
                'categories'=> [
                    [
                        'nomCat' => 'Grammaire',
                        'sousCategories' => [
                            'Temps verbaux',
                            'Modaux',
                            'Passif',
                            'Discours indirect',
                            'Conditionnels',
                        ],
                    ],
                    [
                        'nomCat' => 'Vocabulaire',
                        'sousCategories' => [
                            'Faux-amis',
                            'Prépositions',
                            'Phrasal verbs',
                            'Connecteurs logiques',
                        ],
                    ],
                    [
                        'nomCat' => 'Orthographe anglaise',
                        'sousCategories' => [
                            'Mots fréquemment mal orthographiés',
                            'Confusion their / there / they\'re',
                            'Confusion its / it\'s',
                        ],
                    ],
                ],
            ],
            [
                'nomMat'    => 'EPS',
                'couleurMat'=> '#c87c4a',
                'categories'=> [
                    [
                        'nomCat' => 'Didactique EPS',
                        'sousCategories' => [
                            'Compétences motrices',
                            'APSA (définitions)',
                            'Évaluation en EPS',
                            'Sécurité',
                        ],
                    ],
                    [
                        'nomCat' => 'Programmes EPS',
                        'sousCategories' => [
                            'Cycle 1',
                            'Cycle 2',
                            'Cycle 3',
                        ],
                    ],
                ],
            ],
            [
                'nomMat'    => 'CSE',
                'couleurMat'=> '#7c6fcd',
                'categories'=> [
                    [
                        'nomCat' => 'Connaissance du système éducatif',
                        'sousCategories' => [
                            'Organisation de l\'Éducation nationale',
                            'Rôle du professeur des écoles',
                            'Parcours de l\'élève',
                            'Partenaires de l\'école',
                        ],
                    ],
                    [
                        'nomCat' => 'Textes officiels',
                        'sousCategories' => [
                            'Loi pour l\'École',
                            'Socle commun',
                            'Programmes du cycle 1/2/3',
                            'Règlement intérieur',
                        ],
                    ],
                    [
                        'nomCat' => 'Inclusion & besoins particuliers',
                        'sousCategories' => [
                            'PAP / PPS / PAI',
                            'ULIS',
                            'Élèves à haut potentiel',
                            'Élèves allophones',
                        ],
                    ],
                ],
            ],
        ];

        foreach ($data as $matiereData) {
            $matiere = new Matiere();
            $matiere->setNomMat($matiereData['nomMat']);
            $matiere->setCouleurMat($matiereData['couleurMat']);
            $manager->persist($matiere);

            foreach ($matiereData['categories'] as $catData) {
                $categorie = new Categorie();
                $categorie->setNomCat($catData['nomCat']);
                $categorie->setMatiere($matiere);
                $manager->persist($categorie);

                foreach ($catData['sousCategories'] as $sousCatNom) {
                    $sousCategorie = new SousCategorie();
                    $sousCategorie->setNomSousCat($sousCatNom);
                    $sousCategorie->setCategorie($categorie);
                    $manager->persist($sousCategorie);
                }
            }
        }

        $manager->flush();
    }
}
