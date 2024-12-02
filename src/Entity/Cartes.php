<?php

namespace App\Entity;

use App\Repository\CartesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartesRepository::class)]
class Cartes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $idCarte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFinPrevu = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etat = null;

    /**
     * @var Collection<int, tags>
     */
    #[ORM\ManyToMany(targetEntity: Tags::class, mappedBy: 'idCartes')]
    private Collection $tags;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'cartes')]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'cartes')]
    private ?Colonnes $colonnes = null;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCarte(): ?int
    {
        return $this->idCarte;
    }

    public function setIdCarte(?int $idCarte): static
    {
        $this->idCarte = $idCarte;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateFinPrevu(): ?\DateTimeInterface
    {
        return $this->dateFinPrevu;
    }

    public function setDateFinPrevu(?\DateTimeInterface $dateFinPrevu): static
    {
        $this->dateFinPrevu = $dateFinPrevu;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection<int, tags>
     */
    public function getIdTags(): Collection
    {
        return $this->tags;
    }

    public function addIdTag(Tags $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addIdCarte($this);
        }

        return $this;
    }

    public function removeIdTag(Tags $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeIdCarte($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }

    public function getColonnes(): ?Colonnes
    {
        return $this->colonnes;
    }

    public function setColonnes(?Colonnes $colonnes): static
    {
        $this->colonnes = $colonnes;

        return $this;
    }
}
