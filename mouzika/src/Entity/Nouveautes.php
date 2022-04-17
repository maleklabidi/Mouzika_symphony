<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nouveautes
 *
 * @ORM\Table(name="nouveautes")
 * @ORM\Entity
 */
class Nouveautes
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


}
