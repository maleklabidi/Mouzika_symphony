<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Promotions
 *
 * @ORM\Table(name="promotions")
 * @ORM\Entity
 */
class Promotions
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *@Assert\NotBlank(message="Pourcentage is required")
     *@Assert\Length(
     *     min=1,
     *     max=2,
     *     minMessage="Pourcentage doit etre plus que 10",
     *     maxMessage="Pourcentage doit etre moins que  100 ")
     * @ORM\Column(name="pourcentage", type="integer")
     */
    private $pourcentage;

    /**
     * @var int
     *@Assert\NotBlank(message="Duree is required")
     * @Assert\Length(
     *     max=2,
     *     maxMessage="Durée en jours doit etre moins que  10 ")
     * @ORM\Column(name="duree", type="integer")
     */
    private $duree;

    /**
     * @ORM\OneToOne(targetEntity=Produits::class)
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="id_prod_id", referencedColumnName="id")
     * })
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProd;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPourcentage(): ?int
    {
        return $this->pourcentage;
    }

    /**
     * @param int $pourcentage
     */
    public function setPourcentage(int $pourcentage): self
    {
        $this->pourcentage = $pourcentage;
        return $this;
    }

    /**
     * @return int
     */
    public function getDuree(): ?int
    {
        return $this->duree;
    }

    /**
     * @param int $duree
     */
    public function setDuree(int $duree): self
    {
        $this->duree = $duree;
        return $this;
    }


    public function getIdProd(): ?Produits
    {
        return $this->idProd;
    }


    public function setIdProd(Produits $idProd): self
    {
        $this->idProd = $idProd;
        return $this;
    }



}
