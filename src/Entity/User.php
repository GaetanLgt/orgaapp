<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    collectionOperations: [
        "get" => [
            'normalization_context' => ['groups' => 'user:read'],
            'security' => 'is_granted("ROLE_ADMIN") or object.owner == user',
            'security_message' => "Va te faire cuire un oeuf"
        ],
        "post" => [
            'denormalization_context' => ['groups' => 'user:write'],
            'security' => 'is_granted("ROLE_ADMIN") or object.owner == user',
            'security_message' => "Va te faire cuire un oeuf"
        ]
    ],
    itemOperations: [
        "get",
        "put" => ["security" => "is_granted('ROLE_ADMIN') or object.owner == user"],
        "delete" => ["security" => "is_granted('ROLE_ADMIN') or object.owner == user"],
        "patch" => ["security" => "is_granted('ROLE_ADMIN') or object.owner == user"],
    ],
)]
#[ORM\Table(name: '`user`')]


class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["user:read", "user:write"])]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Groups(["user:read", "user:write"])]
    private $email;

    #[ORM\Column(type: 'json')]
    #[Groups(["user:read", "user:write"])]
    private $roles = [];

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["user:read", "user:write"])]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["user:read", "user:write"])]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["user:write"])]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["user:read", "user:write"])]
    private $username;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}
