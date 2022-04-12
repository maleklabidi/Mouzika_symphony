<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Singles
 *
 * @ORM\Table(name="singles")
 * @ORM\Entity
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
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(name="single_name", type="string", length=255, nullable=false)
     */
    private $singleName;

    /**
     * @var string
     *
     * @ORM\Column(name="artist_image", type="string", length=255, nullable=false)
     */
    private $artistImage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="release_date", type="date", nullable=false)
     */
    private $releaseDate;

    /**
     * @var int
     *
     * @ORM\Column(name="rate", type="integer", nullable=false)
     */
    private $rate;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255, nullable=false)
     */
    private $genre;


}
