<?php

namespace App\Entity;

use App\Repository\MotifRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotifRepository::class)]
class Motif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $raison = null;

    /**
     * @var Collection<int, Journal>
     */
    #[ORM\OneToMany(targetEntity: Journal::class, mappedBy: 'libelle')]
    private Collection $journals;

    public function __construct()
    {
        $this->journals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaison(): ?string
    {
        return $this->raison;
    }

    public function setRaison(string $raison): static
    {
        $this->raison = $raison;

        return $this;
    }

    /**
     * @return Collection<int, Journal>
     */
    public function getJournals(): Collection
    {
        return $this->journals;
    }

    public function addJournal(Journal $journal): static
    {
        if (!$this->journals->contains($journal)) {
            $this->journals->add($journal);
            $journal->setLibelle($this);
        }

        return $this;
    }

    public function removeJournal(Journal $journal): static
    {
        if ($this->journals->removeElement($journal)) {
            // set the owning side to null (unless already changed)
            if ($journal->getLibelle() === $this) {
                $journal->setLibelle(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->raison; // ou $this->libelle selon le champ que tu veux afficher
    }
}
