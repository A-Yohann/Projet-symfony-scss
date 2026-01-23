<?php

namespace App\Entity;

use App\Repository\PieceHorlogereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceHorlogereRepository::class)]
class PieceHorlogere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $anneeFabrication = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column]
    private ?\DateTime $createAt = null;

    #[ORM\ManyToOne(inversedBy: 'pieceHorlogeres')]
    private ?User $membre = null;

    #[ORM\ManyToOne(inversedBy: 'pieceHorlogeres')]
    private ?CategorieHorloge $categorie = null;

    /**
     * @var Collection<int, Mecanisme>
     */
    #[ORM\ManyToMany(targetEntity: Mecanisme::class, inversedBy: 'pieceHorlogeres')]
    private Collection $mecanismes;

    public function __construct()
    {
        $this->mecanismes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

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

    public function getAnneeFabrication(): ?int
    {
        return $this->anneeFabrication;
    }

    public function setAnneeFabrication(int $anneeFabrication): static
    {
        $this->anneeFabrication = $anneeFabrication;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getCreateAt(): ?\DateTime
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTime $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getMembre(): ?User
    {
        return $this->membre;
    }

    public function setMembre(?User $membre): static
    {
        $this->membre = $membre;

        return $this;
    }

    public function getCategorie(): ?CategorieHorloge
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieHorloge $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Mecanisme>
     */
    public function getMecanismes(): Collection
    {
        return $this->mecanismes;
    }

    public function addMecanisme(Mecanisme $mecanisme): static
    {
        if (!$this->mecanismes->contains($mecanisme)) {
            $this->mecanismes->add($mecanisme);
        }

        return $this;
    }

    public function removeMecanisme(Mecanisme $mecanisme): static
    {
        $this->mecanismes->removeElement($mecanisme);

        return $this;
    }
}
