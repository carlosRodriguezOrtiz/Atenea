<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmpresaRepository")
 */
class Empresa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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

    ///**
    // * @ORM\Column(type="integer", nullable=true)
     //*/
  

    //private $usuarios;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Corporacion", inversedBy="arrayEmpresa")
     */
    private $corporaciones;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Centro", mappedBy="empresas")
     */
    private $arrayCentros;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="empresa")
     */
    private $users;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
        $this->arrayCentros = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
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

    public function getIdCorporacion(): ?int
    {
        return $this->idCorporacion;
    }

    public function setIdCorporacion(?int $idCorporacion): self
    {
        $this->idCorporacion = $idCorporacion;

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
            $usuario->setUserEmp($this);
        }

        return $this;
    }

    public function removeUsuario(User $usuario): self
    {
        if ($this->usuarios->contains($usuario)) {
            $this->usuarios->removeElement($usuario);
            // set the owning side to null (unless already changed)
            if ($usuario->getUserEmp() === $this) {
                $usuario->setUserEmp(null);
            }
        }

        return $this;
    }

    public function getCorporaciones(): ?Corporacion
    {
        return $this->corporaciones;
    }

    public function setCorporaciones(?Corporacion $corporaciones): self
    {
        $this->corporaciones = $corporaciones;

        return $this;
    }

    /**
     * @return Collection|Centro[]
     */
    public function getArrayCentros(): Collection
    {
        return $this->arrayCentros;
    }

    public function addArrayCentro(Centro $arrayCentro): self
    {
        if (!$this->arrayCentros->contains($arrayCentro)) {
            $this->arrayCentros[] = $arrayCentro;
            $arrayCentro->setEmpresas($this);
        }

        return $this;
    }

    public function removeArrayCentro(Centro $arrayCentro): self
    {
        if ($this->arrayCentros->contains($arrayCentro)) {
            $this->arrayCentros->removeElement($arrayCentro);
            // set the owning side to null (unless already changed)
            if ($arrayCentro->getEmpresas() === $this) {
                $arrayCentro->setEmpresas(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setEmpresa($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getEmpresa() === $this) {
                $user->setEmpresa(null);
            }
        }

        return $this;
    }
}
