<?php

namespace App\Entity;

use App\Repository\NouveautesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=NouveautesRepository::class)
 */
class Nouveautes
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
     *      minMessage = "The title must be at least {{ limit }} characters long",
     *      maxMessage = "The title  cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "The description must be at least {{ limit }} characters long",
     *      maxMessage = "The description  cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="integer")
     */
    private $userid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }
}
