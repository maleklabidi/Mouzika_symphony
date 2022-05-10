<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert ;
use Vich\UploaderBundle\Mapping\Annotation\uploadable;
use App\Repository\UserRepository;


use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity ;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity
 */
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var int
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id_user;

    /**
     * @var string
    @Assert\NotBlank(message = "veuillez inserer votre mot de passe")
     * @ORM\Column(name="mdp", type="string", length=50, nullable=false)
     */
    private $mdp;

    /**
     * @var string

     * @Assert\Length(min=3)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="votre nom ne doit pas contenir un numéro"
     * )
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;


    /**
     * @var string
     * @Assert\Length(min=3)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="votre prenom ne doit pas contenir un numéro"
     * )
     * @ORM\Column(name="prenom", type="string", length=50, nullable=true)
     */
    private $prenom;


    /**
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.")
     * @Assert\Length(min=3)
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;
    /**

     * @var string
     * @ORM\Column(name="role", type="string", length=50, nullable=false)
     */
    private $role='CLIENT';

    /**
     * @var int
     * @Assert\Length(min=8)
     * @ORM\Column(name="numtel_user", type="integer", nullable=true)
     */
    public $numtel_user;

    /**
     * @var string
     * @ORM\Column(name="adresse_user", type="string", length=50, nullable=true)
     */
    public $adresse_user;

    /**
     * @var int
     * @ORM\Column(name="connected", type="integer", nullable=true)
     */
    private $connected = '0';

    public function getid_user(): ?int
    {
        return $this->id_user;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = "CLIENT";

        return $this;
    }

    public function getnumtel_user(): ?int
    {
        return $this->numtel_user;
    }

    public function setnumtel_user(int $numtel_user): self
    {
        $this->numtelUser = $numtel_user;

        return $this;
    }

    public function getadresse_user(): ?string
    {
        return $this->adresse_user;
    }

    public function setadresse_user(string $adresse_user): self
    {
        $this->adresse_user = $adresse_user;

        return $this;
    }

    public function getConnected(): ?int
    {
        return $this->connected;
    }

    public function setConnected(int $connected): self
    {
        $this->connected = $connected;

        return $this;
    }
    public function getId(): ?int
    {
        return $this->id_user;
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }
}
