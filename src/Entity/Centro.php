<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CentroRepository")
 */
class Centro
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
     * @ORM\Column(type="datetime")
     */
    private $fechaAlta;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaBaja;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
 
    private $usuarios;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Empresa", inversedBy="arrayCentros")
     */
    private $empresas;

    public function __construct()
    {
       //$this->usuarios = new ArrayCollection();
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

    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta(\DateTimeInterface $fechaAlta): self
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    public function getFechaBaja(): ?\DateTimeInterface
    {
        return $this->fechaBaja;
    }

    public function setFechaBaja(\DateTimeInterface $fechaBaja): self
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getIdEmpresa(): ?int
    {
        return $this->idEmpresa;
    }

    public function setIdEmpresa(?int $idEmpresa): self
    {
        $this->idEmpresa = $idEmpresa;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(User $usuario): self
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios[] = $usuario;
            $usuario->setUserCent($this);
        }

        return $this;
    }

    public function removeUsuario(User $usuario): self
    {
        if ($this->usuarios->contains($usuario)) {
            $this->usuarios->removeElement($usuario);
            // set the owning side to null (unless already changed)
            if ($usuario->getUserCent() === $this) {
                $usuario->setUserCent(null);
            }
        }

        return $this;
    }

    public function getEmpresas(): ?Empresa
    {
        return $this->empresas;
    }

    public function setEmpresas(?Empresa $empresas): self
    {
        $this->empresas = $empresas;

        return $this;
    }
}
