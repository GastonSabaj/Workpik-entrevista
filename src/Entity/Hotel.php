<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
class Hotel extends Alojamiento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Nombre = null;

    #[ORM\Column]
    private ?int $CantidadEstrellas = null;

    #[ORM\Column(nullable: true)]
    private ?int $precio = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(?string $Nombre): static
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getCantidadEstrellas(): ?int
    {
        return $this->CantidadEstrellas;
    }

    public function setCantidadEstrellas(int $CantidadEstrellas): static
    {
        $this->CantidadEstrellas = $CantidadEstrellas;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(?int $precio): static
    {
        $this->precio = 10000*($this->CantidadEstrellas)*($this->Noches);

        return $this;
    }
}
