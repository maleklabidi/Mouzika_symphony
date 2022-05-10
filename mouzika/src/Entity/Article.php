<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Float_;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity
 */
class Article
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
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=20, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=20, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user_id", type="integer", nullable=false)
     */
    private $idUserId;

    /**
     * @var float
     *
     * @ORM\Column(name="rating", type="float", nullable=false)
     */
    private $rating;

    /**
     * @return float|null
     */
    public function getRating(): ?float
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     */
    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getIdUserId(): ?int
    {
        return $this->idUserId;
    }

    /**
     * @param int $idUserId
     */
    public function setIdUserId(int $idUserId): void
    {
        $this->idUserId = $idUserId;
    }


}
