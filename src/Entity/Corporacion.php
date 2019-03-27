<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CorporacionRepository")
 */
class Corporacion
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaAlta;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaBaja;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="userCorp")
     */
    private $usuarios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Empresa", mappedBy="corporaciones")
     */
    private $arrayEmpresa;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
        $this->arrayEmpresa = new ArrayCollection();
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

    public function setFechaAlta(?\DateTimeInterface $fechaAlta): self
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    public function getFechaBaja(): ?\DateTimeInterface
    {
        return $this->fechaBaja;
    }

    public function setFechaBaja(?\DateTimeInterface $fechaBaja): self
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
            $usuario->setUserCorp($this);
        }

        return $this;
    }

    public function removeUsuario(User $usuario): self
    {
        if ($this->usuarios->contains($usuario)) {
            $this->usuarios->removeElement($usuario);
            // set the owning side to null (unless already changed)
            if ($usuario->getUserCorp() === $this) {
                $usuario->setUserCorp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Empresa[]
     */
    public function getArrayEmpresa(): Collection
    {
        return $this->arrayEmpresa;
    }

    public function addArrayEmpresa(Empresa $arrayEmpresa): self
    {
        if (!$this->arrayEmpresa->contains($arrayEmpresa)) {
            $this->arrayEmpresa[] = $arrayEmpresa;
            $arrayEmpresa->setCorporaciones($this);
        }

        return $this;
    }

    public function removeArrayEmpresa(Empresa $arrayEmpresa): self
    {
        if ($this->arrayEmpresa->contains($arrayEmpresa)) {
            $this->arrayEmpresa->removeElement($arrayEmpresa);
            // set the owning side to null (unless already changed)
            if ($arrayEmpresa->getCorporaciones() === $this) {
                $arrayEmpresa->setCorporaciones(null);
            }
        }

        return $this;
    }
}
