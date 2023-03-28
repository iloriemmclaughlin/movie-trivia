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
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column()]
    private ?int $user_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $first_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $last_name = null;

    #[ORM\Column(type: Types::TEXT, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT, unique: true)]
    private ?string $username = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $password = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $background_color;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $foreground_color;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(name: "user_type_id", referencedColumnName: "user_type_id", nullable: false, options: ['default' => 2])]
    private UserType $user_type;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Game::class, orphanRemoval: true)]
    private Collection $games;

    #[ORM\OneToOne(mappedBy: 'user_id', cascade: ['persist', 'remove'])]
    private ?Stats $stats = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $auth0 = null;

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

    public function getBackgroundColor(): ?string
    {
        return $this->background_color;
    }

    public function setBackgroundColor(string $background_color): self
    {
        $this->background_color = $background_color;

        return $this;
    }

    public function getForegroundColor(): ?string
    {
        return $this->foreground_color;
    }

    public function setForegroundColor(string $foreground_color): self
    {
        $this->foreground_color = $foreground_color;

        return $this;
    }

    public function getUserType(): ?UserType
    {
        return $this->user_type;
    }

    public function setUserType(?UserType $user_type): self
    {
        $this->user_type = $user_type;

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

    public function getAuth0(): ?string
    {
        return $this->auth0;
    }

    public function setAuth0(?string $auth0): self
    {
        $this->auth0 = $auth0;

        return $this;
    }
}
