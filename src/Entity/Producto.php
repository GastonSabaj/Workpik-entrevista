<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Productos')]
    private ?Paquete $paquete = null;

    #[ORM\ManyToOne(inversedBy: 'productosReservados')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    public function __construct(string $tipo)
    {
        switch ($tipo) {
            case 'vuelo':
                $this->producto = new Vuelo();
                break;
            case 'alojamiento':
                $this->producto = new Alojamiento();
                break;
            default:
                throw new \InvalidArgumentException("Tipo de producto no válido: $tipo");
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaquete(): ?Paquete
    {
        return $this->paquete;
    }

    public function setPaquete(?Paquete $paquete): static
    {
        $this->paquete = $paquete;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }
}
