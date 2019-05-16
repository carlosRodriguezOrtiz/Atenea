<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionsInternes", inversedBy="binomio")
     */
    private $questionInterna;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionsExternes", inversedBy="binomio")
     */
    private $questionExterna;

    /**
     * @ORM\Column(type="boolean")
     */
    private $selected;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionInterna(): ?QuestionsInternes
    {
        return $this->questionInterna;
    }

    public function setQuestionInterna(?QuestionsInternes $questionInterna): self
    {
        $this->questionInterna = $questionInterna;

        return $this;
    }

    public function getQuestionExterna(): ?QuestionsExternes
    {
        return $this->questionExterna;
    }

    public function setQuestionExterna(?QuestionsExternes $questionExterna): self
    {
        $this->questionExterna = $questionExterna;

        return $this;
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
}
