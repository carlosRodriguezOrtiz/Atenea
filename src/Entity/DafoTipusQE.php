<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DafoTipusQERepository")
 */
class DafoTipusQE
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\QuestionsExternes", inversedBy="tipusDafo", cascade={"persist", "remove"})
     */
    private $questioExterna;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dafo", inversedBy="questionsExternes")
     */
    private $idDafo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestioExterna(): ?QuestionsExternes
    {
        return $this->questioExterna;
    }

    public function setQuestioExterna(?QuestionsExternes $questioExterna): self
    {
        $this->questioExterna = $questioExterna;

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
