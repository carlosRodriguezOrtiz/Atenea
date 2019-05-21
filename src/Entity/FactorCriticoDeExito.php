<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactorCriticoDeExitoRepository")
 */
class FactorCriticoDeExito
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $alta;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $baja;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Binomio", inversedBy="factorCriticoDeExito", cascade={"persist", "remove"})
     */
    private $binomio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlta(): ?\DateTimeInterface
    {
        return $this->alta;
    }

    public function setAlta(?\DateTimeInterface $alta): self
    {
        $this->alta = $alta;

        return $this;
    }

    public function getBaja(): ?\DateTimeInterface
    {
        return $this->baja;
    }

    public function setBaja(?\DateTimeInterface $baja): self
    {
        $this->baja = $baja;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getBinomio(): ?Binomio
    {
        return $this->binomio;
    }

    public function setBinomio(?Binomio $binomio): self
    {
        $this->binomio = $binomio;

        return $this;
    }
}
