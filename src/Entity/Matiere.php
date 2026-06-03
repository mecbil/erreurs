<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomMat = null;

    #[ORM\Column(length: 7)]
    private ?string $couleurMat = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\OneToMany(targetEntity: Categorie::class, mappedBy: 'matiere', orphanRemoval: true)]
    private Collection $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getNomMat(): ?string { return $this->nomMat; }
    public function setNomMat(string $nomMat): static { $this->nomMat = $nomMat; return $this; }

    public function getCouleurMat(): ?string { return $this->couleurMat; }
    public function setCouleurMat(string $couleurMat): static { $this->couleurMat = $couleurMat; return $this; }

    public function getCategories(): Collection { return $this->categories; }

    public function addCategory(Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setMatiere($this);
        }
        return $this;
    }

    public function removeCategory(Categorie $category): static
    {
        if ($this->categories->removeElement($category)) {
            if ($category->getMatiere() === $this) {
                $category->setMatiere(null);
            }
        }
        return $this;
    }
}