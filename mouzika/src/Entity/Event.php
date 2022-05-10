<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdEvent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevent;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="NomEvent", type="string", length=10, nullable=false)
     */
    private $nomevent;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="nomArtiste", type="string", length=30, nullable=false)
     */
    private $nomartiste;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="LocalisationEvent", type="string", length=10, nullable=false)
     */
    private $localisationevent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateEvent", type="date", nullable=false)
     */
    private $dateevent;

    public function getIdevent(): ?int
    {
        return $this->idevent;
    }

    public function getNomevent(): ?string
    {
        return $this->nomevent;
    }

    public function setNomevent(string $nomevent): self
    {
        $this->nomevent = $nomevent;

        return $this;
    }

    public function getNomartiste(): ?string
    {
        return $this->nomartiste;
    }

    public function setNomartiste(string $nomartiste): self
    {
        $this->nomartiste = $nomartiste;

        return $this;
    }

    public function getLocalisationevent(): ?string
    {
        return $this->localisationevent;
    }

    public function setLocalisationevent(string $localisationevent): self
    {
        $this->localisationevent = $localisationevent;

        return $this;
    }

    public function getDateevent(): ?\DateTimeInterface
    {
        return $this->dateevent;
    }

    public function setDateevent(\DateTimeInterface $dateevent): self
    {
        $this->dateevent = $dateevent;

        return $this;
    }


}
