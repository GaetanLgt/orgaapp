<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MaterielRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'normalization_context' => ['groups' => 'material:read'],
            'security' => 'is_granted("ROLE_USER")',
            'security_message' => "Go cook yourself an egg"
        ],
        "post" => [
            'denormalization_context' => ['groups' => 'material:write'],
            'security' => 'is_granted("ROLE_USER")',
            'security_message' => "Go cook yourself an egg"
        ]
    ],
    itemOperations: [
        "get",
        "put" => ["security" => "is_granted('ROLE_USER')"],
        "delete" => ["security" => "is_granted('ROLE_USER')"],
        "patch" => ["security" => "is_granted('ROLE_USER')"],
    ],
    attributes: ["security" => "is_granted('ROLE_USER')"],
)]
class Materiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["material:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["material:read", "material:write"])]
    private $name;

    #[ORM\Column(type: 'boolean')]
    #[Groups(["material:read", "material:write"])]
    private $inStock;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(["material:read", "material:write"])]
    private $createdAt;

    #[ORM\Column(type: 'datetime')]
    #[Groups(["material:read", "material:write"])]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: Health::class, inversedBy: 'materiels')]
    #[Groups(["material:write"])]
    #[ORM\JoinColumn(nullable: true)]
    private $health;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'materiels')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["material:write"])]
    private $categorie;

    #[ORM\ManyToMany(targetEntity: Evenement::class, inversedBy: 'materiels')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["material:write"])]
    private $evenement;

    public function __construct()
    {
        $this->evenement = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isInStock(): ?bool
    {
        return $this->inStock;
    }

    public function setInStock(bool $inStock): self
    {
        $this->inStock = $inStock;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getHealth(): ?Health
    {
        return $this->health;
    }

    public function setHealth(?Health $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenement(): Collection
    {
        return $this->evenement;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenement->contains($evenement)) {
            $this->evenement[] = $evenement;
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        $this->evenement->removeElement($evenement);

        return $this;
    }
}