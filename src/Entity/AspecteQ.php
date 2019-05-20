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
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionsExternes", inversedBy="aspecteQ")
     */
    private $questionsExternes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionsInternes", inversedBy="aspecteQ")
     */
    private $questionsInternes;

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

    public function getQuestionsExternes(): ?QuestionsExternes
    {
        return $this->questionsExternes;
    }

    public function setQuestionsExternes(?QuestionsExternes $questionsExternes): self
    {
        $this->questionsExternes = $questionsExternes;

        return $this;
    }

    public function getQuestionsInternes(): ?QuestionsInternes
    {
        return $this->questionsInternes;
    }

    public function setQuestionsInternes(?QuestionsInternes $questionsInternes): self
    {
        $this->questionsInternes = $questionsInternes;

        return $this;
    }
}
