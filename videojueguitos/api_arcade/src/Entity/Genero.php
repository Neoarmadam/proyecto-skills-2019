<?php

namespace App\Entity;

use App\Repository\GeneroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeneroRepository::class)]
class Genero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\Column(length: 120, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\ManyToMany(targetEntity: Juegos::class, mappedBy: 'generos')]
    private Collection $juegos;

   

    public function __construct()
    {
        $this->juegos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Juegos>
     */
    public function getJuegos(): Collection
    {
        return $this->juegos;
    }

    public function addJuego(Juegos $juego): static
    {
        if (!$this->juegos->contains($juego)) {
            $this->juegos->add($juego);
            $juego->addGenero($this);
        }

        return $this;
    }

    public function removeJuego(Juegos $juego): static
    {
        if ($this->juegos->removeElement($juego)) {
            $juego->removeGenero($this);
        }

        return $this;
    }
}
