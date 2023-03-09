<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $user_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $first_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $last_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $username = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $password = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(name: "user_type_id", referencedColumnName: "user_type_id", nullable: false)]
    private ?UserType $user_type_id = null;

    #[ORM\OneToOne(mappedBy: 'user_id', cascade: ['persist', 'remove'])]
    private ?Settings $settings = null;

    #[ORM\OneToOne(mappedBy: 'user_id', cascade: ['persist', 'remove'])]
    private ?Stats $stats = null;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Game::class, orphanRemoval: true)]
    private Collection $games;

    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->user_id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUserTypeId(): ?UserType
    {
        return $this->user_type_id;
    }

    public function setUserTypeId(?UserType $user_type_id): self
    {
        $this->user_type_id = $user_type_id;

        return $this;
    }

    public function getSettings(): ?Settings
    {
        return $this->settings;
    }

    public function setSettings(Settings $settings): self
    {
        // set the owning side of the relation if necessary
        if ($settings->getUserId() !== $this) {
            $settings->setUserId($this);
        }

        $this->settings = $settings;

        return $this;
    }

    public function getStats(): ?Stats
    {
        return $this->stats;
    }

    public function setStats(Stats $stats): self
    {
        // set the owning side of the relation if necessary
        if ($stats->getUserId() !== $this) {
            $stats->setUserId($this);
        }

        $this->stats = $stats;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setUserId($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getUserId() === $this) {
                $game->setUserId(null);
            }
        }

        return $this;
    }
}
