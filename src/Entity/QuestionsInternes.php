<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionsInternesRepository")
 */
class QuestionsInternes
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
     * @ORM\ManyToOne(targetEntity="App\Entity\TipusQI", inversedBy="questionsInternes")
     */
    private $tipus;

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

    public function getTipus(): ?TipusQI
    {
        return $this->tipus;
    }

    public function setTipus(?TipusQI $tipus): self
    {
        $this->tipus = $tipus;

        return $this;
    }
}
