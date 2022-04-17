<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Titres
 *
 * @ORM\Table(name="titres")
 * @ORM\Entity
 */
class Titres
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
     * @ORM\Column(name="nom", type="string", length=10, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="artiste", type="string", length=10, nullable=false)
     */
    private $artiste;


}
