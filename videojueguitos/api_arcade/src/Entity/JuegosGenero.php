<?php

namespace App\Entity;

use App\Repository\JuegosGeneroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JuegosGeneroRepository::class)]
class JuegosGenero
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $juegos_id = null;

    #[ORM\Id]
    #[ORM\Column()]
    private ?int $genero_id = null;

    public function __construct()
    {
        $this->generos = new ArrayCollection();
    }

    public function getIdJuego(): ?int
    {
        return $this->juegos_id;
    }

    public function getIdGeneo(): ?int
    {
        return $this->genero_id;
    }
}
