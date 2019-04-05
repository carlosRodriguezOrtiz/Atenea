<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipusQERepository")
 */
class TipusQE
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
     * @ORM\OneToMany(targetEntity="App\Entity\SubTipusQE", mappedBy="tipusQE")
     */
    private $subtipus;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionsExternes", mappedBy="tipus")
     */
    private $questionsExternes;

    public function __construct()
    {
        $this->subtipus = new ArrayCollection();
        $this->questionsExternes = new ArrayCollection();
    }

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

    /**
     * @return Collection|SubTipusQE[]
     */
    public function getSubtipus(): Collection
    {
        return $this->subtipus;
    }

    public function addSubtipus(SubTipusQE $subtipus): self
    {
        if (!$this->subtipus->contains($subtipus)) {
            $this->subtipus[] = $subtipus;
            $subtipus->setTipusQE($this);
        }

        return $this;
    }

    public function removeSubtipus(SubTipusQE $subtipus): self
    {
        if ($this->subtipus->contains($subtipus)) {
            $this->subtipus->removeElement($subtipus);
            // set the owning side to null (unless already changed)
            if ($subtipus->getTipusQE() === $this) {
                $subtipus->setTipusQE(null);
            }
        }

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
            $questionsExterne->setTipus($this);
        }

        return $this;
    }

    public function removeQuestionsExterne(QuestionsExternes $questionsExterne): self
    {
        if ($this->questionsExternes->contains($questionsExterne)) {
            $this->questionsExternes->removeElement($questionsExterne);
            // set the owning side to null (unless already changed)
            if ($questionsExterne->getTipus() === $this) {
                $questionsExterne->setTipus(null);
            }
        }

        return $this;
    }
}
