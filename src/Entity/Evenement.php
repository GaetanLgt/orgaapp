<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'normalization_context' => ['groups' => 'event:read'],
            'security' => 'is_granted("ROLE_USER")',
            'security_message' => "Go cook yourself an egg"
        ],
        "post" => [
            'denormalization_context' => ['groups' => 'event:write'],
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
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["event:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["event:read", "event:write"])]
    private $name;

    #[ORM\Column(type: 'integer')]
    #[Groups(["event:read", "event:write"])]
    private $nbJours;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(["event:read", "event:write"])]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(["event:read", "event:write"])]
    private $updatedAt;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["event:read", "event:write"])]
    private $place;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["event:read", "event:write"])]
    private $placeContactName;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["event:read", "event:write"])]
    private $placeContactPhone;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["event:read", "event:write"])]
    private $placeContactEmail;

    #[ORM\Column(type: 'time')]
    #[Groups(["event:read", "event:write"])]
    private $balanceTime;

    #[ORM\Column(type: 'boolean')]
    #[Groups(["event:read", "event:write"])]
    private $indoor;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["event:write", 'user:id'])]
    private $user;

    #[ORM\ManyToMany(targetEntity: Materiel::class, mappedBy: 'evenement')]
    private $materiels;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: Planning::class)]
    private $plannings;

    public function __construct()
    {
        $this->materiels = new ArrayCollection();
        $this->plannings = new ArrayCollection();
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

    public function getNbJours(): ?int
    {
        return $this->nbJours;
    }

    public function setNbJours(int $nbJours): self
    {
        $this->nbJours = $nbJours;

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

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getPlaceContactName(): ?string
    {
        return $this->placeContactName;
    }

    public function setPlaceContactName(string $placeContactName): self
    {
        $this->placeContactName = $placeContactName;

        return $this;
    }

    public function getPlaceContactPhone(): ?string
    {
        return $this->placeContactPhone;
    }

    public function setPlaceContactPhone(string $placeContactPhone): self
    {
        $this->placeContactPhone = $placeContactPhone;

        return $this;
    }

    public function getPlaceContactEmail(): ?string
    {
        return $this->placeContactEmail;
    }

    public function setPlaceContactEmail(string $placeContactEmail): self
    {
        $this->placeContactEmail = $placeContactEmail;

        return $this;
    }

    public function getBalanceTime(): ?\DateTimeInterface
    {
        return $this->balanceTime;
    }

    public function setBalanceTime(\DateTimeInterface $balanceTime): self
    {
        $this->balanceTime = $balanceTime;

        return $this;
    }

    public function isIndoor(): ?bool
    {
        return $this->indoor;
    }

    public function setIndoor(bool $indoor): self
    {
        $this->indoor = $indoor;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Materiel>
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels[] = $materiel;
            $materiel->addEvenement($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            $materiel->removeEvenement($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Planning>
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }

    public function addPlanning(Planning $planning): self
    {
        if (!$this->plannings->contains($planning)) {
            $this->plannings[] = $planning;
            $planning->setEvenement($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): self
    {
        if ($this->plannings->removeElement($planning)) {
            // set the owning side to null (unless already changed)
            if ($planning->getEvenement() === $this) {
                $planning->setEvenement(null);
            }
        }

        return $this;
    }
}