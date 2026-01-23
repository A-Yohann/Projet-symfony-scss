<?php

namespace App\Entity;

use App\Repository\CategorieHorlogeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieHorlogeRepository::class)]
class CategorieHorloge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, PieceHorlogere>
     */
    #[ORM\OneToMany(targetEntity: PieceHorlogere::class, mappedBy: 'categorie')]
    private Collection $pieceHorlogeres;

    /**
     * @var Collection<int, ConseilConservation>
     */
    #[ORM\OneToMany(targetEntity: ConseilConservation::class, mappedBy: 'categorie')]
    private Collection $conseilConservations;

    public function __construct()
    {
        $this->pieceHorlogeres = new ArrayCollection();
        $this->conseilConservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, PieceHorlogere>
     */
    public function getPieceHorlogeres(): Collection
    {
        return $this->pieceHorlogeres;
    }

    public function addPieceHorlogere(PieceHorlogere $pieceHorlogere): static
    {
        if (!$this->pieceHorlogeres->contains($pieceHorlogere)) {
            $this->pieceHorlogeres->add($pieceHorlogere);
            $pieceHorlogere->setCategorie($this);
        }

        return $this;
    }

    public function removePieceHorlogere(PieceHorlogere $pieceHorlogere): static
    {
        if ($this->pieceHorlogeres->removeElement($pieceHorlogere)) {
            // set the owning side to null (unless already changed)
            if ($pieceHorlogere->getCategorie() === $this) {
                $pieceHorlogere->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ConseilConservation>
     */
    public function getConseilConservations(): Collection
    {
        return $this->conseilConservations;
    }

    public function addConseilConservation(ConseilConservation $conseilConservation): static
    {
        if (!$this->conseilConservations->contains($conseilConservation)) {
            $this->conseilConservations->add($conseilConservation);
            $conseilConservation->setCategorie($this);
        }

        return $this;
    }

    public function removeConseilConservation(ConseilConservation $conseilConservation): static
    {
        if ($this->conseilConservations->removeElement($conseilConservation)) {
            // set the owning side to null (unless already changed)
            if ($conseilConservation->getCategorie() === $this) {
                $conseilConservation->setCategorie(null);
            }
        }

        return $this;
    }
}
