<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MusicienBandRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicienBandRepository::class)]
#[ApiResource]
class MusicienBand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Musicien::class, inversedBy: 'musicienBands')]
    private $musicien;

    #[ORM\ManyToOne(targetEntity: Instrument::class, inversedBy: 'musicienBands')]
    private $instrument;

    #[ORM\ManyToOne(targetEntity: Band::class, inversedBy: 'musicienBands')]
    private $band;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMusicien(): ?Musicien
    {
        return $this->musicien;
    }

    public function setMusicien(?Musicien $musicien): self
    {
        $this->musicien = $musicien;

        return $this;
    }

    public function getInstrument(): ?Instrument
    {
        return $this->instrument;
    }

    public function setInstrument(?Instrument $instrument): self
    {
        $this->instrument = $instrument;

        return $this;
    }

    public function getBand(): ?Band
    {
        return $this->band;
    }

    public function setBand(?Band $band): self
    {
        $this->band = $band;

        return $this;
    }
}
