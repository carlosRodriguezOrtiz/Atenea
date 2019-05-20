<?php

namespace App\Entity;

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
     * @ORM\OneToOne(targetEntity="App\Entity\QuestionsExternes", inversedBy="aspecteQ", cascade={"persist", "remove"})
     */
    private $questioExterna;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\QuestionsInternes", inversedBy="aspecteQ", cascade={"persist", "remove"})
     */
    private $questioInterna;


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

    public function getQuestioExterna(): ?QuestionsExternes
    {
        return $this->questioExterna;
    }

    public function setQuestioExterna(?QuestionsExternes $questioExterna): self
    {
        $this->questioExterna = $questioExterna;

        return $this;
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
}
