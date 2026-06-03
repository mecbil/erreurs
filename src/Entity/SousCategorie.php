<?php

namespace App\Entity;

use App\Repository\SousCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousCategorieRepository::class)]
class SousCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomSousCat = null;

    #[ORM\ManyToOne(inversedBy: 'sousCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    /**
     * @var Collection<int, Erreur>
     */
    #[ORM\OneToMany(targetEntity: Erreur::class, mappedBy: 'sousCategorie', orphanRemoval: true)]
    private Collection $erreurs;

    public function __construct()
    {
        $this->erreurs = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getNomSousCat(): ?string { return $this->nomSousCat; }
    public function setNomSousCat(string $nomSousCat): static { $this->nomSousCat = $nomSousCat; return $this; }

    public function getCategorie(): ?Categorie { return $this->categorie; }
    public function setCategorie(?Categorie $categorie): static { $this->categorie = $categorie; return $this; }

    public function getErreurs(): Collection { return $this->erreurs; }

    public function addErreur(Erreur $erreur): static
    {
        if (!$this->erreurs->contains($erreur)) {
            $this->erreurs->add($erreur);
            $erreur->setSousCategorie($this);
        }
        return $this;
    }

    public function removeErreur(Erreur $erreur): static
    {
        if ($this->erreurs->removeElement($erreur)) {
            if ($erreur->getSousCategorie() === $this) {
                $erreur->setSousCategorie(null);
            }
        }
        return $this;
    }
}