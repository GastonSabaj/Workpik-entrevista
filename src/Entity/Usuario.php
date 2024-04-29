<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $Presupuesto = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NombreUsuario = null;

    /**
     * @var Collection<int, Producto>
     */
    #[ORM\OneToMany(targetEntity: Producto::class, mappedBy: 'usuario')]
    private Collection $productosReservados;

    #[ORM\OneToOne(mappedBy: 'usuario', cascade: ['persist', 'remove'])]
    private ?EstimadorPrecioFinal $estimadorPrecioFinal = null;


    public function __construct()
    {
        $this->Vuelos = new ArrayCollection();
        $this->Alojamientos = new ArrayCollection();
        $this->productosReservados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresupuesto(): ?int
    {
        return $this->Presupuesto;
    }

    public function setPresupuesto(?int $Presupuesto): static
    {
        $this->Presupuesto = $Presupuesto;

        return $this;
    }

    public function getNombreUsuario(): ?string
    {
        return $this->NombreUsuario;
    }

    public function setNombreUsuario(?string $NombreUsuario): static
    {
        $this->NombreUsuario = $NombreUsuario;

        return $this;
    }

    /**
     * @return Collection<int, Producto>
     */
    public function getProductosReservados(): Collection
    {
        return $this->productosReservados;
    }

    public function addProductosReservados(Producto $productosReservado): static
    {
        if (!$this->productosReservados->contains($productosReservado)) {
            $this->productosReservados->add($productosReservado);
            $productosReservado->setUsuario($this);
        }

        return $this;
    }

    public function removeProductosReservados(Producto $productosReservado): static
    {
        if ($this->productosReservados->removeElement($productosReservado)) {
            // set the owning side to null (unless already changed)
            if ($productosReservado->getUsuario() === $this) {
                $productosReservado->setUsuario(null);
            }
        }

        return $this;
    }

    public function getEstimadorPrecioFinal(): ?EstimadorPrecioFinal
    {
        return $this->estimadorPrecioFinal;
    }

    public function setEstimadorPrecioFinal(EstimadorPrecioFinal $estimadorPrecioFinal): static
    {
        // set the owning side of the relation if necessary
        if ($estimadorPrecioFinal->getUsuario() !== $this) {
            $estimadorPrecioFinal->setUsuario($this);
        }

        $this->estimadorPrecioFinal = $estimadorPrecioFinal;

        return $this;
    }
}
