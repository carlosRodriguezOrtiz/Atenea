<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AspecteQRepository")
 */
class AspecteQ
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dafo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $alta;

    /**
     * @ORM\Column(type="datetime")
     */
    private $baixa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionsExternes", inversedBy="aspecteQs")
     */
    private $CuestionesExternas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionsInternes", inversedBy="aspecteQs")
     */
    private $CuestionesInternas;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Binomio", mappedBy="AspectesQ")
     */
    private $binomios;

    public function __construct()
    {
        $this->binomios = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDafo(): ?string
    {
        return $this->dafo;
    }

    public function setDafo(string $dafo): self
    {
        $this->dafo = $dafo;

        return $this;
    }

    public function getAlta(): ?\DateTimeInterface
    {
        return $this->alta;
    }

    public function setAlta(\DateTimeInterface $alta): self
    {
        $this->alta = $alta;

        return $this;
    }

    public function getBaixa(): ?\DateTimeInterface
    {
        return $this->baixa;
    }

    public function setBaixa(\DateTimeInterface $baixa): self
    {
        $this->baixa = $baixa;

        return $this;
    }

    public function getDescripcio(): ?string
    {
        return $this->descripcio;
    }

    public function setDescripcio(string $descripcio): self
    {
        $this->descripcio = $descripcio;

        return $this;
    }

    public function getCuestionesExternas(): ?QuestionsExternes
    {
        return $this->CuestionesExternas;
    }

    public function setCuestionesExternas(?QuestionsExternes $CuestionesExternas): self
    {
        $this->CuestionesExternas = $CuestionesExternas;

        return $this;
    }

    public function getCuestionesInternas(): ?QuestionsInternes
    {
        return $this->CuestionesInternas;
    }

    public function setCuestionesInternas(?QuestionsInternes $CuestionesInternas): self
    {
        $this->CuestionesInternas = $CuestionesInternas;

        return $this;
    }

    /**
     * @return Collection|Binomio[]
     */
    public function getBinomios(): Collection
    {
        return $this->binomios;
    }

    public function addBinomio(Binomio $binomio): self
    {
        if (!$this->binomios->contains($binomio)) {
            $this->binomios[] = $binomio;
            $binomio->addAspectesQ($this);
        }

        return $this;
    }

    public function removeBinomio(Binomio $binomio): self
    {
        if ($this->binomios->contains($binomio)) {
            $this->binomios->removeElement($binomio);
            $binomio->removeAspectesQ($this);
        }

        return $this;
    }
}
