<?php

namespace App\Entity;

use App\Repository\TitresRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=TitresRepository::class)
 */
class Titres
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "The name must be at least {{ limit }} characters long",
     *      maxMessage = "The name  cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false)
     */
    private $nom;
    /**
     * @ORM\Column(type="float")
     */
    private $rating;

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }



    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "The name must be at least {{ limit }} characters long",
     *      maxMessage = "The name  cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false)
     */
    private $artiste;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getArtiste(): ?string
    {
        return $this->artiste;
    }

    public function setArtiste(string $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }
}
