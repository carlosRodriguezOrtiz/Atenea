<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipusQIRepository")
 */
class TipusQI
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
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionsInternes", mappedBy="tipus")
     */
    private $questionsInternes;

    public function __construct()
    {
        $this->questionsInternes = new ArrayCollection();
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

    /**
     * @return Collection|QuestionsInternes[]
     */
    public function getQuestionsInternes(): Collection
    {
        return $this->questionsInternes;
    }

    public function addQuestionsInterne(QuestionsInternes $questionsInterne): self
    {
        if (!$this->questionsInternes->contains($questionsInterne)) {
            $this->questionsInternes[] = $questionsInterne;
            $questionsInterne->setTipus($this);
        }

        return $this;
    }

    public function removeQuestionsInterne(QuestionsInternes $questionsInterne): self
    {
        if ($this->questionsInternes->contains($questionsInterne)) {
            $this->questionsInternes->removeElement($questionsInterne);
            // set the owning side to null (unless already changed)
            if ($questionsInterne->getTipus() === $this) {
                $questionsInterne->setTipus(null);
            }
        }

        return $this;
    }
}
