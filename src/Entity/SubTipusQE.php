<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionsExternes", mappedBy="subtipus")
     */
    private $questionsExternes;

    public function __construct()
    {
        $this->questionsExternes = new ArrayCollection();
    }

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

    /**
     * @return Collection|QuestionsExternes[]
     */
    public function getQuestionsExternes(): Collection
    {
        return $this->questionsExternes;
    }

    public function addQuestionsExterne(QuestionsExternes $questionsExterne): self
    {
        if (!$this->questionsExternes->contains($questionsExterne)) {
            $this->questionsExternes[] = $questionsExterne;
            $questionsExterne->setSubtipus($this);
        }

        return $this;
    }

    public function removeQuestionsExterne(QuestionsExternes $questionsExterne): self
    {
        if ($this->questionsExternes->contains($questionsExterne)) {
            $this->questionsExternes->removeElement($questionsExterne);
            // set the owning side to null (unless already changed)
            if ($questionsExterne->getSubtipus() === $this) {
                $questionsExterne->setSubtipus(null);
            }
        }

        return $this;
    }
}
