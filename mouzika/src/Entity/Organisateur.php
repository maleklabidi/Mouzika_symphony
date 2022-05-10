<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organisateur
 *
 * @ORM\Table(name="organisateur")
 * @ORM\Entity
 */
class Organisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdOrganisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idorganisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="NomOrganisateur", type="string", length=10, nullable=false)
     */
    private $nomorganisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="PrenomOrganisateur", type="string", length=10, nullable=false)
     */
    private $prenomorganisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="UsernameOrganisateur", type="string", length=10, nullable=false)
     */
    private $usernameorganisateur;

    /**
     * @var int
     *
     * @ORM\Column(name="MdpOrganisateur", type="integer", nullable=false)
     */
    private $mdporganisateur;

    public function getIdorganisateur(): ?int
    {
        return $this->idorganisateur;
    }

    public function getNomorganisateur(): ?string
    {
        return $this->nomorganisateur;
    }

    public function setNomorganisateur(string $nomorganisateur): self
    {
        $this->nomorganisateur = $nomorganisateur;

        return $this;
    }

    public function getPrenomorganisateur(): ?string
    {
        return $this->prenomorganisateur;
    }

    public function setPrenomorganisateur(string $prenomorganisateur): self
    {
        $this->prenomorganisateur = $prenomorganisateur;

        return $this;
    }

    public function getUsernameorganisateur(): ?string
    {
        return $this->usernameorganisateur;
    }

    public function setUsernameorganisateur(string $usernameorganisateur): self
    {
        $this->usernameorganisateur = $usernameorganisateur;

        return $this;
    }

    public function getMdporganisateur(): ?int
    {
        return $this->mdporganisateur;
    }

    public function setMdporganisateur(int $mdporganisateur): self
    {
        $this->mdporganisateur = $mdporganisateur;

        return $this;
    }


}
