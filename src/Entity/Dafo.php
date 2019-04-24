<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DafoRepository")
 */
class Dafo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DafoTipusQI", mappedBy="idDafo")
     */
    private $questionsInternes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DafoTipusQE", mappedBy="idDafo")
     */
    private $questionsExternes;

    public function __construct()
    {
        $this->questionsInternes = new ArrayCollection();
        $this->questionsExternes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|DafoTipusQI[]
     */
    public function getQuestionsInternes(): Collection
    {
        return $this->questionsInternes;
    }

    public function addQuestionsInterne(DafoTipusQI $questionsInterne): self
    {
        if (!$this->questionsInternes->contains($questionsInterne)) {
            $this->questionsInternes[] = $questionsInterne;
            $questionsInterne->setIdDafo($this);
        }

        return $this;
    }

    public function removeQuestionsInterne(DafoTipusQI $questionsInterne): self
    {
        if ($this->questionsInternes->contains($questionsInterne)) {
            $this->questionsInternes->removeElement($questionsInterne);
            // set the owning side to null (unless already changed)
            if ($questionsInterne->getIdDafo() === $this) {
                $questionsInterne->setIdDafo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DafoTipusQE[]
     */
    public function getQuestionsExternes(): Collection
    {
        return $this->questionsExternes;
    }

    public function addQuestionsExterne(DafoTipusQE $questionsExterne): self
    {
        if (!$this->questionsExternes->contains($questionsExterne)) {
            $this->questionsExternes[] = $questionsExterne;
            $questionsExterne->setIdDafo($this);
        }

        return $this;
    }

    public function removeQuestionsExterne(DafoTipusQE $questionsExterne): self
    {
        if ($this->questionsExternes->contains($questionsExterne)) {
            $this->questionsExternes->removeElement($questionsExterne);
            // set the owning side to null (unless already changed)
            if ($questionsExterne->getIdDafo() === $this) {
                $questionsExterne->setIdDafo(null);
            }
        }

        return $this;
    }

    

}
