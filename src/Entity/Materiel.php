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
    attributes: ["security" => "is_granted('ROLE_USER')"],
    collectionOperations: [
        "get" => [
            'normalization_context' => ['groups' => 'user:read'],
            'security' => 'is_granted("ROLE_USER") or object.owner == user',
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
class Materiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["user:read", "user:write"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["user:read", "user:write"])]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["user:read", "user:write"])]
    private $status;

    #[ORM\Column(type: 'boolean')]
    #[Groups(["user:read", "user:write"])]
    private $inStock;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(["user:read", "user:write"])]
    private $createdAt;

    #[ORM\Column(type: 'datetime')]
    #[Groups(["user:read", "user:write"])]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: Health::class, inversedBy: 'materiels')]
    #[ORM\JoinColumn(nullable: false)]
    private $health;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'materiels')]
    #[ORM\JoinColumn(nullable: false)]
    private $categorie;

    #[ORM\ManyToMany(targetEntity: Evenement::class, inversedBy: 'materiels')]
    private $evenement;

    #[ORM\ManyToMany(targetEntity: Instrument::class, mappedBy: 'materiel')]
    private $instruments;

    public function __construct()
    {
        $this->evenement = new ArrayCollection();
        $this->instruments = new ArrayCollection();
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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

    /**
     * @return Collection<int, Instrument>
     */
    public function getInstruments(): Collection
    {
        return $this->instruments;
    }

    public function addInstrument(Instrument $instrument): self
    {
        if (!$this->instruments->contains($instrument)) {
            $this->instruments[] = $instrument;
            $instrument->addMateriel($this);
        }

        return $this;
    }

    public function removeInstrument(Instrument $instrument): self
    {
        if ($this->instruments->removeElement($instrument)) {
            $instrument->removeMateriel($this);
        }

        return $this;
    }
}
