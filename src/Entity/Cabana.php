<?php

namespace App\Entity;

use App\Repository\CabanaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CabanaRepository::class)]
class Cabana extends Casa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Casa>
     */
    #[ORM\OneToMany(targetEntity: Casa::class, mappedBy: 'cabana')]
    private Collection $Casas;

    private $Precio;

    public function __construct()
    {
        $this->Casas = new ArrayCollection();
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(?int $precio): static {
        $precioFinal = 0;
        
        if ($this->Casas == 1) {
            // Aplicar un 10% de descuento
            $this->precio = (int) ($precio * 0.9);
        } elseif ($this->Casas < 5) {
            foreach ($this->Casas as $casa) {
                // Sumar al precio final el precio de las casas con un 10% de descuento a cada una
                $precioFinal += (int) ($casa->getPrecio() * 0.9);
            }
            $this->precio = $precioFinal;
        } else {
            foreach ($this->Casas as $casa) {
                // Sumar al precio final el precio de las casas con un 50% de descuento en cada una
                $precioFinal += (int) ($casa->getPrecio() * 0.5);
            }
            $this->precio = $precioFinal;
        }
    
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Casa>
     */
    public function getCasas(): Collection
    {
        return $this->Casas;
    }

    public function addCasa(Casa $casa): static
    {
        if (!$this->Casas->contains($casa)) {
            $this->Casas->add($casa);
            $casa->setCabana($this);
        }

        return $this;
    }

    public function removeCasa(Casa $casa): static
    {
        if ($this->Casas->removeElement($casa)) {
            // set the owning side to null (unless already changed)
            if ($casa->getCabana() === $this) {
                $casa->setCabana(null);
            }
        }
        return $this;
    }
}
