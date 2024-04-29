<?php

namespace App\Entity;

use App\Repository\VueloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueloRepository::class)]
class Vuelo 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $Precio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $FechaIda = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $FechaVuelta = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NombreAerolinea = null;

    /**
     * @var Collection<int, Usuario>
     */
    #[ORM\ManyToMany(targetEntity: Usuario::class, mappedBy: 'Vuelos')]
    private Collection $usuarios;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecio(): ?int
    {
        return $this->Precio;
    }

    public function setPrecio(?int $Precio): static
    {
        $this->Precio = $Precio;

        return $this;
    }

    public function getFechaIda(): ?\DateTimeInterface
    {
        return $this->FechaIda;
    }

    public function setFechaIda(?\DateTimeInterface $FechaIda): static
    {
        $this->FechaIda = $FechaIda;

        return $this;
    }

    public function getFechaVuelta(): ?\DateTimeInterface
    {
        return $this->FechaVuelta;
    }

    public function setFechaVuelta(?\DateTimeInterface $FechaVuelta): static
    {
        $this->FechaVuelta = $FechaVuelta;

        return $this;
    }

    public function getNombreAerolinea(): ?string
    {
        return $this->NombreAerolinea;
    }

    public function setNombreAerolinea(?string $NombreAerolinea): static
    {
        $this->NombreAerolinea = $NombreAerolinea;

        return $this;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuario $usuario): static
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios->add($usuario);
            $usuario->addVuelo($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): static
    {
        if ($this->usuarios->removeElement($usuario)) {
            $usuario->removeVuelo($this);
        }

        return $this;
    }

}
