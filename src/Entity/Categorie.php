<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'normalization_context' => ['groups' => 'categorie:read'],
            'security' => 'is_granted("ROLE_USER")',
            'security_message' => "Go cook yourself an egg"
        ],
        "post" => [
            'denormalization_context' => ['groups' => 'categorie:write'],
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
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["categorie:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["categorie:read", "categorie:write"])]
    private $name;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Materiel::class)]
    #[Groups(["materiel:id", "categorie:write"])]
    private $materiels;

    public function __construct()
    {
        $this->materiels = new ArrayCollection();
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
            $materiel->setCategorie($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getCategorie() === $this) {
                $materiel->setCategorie(null);
            }
        }

        return $this;
    }
}
