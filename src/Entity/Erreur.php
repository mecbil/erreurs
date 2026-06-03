<?php

namespace App\Entity;

use App\Repository\ErreurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ErreurRepository::class)]
class Erreur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $erreurTxt = null;

    #[ORM\Column(length: 500)]
    private ?string $correctionTxt = null;

    #[ORM\Column(length: 20)]
    private ?string $statutErr = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $addedErr = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $revisionErr = null;

    #[ORM\ManyToOne(inversedBy: 'erreurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SousCategorie $sousCategorie = null;

    public function getId(): ?int { return $this->id; }

    public function getErreurTxt(): ?string { return $this->erreurTxt; }
    public function setErreurTxt(string $erreurTxt): static { $this->erreurTxt = $erreurTxt; return $this; }

    public function getCorrectionTxt(): ?string { return $this->correctionTxt; }
    public function setCorrectionTxt(string $correctionTxt): static { $this->correctionTxt = $correctionTxt; return $this; }

    public function getStatutErr(): ?string { return $this->statutErr; }
    public function setStatutErr(string $statutErr): static { $this->statutErr = $statutErr; return $this; }

    public function getAddedErr(): ?\DateTimeImmutable { return $this->addedErr; }
    public function setAddedErr(\DateTimeImmutable $addedErr): static { $this->addedErr = $addedErr; return $this; }

    public function getRevisionErr(): ?\DateTimeImmutable { return $this->revisionErr; }
    public function setRevisionErr(?\DateTimeImmutable $revisionErr): static { $this->revisionErr = $revisionErr; return $this; }

    public function getSousCategorie(): ?SousCategorie { return $this->sousCategorie; }
    public function setSousCategorie(?SousCategorie $sousCategorie): static { $this->sousCategorie = $sousCategorie; return $this; }
}