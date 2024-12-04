<?php

namespace App\Entity;

use App\Repository\ProjetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetsRepository::class)]
class Projets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_fin_prevu = null;

    #[ORM\Column]
    private ?bool $cloture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    /**
     * @var Collection<int, Users>
     */
    #[ORM\ManyToMany(targetEntity: Users::class, inversedBy: 'projets')]
    private Collection $users;

    /**
     * @var Collection<int, Colonnes>
     */
    #[ORM\OneToMany(targetEntity: Colonnes::class, mappedBy: 'projets')]
    private Collection $colonnes;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->colonnes = new ArrayCollection();
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateFinPrevu(): ?\DateTimeInterface
    {
        return $this->date_fin_prevu;
    }

    public function setDateFinPrevu(\DateTimeInterface $date_fin_prevu): static
    {
        $this->date_fin_prevu = $date_fin_prevu;

        return $this;
    }

    public function isCloture(): ?bool
    {
        return $this->cloture;
    }

    public function setCloture(bool $cloture): static
    {
        $this->cloture = $cloture;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Colonnes>
     */
    public function getColonnes(): Collection
    {
        return $this->colonnes;
    }

    public function addColonne(Colonnes $colonne): static
    {
        if (!$this->colonnes->contains($colonne)) {
            $this->colonnes->add($colonne);
            $colonne->setProjets($this);
        }

        return $this;
    }

    public function removeColonne(Colonnes $colonne): static
    {
        if ($this->colonnes->removeElement($colonne)) {
            // set the owning side to null (unless already changed)
            if ($colonne->getProjets() === $this) {
                $colonne->setProjets(null);
            }
        }

        return $this;
    }
}
