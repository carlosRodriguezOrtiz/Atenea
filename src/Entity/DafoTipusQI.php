<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DafoTipusQIRepository")
 */
class DafoTipusQI
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\QuestionsInternes", inversedBy="tipusDafo", cascade={"persist", "remove"})
     */
    private $questioInterna;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dafo", inversedBy="questionsInternes")
     */
    private $idDafo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestioInterna(): ?QuestionsInternes
    {
        return $this->questioInterna;
    }

    public function setQuestioInterna(?QuestionsInternes $questioInterna): self
    {
        $this->questioInterna = $questioInterna;

        return $this;
    }

    public function getTipus(): ?string
    {
        return $this->tipus;
    }

    public function setTipus(string $tipus): self
    {
        $this->tipus = $tipus;

        return $this;
    }

    public function getIdDafo(): ?Dafo
    {
        return $this->idDafo;
    }

    public function setIdDafo(?Dafo $idDafo): self
    {
        $this->idDafo = $idDafo;

        return $this;
    }
}
