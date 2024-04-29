<?php

namespace App\Entity;

use App\Repository\AlojamientoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     "alojamiento" = "Alojamiento",
 *     "casa" = "Casa",
 *     "cabana" = "Cabana",
 *     // Agrega otros tipos aquí si es necesario
 * })
 */
#[ORM\Entity(repositoryClass: AlojamientoRepository::class)]
class Alojamiento 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $precio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $direccion = null;

    /**
     * @var Collection<int, Usuario>
     */
    #[ORM\ManyToMany(targetEntity: Usuario::class, mappedBy: 'Alojamientos')]
    private Collection $usuarios;

    #[ORM\Column]
    private ?int $Noches = null;

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
        return $this->precio;
    }

    public function setPrecio(?int $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): static
    {
        $this->direccion = $direccion;

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
            $usuario->addAlojamiento($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): static
    {
        if ($this->usuarios->removeElement($usuario)) {
            $usuario->removeAlojamiento($this);
        }

        return $this;
    }

    public function getNoches(): ?int
    {
        return $this->Noches;
    }

    public function setNoches(int $Noches): static
    {
        $this->Noches = $Noches;

        return $this;
    }
}
