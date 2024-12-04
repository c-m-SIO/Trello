<?php

namespace App\Entity;

use App\Repository\ColonnesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColonnesRepository::class)]
class Colonnes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    /**
     * @var Collection<int, Cartes>
     */
    #[ORM\OneToMany(targetEntity: Cartes::class, mappedBy: 'colonnes')]
    private Collection $cartes;

    #[ORM\ManyToOne(inversedBy: 'colonnes')]
    private ?Projets $projets = null;

    public function __construct()
    {
        $this->cartes = new ArrayCollection();
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

    /**
     * @return Collection<int, Cartes>
     */
    public function getCartes(): Collection
    {
        return $this->cartes;
    }

    public function addCarte(Cartes $carte): static
    {
        if (!$this->cartes->contains($carte)) {
            $this->cartes->add($carte);
            $carte->setColonnes($this);
        }

        return $this;
    }

    public function removeCarte(Cartes $carte): static
    {
        if ($this->cartes->removeElement($carte)) {
            // set the owning side to null (unless already changed)
            if ($carte->getColonnes() === $this) {
                $carte->setColonnes(null);
            }
        }

        return $this;
    }

    public function getProjets(): ?Projets
    {
        return $this->projets;
    }

    public function setProjets(?Projets $projets): static
    {
        $this->projets = $projets;

        return $this;
    }
}
