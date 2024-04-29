<?php

namespace App\Entity;

use App\Repository\CasaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CasaRepository::class)]
class Casa extends Alojamiento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $CantidadAmbientes = null;

    #[ORM\Column(nullable: true)]
    private ?int $precio = null;

    #[ORM\ManyToOne(inversedBy: 'Casas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cabana $cabana = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidadAmbientes(): ?int
    {
        return $this->CantidadAmbientes;
    }

    public function setCantidadAmbientes(?int $CantidadAmbientes): static
    {
        $this->CantidadAmbientes = $CantidadAmbientes;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(?int $precio): static
    {
        if ($this->CantidadAmbientes == 1){
            $this->precio = 15000;
        }
        else if($this->CantidadAmbientes >=2 && $this->CantidadAmbientes <=4){
            $this->precio = 30000;
        }
        else{
            $this->precio = 50000;
        }

        return $this;
    }

    public function getCabana(): ?Cabana
    {
        return $this->cabana;
    }

    public function setCabana(?Cabana $cabana): static
    {
        $this->cabana = $cabana;

        return $this;
    }
}
