<?php

namespace App\Controller;

use App\Entity\User;
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
     * @Route("/corporacion/busqueda", name="corporacion_busqueda")
     */
    public function search(Request $request)
    {
        $term = $request->request->get('term');

        $corporaciones = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->findLikeNom($term);

         
            $mensaje="";
        return $this->render('corporacion/list.html.twig', [
            'corporaciones' => $corporaciones,
            'searchTerm' => $term,
            'mensaje' => $mensaje,
        ]);  
    }



    /**
     * @Route("/corporacion/{id<\d+>}", name="corporacion")
     */
    public function view($id)
    {

        $usuariActual = $this->getUser();

        $userDB = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($usuariActual->getId());

        $corporacion = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->find($id);


            if ($corporacion != null) {


        if ($userDB->getRole()->getNombre() == "ROLE_ADMIN") {
            return $this->render('corporacion/view.html.twig', ['corporacion' => $corporacion, 'empresas' => $corporacion->getArrayEmpresa()]);

        } else {

            if ($userDB->getCorporacion()->getId() == $id) {

                return $this->render('corporacion/view.html.twig', ['corporacion' => $corporacion, 'empresas' => $corporacion->getArrayEmpresa()]);

            } else {

                $mensajeError = 'El usuario actual no puede acceder a esta corporacion';

                return $this->render('corporacion/errores.html.twig', ['mensajeError' => $mensajeError]);
            }

        }


    } else {
        $mensajeError = 'La corporacion  no existe!!';
                

        return $this->render('corporacion/errores.html.twig', [ 'mensajeError' => $mensajeError]);
    }

    }


    /**
     * @Route("/corporaciones/lista", name="corporaciones_list")
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
     * @Route("/corporacion/nueva", name="corporaciones_new")
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
                    'Nueva corporaciones ' . $corporaciones->getNombre() . ' creada!'
                );
    
                $corporacionCreada=true;
                $avisoCreacion = "La corporación ha sido creada con éxito.";

                $corporaciones = new Corporacion();
                $form = $this->createForm(corporacionesType::class, $corporaciones, array('submit' => 'Crear Corporación'));


            } else {
                $corporacionCreada=false;
                $avisoCreacion = "La corporación ya existe, porfavor introduzca una nueva.";
            }
          
        }

        return $this->render('corporacion/corporaciones.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nueva Corporación',
            'mensaje' => $avisoCreacion,
        ));
           
    }

    /**
     * @Route("/corporacion/editar/{id<\d+>}", name="corporacion_edit")
     */
    public function edit($id, Request $request)
    {
        $corporaciones = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->find($id);
            $avisoCreacion = "";
       
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
            $corporacionModificada = $this->getDoctrine()->getRepository(Corporacion::class)->findByNombre($corporaciones->getNombre());

            if(sizeof($corporacionModificada)== 0 ){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($corporaciones);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Corporaciones '.$corporaciones->getNombre().' modificadas!'
            );

            $corporacionModificada=true;
                $avisoCreacion = "La corporación ha sido modificada con éxito.";

            } else {
                $corporacionModificada=false;
                $avisoCreacion = "La corporación no se ha podido modificar.";
            }

            // return $this->redirectToRoute('corporaciones_list');
        }

        return $this->render('corporacion/corporaciones.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Editar Corporación',
            'mensaje' => $avisoCreacion,
        ));
    }

    /**
     * @Route("/corporacion/eliminar/{id<\d+>}", name="corporacion_delete")
     */
    public function delete($id, Request $request)
    {
        $mensajeErrorFK="";
        $corporacion = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->find($id);

        $empresas=$corporacion->getArrayEmpresa();   
        $usuarios = $corporacion->getUsers();

       if(sizeof($usuarios) !=0){
           $mensajeErrorFK="Error, no se ha podido eliminar esta corporación. Contiene uno o varios usuarios, por favor elimine préviamente los usuarios.";
        } else{
            if($empresas->isEmpty()){

                $entityManager = $this->getDoctrine()->getManager();
                $nomCorporacion = $corporacion->getNombre();
                $entityManager->remove($corporacion);
                $entityManager->flush();
                $mensajeErrorFK = "Corporación eliminada correctamente.";
        
                $this->addFlash(
                    'notice',
                    'Corporacion '.$nomCorporacion.' eliminada!'
                );
        
                }else {
                    $mensajeErrorFK="Error, no se ha podido eliminar esta corporación. Contiene una o varias empresas, por favor elimine préviamente las empresas.";
                }
        }
        return $this->redirectToRoute('corporaciones_list', array(
            'mensaje'=>$mensajeErrorFK,
            )
        );
    }
}
