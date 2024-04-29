<?php

namespace App\Entity;

use App\Repository\EstimadorPrecioFinalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstimadorPrecioFinalRepository::class)]
class EstimadorPrecioFinal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'estimadorPrecioFinal', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function precioFinal(): integer{
        $productosReservados = $this->getUsuario()->getProductosReservados();
        $sumaTotal = 0;
        foreach($productosReservados as $productoReservado){
            //Debería identificar el tipo de clase del producto, y en base a eso hacer determinadas cuentas
            $sumaTotal= $sumaTotal + $productoReservado->getPrecio();
            }
    }
}
