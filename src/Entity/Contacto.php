<?php

namespace App\Entity;

use App\Repository\ContactoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactoRepository::class)] 
class Contacto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $apellido = null;

    #[ORM\Column(type: 'string', length: 180)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private $correo;

    #[ORM\Column(type: 'string', length: 15)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: "/^\d{10,15}$/",
        message: "El celular debe contener entre 10 y 15 dígitos."
    )]
    private $celular;

    #[ORM\ManyToOne(targetEntity: AreaContacto::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
    private $area;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    private $mensaje;
	
	#[ORM\Column(type: 'datetime')]
    private $fecha_envio;

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

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): static
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): static
    {
        $this->correo = $correo;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(string $celular): static
    {
        $this->celular = $celular;

        return $this;
    }

    public function getArea(): ?AreaContacto
    {
        return $this->area;
    }

    public function setArea(?AreaContacto $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }

    public function setMensaje(string $mensaje): static
    {
        $this->mensaje = $mensaje;

        return $this;
    }
	
	public function getFechaEnvio(): ?\DateTimeInterface
    {
        return $this->fecha_envio;
    }

    public function setFechaEnvio(\DateTimeInterface $fecha_envio): self
    {
        $this->fecha_envio = $fecha_envio;

        return $this;
    }
}
