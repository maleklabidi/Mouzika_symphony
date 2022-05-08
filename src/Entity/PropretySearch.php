<?php

namespace App\Entity;

class PropretySearch
{

    private $nom;

    public function getNom(): ?string
    {
        return
            $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }


}