<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
     * @Route("/corporacion/{id<\d+>}", name="corporacion")
     */
    public function view($id)
    {
        $corporacion = $this->getDoctrine()
        ->getRepository(Corporacion::class)
        ->find($id);

        return $this->render('corporacion/view.html.twig', ['corporacion'=>$corporacion,'empresas' => $corporacion->getArrayEmpresa()]);
    }


    /**
     * @Route("/corporaciones/list", name="corporaciones_list")
     */
    public function list()
    {
        $corporaciones = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->findAll();

       if(isset($_REQUEST['mensaje']) && $_REQUEST['mensaje']!=""){
            return $this->render('corporacion/list.html.twig', ['corporaciones' => $corporaciones, 'mensaje' => $_REQUEST['mensaje']]);
       }else {
            return $this->render('corporacion/list.html.twig', ['corporaciones' => $corporaciones, 'mensaje' => " "]);
       }

        
    }

       /**
     * @Route("/corporacion/new", name="corporaciones_new")
     */
    public function new(Request $request)
    {
        $corporaciones= new Corporacion();
        $corporacionCreada=false;
        $avisoCreacion = "";
        $form = $this->createForm(CorporacionesType::class , $corporaciones, array ('submit'=>'Crear Corporación'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $corporaciones = $form->getData();
            $corporacioncreada = $this->getDoctrine()->getRepository(Corporacion::class)->findByNombre($corporaciones->getNombre());

            if(sizeof($corporacioncreada)== 0 ){
               
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($corporaciones);
                $entityManager->flush();
    
                $this->addFlash(
                    'notice',
                    'Nova corporaciones ' . $corporaciones->getNombre() . ' creada!'
                );
    
                $corporacionCreada=true;
                $avisoCreacion = "La corporacion ha sido creada";

                $corporaciones = new Corporacion();
                $form = $this->createForm(corporacionesType::class, $corporaciones, array('submit' => 'Crear Corporación'));


            } else {
                $corporacionCreada=false;
                $avisoCreacion = "La empresa ya existe , porfavor introduzca una nueva";

              
    
            }
          
        }

        return $this->render('corporacion/corporaciones.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nueva corporacion',
            'mensaje' => $avisoCreacion,
        ));
           
    }

    /**
     * @Route("/corporacion/edit/{id<\d+>}", name="corporacion_edit")
     */
    public function edit($id, Request $request)
    {
        $corporaciones = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->find($id);

       
        $form = $this->createForm(CorporacionesType::class, $corporaciones, array('submit'=>'Desar'));
        $form->add('FechaAlta', DateType::class, array(
            "widget" => 'single_text',
            "format" => 'yyyy-MM-dd'));
        $form->add('FechaBaja', DateType::class, array(
                "widget" => 'single_text',
                "format" => 'yyyy-MM-dd'));

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
     * @Route("/corporacion/delete/{id<\d+>}", name="corporacion_delete")
     */
    public function delete($id, Request $request)
    {
        $mensajeErrorFK="";
        $corporacion = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->find($id);

        $empresas=$corporacion->getArrayEmpresa();   
        //$usuarios = $corporacion->getUsuarios();
       // if(!$usuarios->isEmpty()){
         //   $mensajeErrorFK="Error, no se ha podido eliminar esta corporación. Contiene uno o varios usuarios, por favor primero elimina esos usuarios.";
        //} else{
            if($empresas->isEmpty()){

                $entityManager = $this->getDoctrine()->getManager();
                $nomCorporacion = $corporacion->getNombre();
                $entityManager->remove($corporacion);
                $entityManager->flush();
        
                $this->addFlash(
                    'notice',
                    'Corporacion '.$nomCorporacion.' eliminada!'
                );
        
                }else {
                    $mensajeErrorFK="Error, no se ha podido eliminar esta corporación. Contiene una o varias empresas, por favor primero elimina esas empresas.";
                }
        //}
        return $this->redirectToRoute('corporaciones_list', array(
            'mensaje'=>$mensajeErrorFK,
            )
        );
    }
}
