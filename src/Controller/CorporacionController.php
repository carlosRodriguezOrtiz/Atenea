<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



use App\Form\CorporacionesType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Corporacion;


class CorporacionController extends AbstractController
{
    /**
     * @Route("/corporacion", name="corporacion")
     */
    public function index()
    {
        return $this->render('corporacion/index.html.twig', [
            'controller_name' => 'CorporacionController',
        ]);
    }


    /**
     * @Route("/corporaciones/list", name="corporaciones_list")
     */
    public function list()
    {
        $corporaciones = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->findAll();

       if(isset($_REQUEST['mensaje']) && $_REQUEST['mensaje'] == 'error'){
            return $this->render('corporacion/list.html.twig', ['corporaciones' => $corporaciones, 'mensaje' => "Error , no se ha podido eliminar esta corporación. Contiene una o varias empresas, por favor primero elimina esas empresas"]);
       }else {
            return $this->render('corporacion/list.html.twig', ['corporaciones' => $corporaciones, 'mensaje' => " "]);
       }

        
    }

       /**
     * @Route("/corporaciones/new", name="corporaciones_new")
     */
    public function new(Request $request)
    {
        $corporaciones= new Corporacion();

        $form = $this->createForm(CorporacionesType::class , $corporaciones, array ('submit'=>'Crear Corporacion'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $corporaciones = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($corporaciones);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nueva corporacion '.$corporaciones->getNombre() .' creada!'
            );

            return $this->redirectToRoute('login'); 
        }

        return $this->render('corporacion/corporaciones.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nueva corporacion',
        ));
    }

    /**
     * @Route("/corporaciones/edit/{id<\d+>}", name="corporacion_edit")
     */
    public function edit($id, Request $request)
    {
        $corporaciones = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->find($id);

       
        $form = $this->createForm(CorporacionesType::class, $corporaciones, array('submit'=>'Desar'));
        

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $corporaciones = $form->getData();
            
       

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($corporaciones);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Corporaciones '.$corporaciones->getNombre().' desada!'
            );

            return $this->redirectToRoute('corporaciones_list');
        }

        return $this->render('corporacion/corporaciones.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Editar corporaciones',
        ));
    }

    /**
     * @Route("/corporaciones/delete/{id<\d+>}", name="corporacion_delete")
     */
    public function delete($id, Request $request)
    {
        $mensajeErrorFK="";
        $corporaciones = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->find($id);

        $empresas=$corporaciones->getArrayEmpresa();   

         
        
        if($empresitas->isEmpty()){


                                   
         

        $entityManager = $this->getDoctrine()->getManager();
        $nomCorporaciones = $corporaciones->getNombre();
        $entityManager->remove($corporaciones);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Corporacion '.$nomCorporaciones.' eliminada!'
        );

        }else {
            $mensajeErrorFK="error";
        }
    
        return $this->redirectToRoute('corporaciones_list', array(
            'mensaje'=>$mensajeErrorFK,
            )
        );
    }
}
