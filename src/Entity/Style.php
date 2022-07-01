<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StyleRepository::class)]
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
class Style
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["user:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["user:read", "user:write"])]
    private $name;

    #[ORM\OneToMany(mappedBy: 'style', targetEntity: Band::class)]
    #[Groups(["user:read", "user:write"])]
    private $bands;

    public function __construct()
    {
        $this->bands = new ArrayCollection();
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

    /**
     * @return Collection<int, Band>
     */
    public function getBands(): Collection
    {
        return $this->bands;
    }

    public function addBand(Band $band): self
    {
        if (!$this->bands->contains($band)) {
            $this->bands[] = $band;
            $band->setStyle($this);
        }

        return $this;
    }

    public function removeBand(Band $band): self
    {
        if ($this->bands->removeElement($band)) {
            // set the owning side to null (unless already changed)
            if ($band->getStyle() === $this) {
                $band->setStyle(null);
            }
        }

        return $this;
    }
}
