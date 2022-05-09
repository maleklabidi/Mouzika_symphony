<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Albums
 *
 * @ORM\Table(name="albums")
 * @ORM\Entity(repositoryClass="App\Repository\AlbumsRepository")
 */
class Albums
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Assert\NotBlank (message="il faut saisir le titre de l'album")
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="number_of_songs", type="integer", nullable=false)
     * @Assert\NotBlank (message="il faut saisir le nombre des chansons")
     */
    private $numberOfSongs;

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
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="artist", type="string", length=255, nullable=false)
     * @Assert\NotBlank (message="il faut saisir le nom de l'artiste")
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(name="image_album", type="string", length=255, nullable=false)
     */
    private $imageAlbum;

    /**
     * @ORM\OneToMany(targetEntity=Singles::class, mappedBy="albums")
     */
    private $singles;

    public function __construct()
    {
        $this->singles = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getNumberOfSongs(): ?int
    {
        return $this->numberOfSongs;
    }

    /**
     * @param int $numberOfSongs
     */
    public function setNumberOfSongs(int $numberOfSongs): void
    {
        $this->numberOfSongs = $numberOfSongs;
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
     * @return string
     */
    public function getImageAlbum(): ?string
    {
        return $this->imageAlbum;
    }

    /**
     * @param string $imageAlbum
     */
    public function setImageAlbum(string $imageAlbum): void
    {
        $this->imageAlbum = $imageAlbum;
    }

    /**
     * @return Collection<int, Singles>
     */
    public function getSingles(): Collection
    {
        return $this->singles;
    }

    public function addSingle(Singles $single): self
    {
        if (!$this->singles->contains($single)) {
            $this->singles[] = $single;
            $single->setAlbums($this);
        }

        return $this;
    }

    public function removeSingle(Singles $single): self
    {
        if ($this->singles->removeElement($single)) {
            // set the owning side to null (unless already changed)
            if ($single->getAlbums() === $this) {
                $single->setAlbums(null);
            }
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getArtist();
    }


}
