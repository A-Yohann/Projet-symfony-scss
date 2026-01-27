<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'Un compte existe déjà avec cet email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateInscription = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $lastLogin = null;

    #[ORM\Column(nullable: true)]
    private ?bool $estCandidat = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $motivation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    #[ORM\Column(nullable: true)]
    private ?bool $cotisationAjour = null;

    #[ORM\OneToMany(targetEntity: Cotisation::class, mappedBy: 'user')]
    private Collection $cotisations;

    #[ORM\OneToMany(targetEntity: PieceHorlogere::class, mappedBy: 'membre')]
    private Collection $pieceHorlogeres;

    #[ORM\OneToMany(targetEntity: ConseilConservation::class, mappedBy: 'auteur')]
    private Collection $conseilConservations;

    public function __construct()
    {
        $this->cotisations = new ArrayCollection();
        $this->pieceHorlogeres = new ArrayCollection();
        $this->conseilConservations = new ArrayCollection();
        $this->dateInscription = new \DateTime();
        $this->estCandidat = true;
        $this->statut = 'en_attente';
        $this->cotisationAjour = false;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        $roles[] = 'ROLE_MEMBRE';

        if ($this->statut === 'actif' && $this->cotisationAjour) {
            $roles[] = 'ROLE_MEMBRE';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // Effacer les données sensibles temporaires
    }

    public function getDateInscription(): ?\DateTime
    {
        return $this->dateInscription;
    }

    public function setDateInscription(?\DateTime $dateInscription): static
    {
        $this->dateInscription = $dateInscription;
        return $this;
    }

    public function getLastLogin(): ?\DateTime
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTime $lastLogin): static
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    public function isEstCandidat(): ?bool
    {
        return $this->estCandidat;
    }

    public function setEstCandidat(?bool $estCandidat): static
    {
        $this->estCandidat = $estCandidat;
        return $this;
    }

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(?string $motivation): static
    {
        $this->motivation = $motivation;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;
        return $this;
    }

    public function isCotisationAjour(): ?bool
    {
        return $this->cotisationAjour;
    }

    public function setCotisationAjour(?bool $cotisationAjour): static
    {
        $this->cotisationAjour = $cotisationAjour;
        return $this;
    }

    public function getCotisations(): Collection
    {
        return $this->cotisations;
    }

    public function addCotisation(Cotisation $cotisation): static
    {
        if (!$this->cotisations->contains($cotisation)) {
            $this->cotisations->add($cotisation);
            $cotisation->setUser($this);
        }
        return $this;
    }

    public function removeCotisation(Cotisation $cotisation): static
    {
        if ($this->cotisations->removeElement($cotisation)) {
            if ($cotisation->getUser() === $this) {
                $cotisation->setUser(null);
            }
        }
        return $this;
    }

    public function getPieceHorlogeres(): Collection
    {
        return $this->pieceHorlogeres;
    }

    public function addPieceHorlogere(PieceHorlogere $pieceHorlogere): static
    {
        if (!$this->pieceHorlogeres->contains($pieceHorlogere)) {
            $this->pieceHorlogeres->add($pieceHorlogere);
            $pieceHorlogere->setMembre($this);
        }
        return $this;
    }

    public function removePieceHorlogere(PieceHorlogere $pieceHorlogere): static
    {
        if ($this->pieceHorlogeres->removeElement($pieceHorlogere)) {
            if ($pieceHorlogere->getMembre() === $this) {
                $pieceHorlogere->setMembre(null);
            }
        }
        return $this;
    }

    public function getConseilConservations(): Collection
    {
        return $this->conseilConservations;
    }

    public function addConseilConservation(ConseilConservation $conseilConservation): static
    {
        if (!$this->conseilConservations->contains($conseilConservation)) {
            $this->conseilConservations->add($conseilConservation);
            $conseilConservation->setAuteur($this);
        }
        return $this;
    }

    public function removeConseilConservation(ConseilConservation $conseilConservation): static
    {
        if ($this->conseilConservations->removeElement($conseilConservation)) {
            if ($conseilConservation->getAuteur() === $this) {
                $conseilConservation->setAuteur(null);
            }
        }
        return $this;
    }
}