<?php

namespace App\Entity;

use App\Repository\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagsRepository::class)]
class Tags
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $idTag = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Cartes>
     */
    #[ORM\ManyToMany(targetEntity: Cartes::class, inversedBy: 'idTags')]
    private Collection $idCartes;

    public function __construct()
    {
        $this->idCartes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTag(): ?int
    {
        return $this->idTag;
    }

    public function setIdTag(?int $idTag): static
    {
        $this->idTag = $idTag;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Cartes>
     */
    public function getIdCartes(): Collection
    {
        return $this->idCartes;
    }

    public function addIdCarte(Cartes $idCarte): static
    {
        if (!$this->idCartes->contains($idCarte)) {
            $this->idCartes->add($idCarte);
        }

        return $this;
    }

    public function removeIdCarte(Cartes $idCarte): static
    {
        $this->idCartes->removeElement($idCarte);

        return $this;
    }
}
