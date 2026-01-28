<?php

namespace App\Entity;

use App\Repository\CategorieHorlogeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

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

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'categorieHorloge')]
    private Collection $comments;

    public function __construct()
    {
        $this->pieceHorlogeres = new ArrayCollection();
        $this->conseilConservations = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    // --------------------
    // ID
    // --------------------
    public function getId(): ?int
    {
        return $this->id;
    }

    // --------------------
    // Nom
    // --------------------
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    // --------------------
    // Description
    // --------------------
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    // --------------------
    // Image
    // --------------------
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;
        return $this;
    }

    // --------------------
    // User (propriétaire)
    // --------------------
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;
        return $this;
    }

    // --------------------
    // PieceHorlogere
    // --------------------
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
            if ($pieceHorlogere->getCategorie() === $this) {
                $pieceHorlogere->setCategorie(null);
            }
        }
        return $this;
    }

    // --------------------
    // ConseilConservation
    // --------------------
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
            if ($conseilConservation->getCategorie() === $this) {
                $conseilConservation->setCategorie(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setCategorieHorloge($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCategorieHorloge() === $this) {
                $comment->setCategorieHorloge(null);
            }
        }

        return $this;
    }
}
