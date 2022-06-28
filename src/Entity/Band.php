<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BandRepository::class)]
#[ApiResource]
class Band
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $contact_name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $contact_phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $contact_email;

    #[ORM\Column(type: 'time')]
    private $setup;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime')]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: Style::class, inversedBy: 'bands')]
    #[ORM\JoinColumn(nullable: false)]
    private $style;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: BrandPlanning::class)]
    private $brandPlannings;

    public function __construct()
    {
        $this->brandPlannings = new ArrayCollection();
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
        return $this->contact_name;
    }

    public function setContactName(string $contact_name): self
    {
        $this->contact_name = $contact_name;

        return $this;
    }

    public function getContactPhone(): ?string
    {
        return $this->contact_phone;
    }

    public function setContactPhone(?string $contact_phone): self
    {
        $this->contact_phone = $contact_phone;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contact_email;
    }

    public function setContactEmail(?string $contact_email): self
    {
        $this->contact_email = $contact_email;

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
     * @return Collection<int, BrandPlanning>
     */
    public function getBrandPlannings(): Collection
    {
        return $this->brandPlannings;
    }

    public function addBrandPlanning(BrandPlanning $brandPlanning): self
    {
        if (!$this->brandPlannings->contains($brandPlanning)) {
            $this->brandPlannings[] = $brandPlanning;
            $brandPlanning->setBrand($this);
        }

        return $this;
    }

    public function removeBrandPlanning(BrandPlanning $brandPlanning): self
    {
        if ($this->brandPlannings->removeElement($brandPlanning)) {
            // set the owning side to null (unless already changed)
            if ($brandPlanning->getBrand() === $this) {
                $brandPlanning->setBrand(null);
            }
        }

        return $this;
    }
}
