<?php

namespace App\Entity;

use App\Repository\MecanismeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MecanismeRepository::class)]
class Mecanisme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $complexite = null;



    /**
     * @var Collection<int, PieceHorlogere>
     */
    #[ORM\ManyToMany(targetEntity: PieceHorlogere::class, mappedBy: 'mecanismes')]
    private Collection $pieceHorlogeres;

    /**
     * @var Collection<int, CategorieHorloge>
     */
    #[ORM\OneToMany(targetEntity: CategorieHorloge::class, mappedBy: 'mecanisme')]
    private Collection $categorieHorloges;

    public function __construct()
    {
        $this->pieceHorlogeres = new ArrayCollection();
        $this->categorieHorloges = new ArrayCollection();
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

    public function getComplexite(): ?string
    {
        return $this->complexite;
    }

    public function setComplexite(string $complexite): static
    {
        $this->complexite = $complexite;
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
            $pieceHorlogere->addMecanisme($this);
        }
        return $this;
    }

    public function removePieceHorlogere(PieceHorlogere $pieceHorlogere): static
    {
        if ($this->pieceHorlogeres->removeElement($pieceHorlogere)) {
            $pieceHorlogere->removeMecanisme($this);
        }
        return $this;
    }

    /**
     * @return Collection<int, CategorieHorloge>
     */
    public function getCategorieHorloges(): Collection
    {
        return $this->categorieHorloges;
    }

    public function addCategorieHorloge(CategorieHorloge $categorieHorloge): static
    {
        if (!$this->categorieHorloges->contains($categorieHorloge)) {
            $this->categorieHorloges->add($categorieHorloge);
            $categorieHorloge->setMecanisme($this);
        }

        return $this;
    }

    public function removeCategorieHorloge(CategorieHorloge $categorieHorloge): static
    {
        if ($this->categorieHorloges->removeElement($categorieHorloge)) {
            // set the owning side to null (unless already changed)
            if ($categorieHorloge->getMecanisme() === $this) {
                $categorieHorloge->setMecanisme(null);
            }
        }

        return $this;
    }
}