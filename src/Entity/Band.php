<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\User;

#[ORM\Entity(repositoryClass: BandRepository::class)]
#[ApiResource(
    // normalizationContext : ['groups' => ['band:read']],
    // denormalizationContext : ['groups' => ['band:write']],
    collectionOperations: [
        "get" => [
            'normalization_context' => ['groups' => 'band:read'],
            'security' => 'is_granted("ROLE_USER")',
            'security_message' => "Go cook yourself an egg"   
        ],
        "post" => [
            'denormalization_context' => ['groups' => 'band:write'],
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
class Band
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["band:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["band:read", "band:write"])]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["band:read", "band:write"])]
    private $contactName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["band:read", "band:write"])]
    private $contactPhone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["band:read", "band:write"])]
    private $contactEmail;

    #[ORM\Column(type: 'time')]
    #[Groups(["band:read", "band:write"])]
    private $setup;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(["band:read", "band:write"])]
    private $createdAt;

    #[ORM\Column(type: 'datetime')]
    #[Groups(["band:read", "band:write"])]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: Style::class, inversedBy: 'bands')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["style:read", "style:write"])]
    private $style;

    #[ORM\ManyToOne(targetEntity: band::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["user:read", "user:write"])]
    private $user;

    #[ORM\OneToMany(mappedBy: 'band', targetEntity: bandPlanning::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["bdplanning:read", "bdplanning:write"])]
    private $bandPlannings;

    public function __construct()
    {
        $this->bandPlannings = new ArrayCollection();
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

    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    public function setContactName(string $contactName): self
    {
        $this->contactName = $contactName;

        return $this;
    }

    public function getContactPhone(): ?string
    {
        return $this->contactPhone;
    }

    public function setContactPhone(?string $contactPhone): self
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(?string $contactEmail): self
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    public function getSetup(): ?\DateTimeInterface
    {
        return $this->setup;
    }

    public function setSetup(\DateTimeInterface $setup): self
    {
        $this->setup = $setup;

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

    public function getStyle(): ?Style
    {
        return $this->style;
    }

    public function setStyle(?Style $style): self
    {
        $this->style = $style;

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
     * @return Collection<int, bandPlanning>
     */
    public function getbandPlannings(): Collection
    {
        return $this->bandPlannings;
    }

    public function addbandPlanning(bandPlanning $bandPlanning): self
    {
        if (!$this->bandPlannings->contains($bandPlanning)) {
            $this->bandPlannings[] = $bandPlanning;
            $bandPlanning->setband($this);
        }

        return $this;
    }

    public function removebandPlanning(bandPlanning $bandPlanning): self
    {
        if ($this->bandPlannings->removeElement($bandPlanning)) {
            // set the owning side to null (unless already changed)
            if ($bandPlanning->getband() === $this) {
                $bandPlanning->setband(null);
            }
        }

        return $this;
    }
}
