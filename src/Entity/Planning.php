<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlanningRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
#[ApiResource]
class Planning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $eventDay;

    #[ORM\Column(type: 'string', length: 255)]
    private $beginHour;

    #[ORM\Column(type: 'string', length: 255)]
    private $enddingHour;

    #[ORM\ManyToOne(targetEntity: Evenement::class, inversedBy: 'plannings')]
    #[ORM\JoinColumn(nullable: false)]
    private $evenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventDay(): ?string
    {
        return $this->eventDay;
    }

    public function setEventDay(string $eventDay): self
    {
        $this->eventDay = $eventDay;

        return $this;
    }

    public function getBeginHour(): ?string
    {
        return $this->beginHour;
    }

    public function setBeginHour(string $beginHour): self
    {
        $this->beginHour = $beginHour;

        return $this;
    }

    public function getEnddingHour(): ?string
    {
        return $this->enddingHour;
    }

    public function setEnddingHour(string $enddingHour): self
    {
        $this->enddingHour = $enddingHour;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }
}
