<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlanningRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'normalization_context' => ['groups' => 'planning:read'],
            'security' => 'is_granted("ROLE_USER")',
            'security_message' => "Go cook yourself an egg"
        ],
        "post" => [
            'denormalization_context' => ['groups' => 'planning:write'],
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
class Planning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["planning:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["planning:read", "planning:write"])]
    private $eventDay;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["planning:read", "planning:write"])]
    private $beginHour;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["planning:read", "planning:write"])]
    private $enddingHour;

    #[ORM\ManyToOne(targetEntity: Evenement::class, inversedBy: 'plannings')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["planning:write"])]
    private $evenement;

    #[ORM\OneToMany(mappedBy: 'planning', targetEntity: bandPlanning::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["planning:write"])]
    private $bandPlannings;

    public function __construct()
    {
        $this->bandPlannings = new ArrayCollection();
    }

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
            $bandPlanning->setPlanning($this);
        }

        return $this;
    }

    public function removebandPlanning(bandPlanning $bandPlanning): self
    {
        if ($this->bandPlannings->removeElement($bandPlanning)) {
            // set the owning side to null (unless already changed)
            if ($bandPlanning->getPlanning() === $this) {
                $bandPlanning->setPlanning(null);
            }
        }

        return $this;
    }
}
