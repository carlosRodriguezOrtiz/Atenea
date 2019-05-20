<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    public $id;

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

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\DafoTipusQI", mappedBy="questioInterna", cascade={"persist", "remove"})
     */
    private $tipusDafo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Binomio", mappedBy="QuestionInterna")
     */
    private $binomio;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AspecteQ", mappedBy="questionsInternes")
     */
    private $aspecteQ;

    public function __construct()
    {
        $this->binomio = new ArrayCollection();
        $this->aspecteQ = new ArrayCollection();
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

    public function getTipusDafo(): ?DafoTipusQI
    {
        return $this->tipusDafo;
    }

    public function setTipusDafo(?DafoTipusQI $tipusDafo): self
    {
        $this->tipusDafo = $tipusDafo;

        // set (or unset) the owning side of the relation if necessary
        $newQuestioInterna = $tipusDafo === null ? null : $this;
        if ($newQuestioInterna !== $tipusDafo->getQuestioInterna()) {
            $tipusDafo->setQuestioInterna($newQuestioInterna);
        }

        return $this;
    }

    /**
     * @return Collection|Binomio[]
     */
    public function getBinomio(): Collection
    {
        return $this->binomio;
    }

    public function addBinomio(Binomio $binomio): self
    {
        if (!$this->binomio->contains($binomio)) {
            $this->binomio[] = $binomio;
            $binomio->setQuestionInterna($this);
        }

        return $this;
    }

    public function removeBinomio(Binomio $binomio): self
    {
        if ($this->binomio->contains($binomio)) {
            $this->binomio->removeElement($binomio);
            // set the owning side to null (unless already changed)
            if ($binomio->getQuestionInterna() === $this) {
                $binomio->setQuestionInterna(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AspecteQ[]
     */
    public function getAspecteQ(): Collection
    {
        return $this->aspecteQ;
    }

    public function addAspecteQ(AspecteQ $aspecteQ): self
    {
        if (!$this->aspecteQ->contains($aspecteQ)) {
            $this->aspecteQ[] = $aspecteQ;
            $aspecteQ->setQuestionsInternes($this);
        }

        return $this;
    }

    public function removeAspecteQ(AspecteQ $aspecteQ): self
    {
        if ($this->aspecteQ->contains($aspecteQ)) {
            $this->aspecteQ->removeElement($aspecteQ);
            // set the owning side to null (unless already changed)
            if ($aspecteQ->getQuestionsInternes() === $this) {
                $aspecteQ->setQuestionsInternes(null);
            }
        }

        return $this;
    }

}
