<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BandPlanningRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BandPlanningRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'normalization_context' => ['groups' => 'user:read'],
            'security' => 'is_granted("ROLE_USER") or object.owner == user',
            'security_message' => "Go cook yourself an egg"
        ],
        "post" => [
            'denormalization_context' => ['groups' => 'user:write'],
            'security' => 'is_granted("ROLE_USER") or object.owner == user',
            'security_message' => "Go cook yourself an egg"
        ]
    ],
    itemOperations: [
        "get",
        "put" => ["security" => "is_granted('ROLE_USER') or object.owner == user"],
        "delete" => ["security" => "is_granted('ROLE_USER') or object.owner == user"],
        "patch" => ["security" => "is_granted('ROLE_USER') or object.owner == user"],
    ],
    attributes: ["security" => "is_granted('ROLE_USER')"],
)]
class bandPlanning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["user:read"])]
    private $id;

    #[ORM\Column(type: 'time')]
    #[Groups(["user:read", "user:write"])]
    private $tempsDePassage;

    #[ORM\Column(type: 'integer')]
    #[Groups(["user:read", "user:write"])]
    private $ordreDePassage;

    #[ORM\Column(type: 'integer')]
    #[Groups(["user:read", "user:write"])]
    private $jourDePassage;

    #[ORM\ManyToOne(targetEntity: Band::class, inversedBy: 'bandPlannings')]
    #[ORM\JoinColumn(nullable: false)]
    private $band;

    #[ORM\ManyToOne(targetEntity: Planning::class, inversedBy: 'bandPlannings')]
    #[ORM\JoinColumn(nullable: false)]
    private $planning;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTempsDePassage(): ?\DateTimeInterface
    {
        return $this->tempsDePassage;
    }

    public function setTempsDePassage(\DateTimeInterface $tempsDePassage): self
    {
        $this->tempsDePassage = $tempsDePassage;

        return $this;
    }

    public function getOrdreDePassage(): ?int
    {
        return $this->ordreDePassage;
    }

    public function setOrdreDePassage(int $ordreDePassage): self
    {
        $this->ordreDePassage = $ordreDePassage;

        return $this;
    }

    public function getJourDePassage(): ?int
    {
        return $this->jourDePassage;
    }

    public function setJourDePassage(int $jourDePassage): self
    {
        $this->jourDePassage = $jourDePassage;

        return $this;
    }

    public function getband(): ?Band
    {
        return $this->band;
    }

    public function setband(?Band $band): self
    {
        $this->band = $band;

        return $this;
    }

    public function getPlanning(): ?Planning
    {
        return $this->planning;
    }

    public function setPlanning(?Planning $planning): self
    {
        $this->planning = $planning;

        return $this;
    }
}