<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="IdEventParticipation", columns={"IdEventParticipation", "idauditeur"}), @ORM\Index(name="IdAuditeur", columns={"IdAuditeur"}), @ORM\Index(name="IDX_AB55E24FD54BF72C", columns={"IdEventParticipation"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdParticipation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipation;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdEventParticipation", referencedColumnName="IdEvent")
     * })
     */
    private $ideventparticipation;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idauditeur", referencedColumnName="id_user")
     * })
     */
    private $id;

    public function getIdparticipation(): ?int
    {
        return $this->idparticipation;
    }

    public function getIdeventparticipation(): ?Event
    {
        return $this->ideventparticipation;
    }

    public function setIdeventparticipation(?Event $ideventparticipation): self
    {
        $this->ideventparticipation = $ideventparticipation;

        return $this;
    }


    public function getId(): ?User
    {
        return $this->id;
    }


    public function setId(?User $id): self
    {
        $this->id = $id;
        return $this;
    }





}
