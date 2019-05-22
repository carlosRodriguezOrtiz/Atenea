<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Centro;
use App\Entity\Corporacion;
use App\Entity\Empresa;
use App\Entity\User;

class ContextoController extends AbstractController
{


    /**
     * @Route("/gestion-contextoCorporacion/{id<\d+>}", name="gestion_contextoCorporacion")
     */
    public function gestionContextoCorporacion($id)
    {
        return $this->render('gestion_contexto/indexCorporacion.html.twig', array(

            'id' => $id,
        ));
    }


    /**
     * @Route("/gestion-contextoEmpresa/{id<\d+>}", name="gestion_contextoEmpresa")
     */
    public function gestionContexto($id)
    {
        return $this->render('gestion_contexto/indexEmpresa.html.twig', array(

            'id' => $id,
        ));
    }


        /**
     * @Route("/gestion-contextoCentros/{id<\d+>}", name="gestion_contextoCentros")
     */
    public function gestionContextoCentros($id)
    {
        return $this->render('gestion_contexto/indexCentro.html.twig', array(

            'id' => $id,
        ));
    }

    /**
     * @Route("/empresa/contexto", name="contexto-empresa")
     */
    public function contextoUser()
    {
        $usuariActual = $this->getUser();

        $userDB = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($usuariActual->getId());
        $idEmpresa = $userDB->getEmpresa()->getId();
        if ($userDB->getCorporacion() == null) {
            $empresas = $userDB->getEmpresa();
            $centros = null;
            if ($empresas != null) {
                $centros =  $empresas->getArrayCentros();
            }
        } else if ($userDB->getCorporacion() != null) {
            $empresas = $userDB->getCorporacion()->getArrayEmpresa();
            $centros = [];
            foreach ($empresas as $empresa) {
                foreach ($empresa->getArrayCentros() as $centro) {
                    array_push($centros, $centro);
                }
            }
        }

        return $this->render('emergente/list.empresa.html.twig', ['centros' => $centros, 'id' => $idEmpresa]);
    }

    /**
     * @Route("/corporacion/contexto", name="contexto-corporacion")
     */
    public function contextoCorp()
    {
        $usuariActual = $this->getUser();

        $userDB = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($usuariActual->getId());
        $idCorp =  $userDB->getCorporacion()->getId();
        if ($userDB->getCorporacion() == null) {
            $empresas = $userDB->getEmpresa();
            $centros = null;
            if ($empresas != null) {
                $centros =  $empresas->getArrayCentros();
            }
        } else if ($userDB->getCorporacion() != null) {
            $empresas = $userDB->getCorporacion()->getArrayEmpresa();
            $centros = [];
            foreach ($empresas as $empresa) {
                foreach ($empresa->getArrayCentros() as $centro) {
                    array_push($centros, $centro);
                }
            }
        }
        return $this->render('emergente/list.corp.html.twig', ['empresas' => $empresas,  'centros' => $centros, 'id' => $idCorp]);
        
    }

    /**
     * @Route("/empresa/contexto", name="contexto")
     */
    public function contexto()
    {
        $empresas = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->findAll();
        $centros = $this->getDoctrine()
            ->getRepository(Centro::class)
            ->findAll();

        if (isset($_REQUEST['mensaje']) && $_REQUEST['mensaje'] != "") {
            return $this->render('emergente/list.html.twig', ['empresas' => $empresas, 'mensaje' => $_REQUEST['mensaje']]);
        } else {
            return $this->render('emergente/list.html.twig', ['empresas' => $empresas, 'centros' => $centros]);
        }
    }
}
