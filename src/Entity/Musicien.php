<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MusicienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicienRepository::class)]
#[ApiResource]
class Musicien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'musicien', targetEntity: MusicienBand::class)]
    private $musicienBands;

    public function __construct()
    {
        $this->musicienBands = new ArrayCollection();
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
     * @return Collection<int, MusicienBand>
     */
    public function getMusicienBands(): Collection
    {
        return $this->musicienBands;
    }

    public function addMusicienBand(MusicienBand $musicienBand): self
    {
        if (!$this->musicienBands->contains($musicienBand)) {
            $this->musicienBands[] = $musicienBand;
            $musicienBand->setMusicien($this);
        }

        return $this;
    }

    public function removeMusicienBand(MusicienBand $musicienBand): self
    {
        if ($this->musicienBands->removeElement($musicienBand)) {
            // set the owning side to null (unless already changed)
            if ($musicienBand->getMusicien() === $this) {
                $musicienBand->setMusicien(null);
            }
        }

        return $this;
    }
}
