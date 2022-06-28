<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
#[ApiResource]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $nbJours;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'string', length: 255)]
    private $place;

    #[ORM\Column(type: 'string', length: 255)]
    private $placeContactName;

    #[ORM\Column(type: 'string', length: 255)]
    private $placeContactPhone;

    #[ORM\Column(type: 'string', length: 255)]
    private $placeContactEmail;

    #[ORM\Column(type: 'time')]
    private $balanceTime;

    #[ORM\Column(type: 'boolean')]
    private $indoor;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

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
}
