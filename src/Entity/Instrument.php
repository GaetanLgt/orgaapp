<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstrumentRepository::class)]
#[ApiResource]
class Instrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Materiel::class, inversedBy: 'instruments')]
    private $materiel;

    #[ORM\OneToMany(mappedBy: 'instrument', targetEntity: MusicienBand::class)]
    private $musicienBands;

    public function __construct()
    {
        $this->materiel = new ArrayCollection();
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
     * @return Collection<int, Materiel>
     */
    public function getMateriel(): Collection
    {
        return $this->materiel;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiel->contains($materiel)) {
            $this->materiel[] = $materiel;
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        $this->materiel->removeElement($materiel);

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
            $musicienBand->setInstrument($this);
        }

        return $this;
    }

    public function removeMusicienBand(MusicienBand $musicienBand): self
    {
        if ($this->musicienBands->removeElement($musicienBand)) {
            // set the owning side to null (unless already changed)
            if ($musicienBand->getInstrument() === $this) {
                $musicienBand->setInstrument(null);
            }
        }

        return $this;
    }
}
