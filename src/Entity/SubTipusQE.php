<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubTipusQERepository")
 */
class SubTipusQE
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
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipusQE", inversedBy="subtipus")
     */
    private $tipusQE;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getTipusQE(): ?TipusQE
    {
        return $this->tipusQE;
    }

    public function setTipusQE(?TipusQE $tipusQE): self
    {
        $this->tipusQE = $tipusQE;

        return $this;
    }
}
