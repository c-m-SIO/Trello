<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this mail')]
class Users implements UserInterface,PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $service = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poste = null;

    /**
     * @var Collection<int, Cartes>
     */
    #[ORM\ManyToMany(targetEntity: Cartes::class, mappedBy: 'users')]
    private Collection $cartes;

    /**
     * @var Collection<int, Projets>
     */
    #[ORM\ManyToMany(targetEntity: Projets::class, mappedBy: 'users')]
    private Collection $projets;

    public function __construct()
    {
        $this->cartes = new ArrayCollection();
        $this->projets = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

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
        return $this->email; // Vous pouvez aussi retourner un autre champ unique, comme le nom d'utilisateur
    }

    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

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

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(?string $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(?string $poste): static
    {
        $this->poste = $poste;

        return $this;
    }

    public function getRoles(): array
    {
        // Retourne les rôles de l'utilisateur, par exemple :
        return ['ROLE_USER'];
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
            $carte->addUser($this);
        }

        return $this;
    }

    public function removeCarte(Cartes $carte): static
    {
        if ($this->cartes->removeElement($carte)) {
            $carte->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Projets>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projets $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->addUser($this);
        }

        return $this;
    }

    public function removeProjet(Projets $projet): static
    {
        if ($this->projets->removeElement($projet)) {
            $projet->removeUser($this);
        }

        return $this;
    }

    public function eraseCredentials(): void
    {
        // Laissez vide si vous ne stockez pas de données sensibles supplémentaires
    }

    public function getSalt(): ?string
    {
        // Symfony 5.3 et versions ultérieures n'ont plus besoin de cette méthode
        // Si vous utilisez bcrypt ou argon2, vous pouvez laisser cette méthode vide
        return null;
    }
}
