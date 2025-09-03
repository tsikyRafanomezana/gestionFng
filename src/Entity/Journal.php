<?php

namespace App\Entity;

use App\Repository\JournalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JournalRepository::class)]
class Journal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateJournal = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 4)]
    private ?float $montant = null;

    #[ORM\ManyToOne(inversedBy: 'journals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Motif $libelle = null;

    #[ORM\Column(length: 100)]
    private ?string $typeJournal = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateJournal(): ?\DateTime
    {
        return $this->dateJournal;
    }

    public function setDateJournal(\DateTime $dateJournal): static
    {
        $this->dateJournal = $dateJournal;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getLibelle(): ?Motif
    {
        return $this->libelle;
    }

    public function setLibelle(?Motif $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getTypeJournal(): ?string
    {
        return $this->typeJournal;
    }

    public function setTypeJournal(string $typeJournal): static
    {
        $this->typeJournal = $typeJournal;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
