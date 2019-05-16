<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InicioController extends AbstractController
{
    /**
     * @Route("/inicio", name="inicio")
     */
    public function index()
    {
        return $this->render('inicio/index.html.twig', [
            'controller_name' => 'InicioController',
        ]);
    }



    /**
     * @Route("/gestion-contextoEmpresa/{id<\d+>}", name="gestion_contextoEmpresa")
     */
    public function gestionContexto($id)
    {
        return $this->render('gestion_contexto/index.html.twig', array(

            'id' => $id,
        ));
    }


        /**
     * @Route("/gestion-contextoCentros/{id<\d+>}", name="gestion_contextoCentros")
     */
    public function gestionContextoCentros($id)
    {
        return $this->render('gestion_contexto/index.html.twig', array(

            'id' => $id,
        ));
    }

    

}
