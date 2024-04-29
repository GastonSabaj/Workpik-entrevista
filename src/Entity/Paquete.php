<?php

namespace App\Entity;

use App\Repository\PaqueteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaqueteRepository::class)]
class Paquete
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Producto>
     */
    #[ORM\OneToMany(targetEntity: Producto::class, mappedBy: 'paquete')]
    private Collection $Productos;

    public function __construct()
    {
        $this->Productos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Producto>
     */
    public function getProductos(): Collection
    {
        return $this->Productos;
    }

    public function addProducto(Producto $producto): static
    {
        if (!$this->Productos->contains($producto)) {
            $this->Productos->add($producto);
            $producto->setPaquete($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): static
    {
        if ($this->Productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getPaquete() === $this) {
                $producto->setPaquete(null);
            }
        }

        return $this;
    }
}
