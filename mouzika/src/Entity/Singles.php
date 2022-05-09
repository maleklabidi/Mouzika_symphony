<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints as CaptchaAssert;
/**
 * Singles
 *
 * @ORM\Table(name="singles")
 * @ORM\Entity(repositoryClass="App\Repository\SinglesRepository")
 */
class Singles
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
     * @ORM\Column(name="artist", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="il faut saisir l'artiste")
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(name="single_name", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="il faut saisir le nom du single")
     */
    private $singleName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="release_date", type="date", nullable=false)
     */
    private $releaseDate;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255, nullable=false)
     * @Assert\NotBlank (message="il faut saisir le genre du single")
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="image_single", type="string", length=255, nullable=false)
     */
    private $imageSingle;

    /**
     * @var string
     *
     * @ORM\Column(name="audio_single", type="string", length=255, nullable=false)
     */
    private $audioSingle;

    /**
     * @ORM\ManyToOne(targetEntity=Albums::class, inversedBy="singles")
     */
    private $albums;

    public function getAlbums(): ?Albums
    {
        return $this->albums;
    }

    public function setAlbums(?Albums $albums): self
    {
        $this->albums = $albums;

        return $this;
    }

    /**
     * @return string
     */
    public function getArtist(): ?string
    {
        return $this->artist;
    }

    /**
     * @param string $artist
     */
    public function setArtist(string $artist): void
    {
        $this->artist = $artist;
    }

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
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSingleName(): ?string
    {
        return $this->singleName;
    }

    /**
     * @param string $singleName
     */
    public function setSingleName(string $singleName): void
    {
        $this->singleName = $singleName;
    }

    /**
     * @return \DateTime
     */
    public function getReleaseDate(): ?\DateTime
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTime $releaseDate
     */
    public function setReleaseDate(\DateTime $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return string
     */
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return string
     */
    public function getImageSingle(): ?string
    {
        return $this->imageSingle;
    }

    /**
     * @param string $imageSingle
     */
    public function setImageSingle(string $imageSingle): void
    {
        $this->imageSingle = $imageSingle;
    }

    /**
     * @return string
     */
    public function getAudioSingle(): ?string
    {
        return $this->audioSingle;
    }

    /**
     * @param string $audioSingle
     */
    public function setAudioSingle(string $audioSingle): void
    {
        $this->audioSingle = $audioSingle;
    }

    /**
     * @CaptchaAssert\ValidCaptcha(
     *      message = "CAPTCHA validation failed, try again."
     * )
     */
    protected $captchaCode;

    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }


}
