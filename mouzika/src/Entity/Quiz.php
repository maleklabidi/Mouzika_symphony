<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz")
 * @ORM\Entity
 */
class Quiz
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
     *@Assert\NotBlank(message="Question is required")
     *@Assert\Length(
     *     min=2,
     *     max=100,
     *     minMessage="Question courte",
     *     maxMessage="Question tres longue")
     *
     * @ORM\Column(name="question", type="string", length=50, nullable=false)
     */
    private $question;

    /**
     * @var string
     *@Assert\NotBlank(message="Reponse is required")
     *@Assert\Length(
     *     min=2,
     *     max=100,
     *     minMessage="Reponse courte",
     *     maxMessage="Reponse tres longue")
     *
     * @ORM\Column(name="reponse", type="string", length=20, nullable=false)
     */
    private $reponse;

    /**
     * @var int
     *@Assert\NotBlank(message="Duree is required")
     *@Assert\Length(
     *     min=2,
     *     max=3,
     *     minMessage="Duree doit etre plus que 5 Minutes",
     *     maxMessage="Duree doit etre moins que  30 minutes ")
     * @ORM\Column(name="duree", type="integer", nullable=false)
     */
    private $duree;

    /**
     * @var int
     *
     * @ORM\Column(name="idPromo", type="integer", nullable=false)
     */
    private $idPromo;

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
     * @return string
     */
    public function getQuestion(): ?string
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion(string $question): self
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return string
     */
    public function getReponse(): ?string
    {
        return $this->reponse;

    }

    /**
     * @param string $reponse
     */
    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;
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

    /**
     * @return int
     */
    public function getIdpromo(): ?int
    {
        return $this->idPromo;
    }

    /**
     * @param int $idPromo
     */
    public function setIdpromo(int $idPromo): self
    {
        $this->idPromo = $idPromo;
        return $this;
    }


}
