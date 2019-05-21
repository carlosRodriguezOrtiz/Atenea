<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BinomioRepository")
 */
class Binomio
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $selected;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AspecteQ", inversedBy="binomios")
     */
    private $AspectesQ;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\FactorCriticoDeExito", mappedBy="binomio", cascade={"persist", "remove"})
     */
    private $factorCriticoDeExito;

    public function __construct()
    {
        $this->AspectesQ = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSelected(): ?bool
    {
        return $this->selected;
    }

    public function setSelected(bool $selected): self
    {
        $this->selected = $selected;

        return $this;
    }

    /**
     * @return Collection|AspecteQ[]
     */
    public function getAspectesQ(): Collection
    {
        return $this->AspectesQ;
    }

    public function addAspectesQ(AspecteQ $aspectesQ): self
    {
        if (!$this->AspectesQ->contains($aspectesQ)) {
            $this->AspectesQ[] = $aspectesQ;
        }

        return $this;
    }

    public function removeAspectesQ(AspecteQ $aspectesQ): self
    {
        if ($this->AspectesQ->contains($aspectesQ)) {
            $this->AspectesQ->removeElement($aspectesQ);
        }

        return $this;
    }

    public function getFactorCriticoDeExito(): ?FactorCriticoDeExito
    {
        return $this->factorCriticoDeExito;
    }

    public function setFactorCriticoDeExito(?FactorCriticoDeExito $factorCriticoDeExito): self
    {
        $this->factorCriticoDeExito = $factorCriticoDeExito;

        // set (or unset) the owning side of the relation if necessary
        $newBinomio = $factorCriticoDeExito === null ? null : $this;
        if ($newBinomio !== $factorCriticoDeExito->getBinomio()) {
            $factorCriticoDeExito->setBinomio($newBinomio);
        }

        return $this;
    }
}
