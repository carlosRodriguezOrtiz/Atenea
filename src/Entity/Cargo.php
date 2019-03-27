<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CargoRepository")
 */
class Cargo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaAlta;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaBaja;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $responsabilidades;

    /**
     * @ORM\Column(type="array")
     */
    private $formacionNecesarria = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta(\DateTimeInterface $fechaAlta): self
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    public function getFechaBaja(): ?\DateTimeInterface
    {
        return $this->fechaBaja;
    }

    public function setFechaBaja(\DateTimeInterface $fechaBaja): self
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    public function getResponsabilidades(): ?string
    {
        return $this->responsabilidades;
    }

    public function setResponsabilidades(string $responsabilidades): self
    {
        $this->responsabilidades = $responsabilidades;

        return $this;
    }

    public function getFormacionNecesarria(): ?array
    {
        return $this->formacionNecesarria;
    }

    public function setFormacionNecesarria(array $formacionNecesarria): self
    {
        $this->formacionNecesarria = $formacionNecesarria;

        return $this;
    }
}
