<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CentrosType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Centro;
use App\Entity\Empresa;
use App\Entity\User;




class CentroController extends AbstractController
{
    /**
     * @Route("/centro", name="centro")
     */
    public function index()
    {
        return $this->render('centro/index.html.twig', [
            'controller_name' => 'CentroController',
        ]);
    }
 /**
     * @Route("/centro/{id<\d+>}", name="centro")
     */
    public function view($id)
    {

        $usuariActual = $this->getUser();

        $userDB = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($usuariActual->getId());

        $centro = $this->getDoctrine()
        ->getRepository(Centro::class)
        ->find($id);

        if ($userDB->getRole()->getNombre() == "ROLE_ADMIN") {
            return $this->render('centro/view.html.twig', ['centro' => $centro]);

        } else {

            if ($userDB->getCentro()->getId() == $id) {

                return $this->render('centro/view.html.twig', ['centro' => $centro]);

            } else {

                $mensajeError = 'El usuario actual no puede acceder a esta empresa';
                

                return $this->render('centro/errores.html.twig', [ 'mensajeError' => $mensajeError]);
            }

        }

    }

   /**
     * @Route("/centros/nuevo/{id<\d+>}", name="centros_new")
     */
    public function new($id ,Request $request)
    {
        $centros= new Centro();
        $centroCreada=false;
        $avisoCreacion = "";
        $form = $this->createForm(CentrosType::class , $centros, array ('submit'=>'Crear Centro'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
     
            $centros = $form->getData();
            $centrocreado = $this->getDoctrine()->getRepository(Centro::class)->findByNombre($centros->getNombre());

            if(sizeof($centrocreado)== 0 ){
            $empresas = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->find($id);

            $centros->setEmpresas($empresas);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($centros);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nuevos centros '.$centros->getNombre() .' creado!'
            );

            $centroCreada=true;
            $avisoCreacion = "El centro ha sido creado";

            $centros = new Centro();
            $form = $this->createForm(CentrosType::class, $centros, array('submit' => 'Crear Centro'));


         } else {
            $centroCreada=false;
            $avisoCreacion = "El centro ya existe , porfavor introduzca uno nuevo";

          

        }
    }
        return $this->render('centro/centros.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nuevo Centro',
            'mensaje' => $avisoCreacion,
        ));
    }

     /**
     * @Route("/centros/lista", name="centros_list")
     */
    public function list()
    {
        $centro = $this->getDoctrine()
            ->getRepository(Centro::class)
            ->findAll();


        if(isset($_REQUEST['mensaje']) && $_REQUEST['mensaje']!=""){
            return $this->render('centro/list.html.twig', ['centros' => $centro, 'mensaje' => $_REQUEST['mensaje']]);
        }else {
            return $this->render('centro/list.html.twig', ['centros' => $centro, 'mensaje' => " "]);
        }
        
    }


    /**
     * @Route("/centros/editar/{id<\d+>}", name="centro_edit")
     */
    public function edit($id, Request $request)
    {
        $centros = $this->getDoctrine()
            ->getRepository(Centro::class)
            ->find($id);
            $avisoCreacion = "";
       
        $form = $this->createForm(CentrosType::class, $centros, array('submit'=>'Desar'));
        $form->add('FechaAlta', DateType::class, array(
            "widget" => 'single_text',
            "format" => 'yyyy-MM-dd'));
        $form->add('FechaBaja', DateType::class, array(
                "widget" => 'single_text',
                "format" => 'yyyy-MM-dd'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $centros = $form->getData();
            $centroModificado = $this->getDoctrine()->getRepository(Centro::class)->findByNombre($centros->getNombre());
            
            if(sizeof($centroModificado)== 0 ){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($centros);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Centros '.$centros->getNombre().' modificados!'
            );

            $centroModificado=true;
                $avisoCreacion = "El centro ha sido modificado con éxito.";

            } else {
                $centroModificado=false;
                $avisoCreacion = "El centro no se ha podido modificar.";
            }

            //return $this->redirectToRoute('centros_list');
        }

        return $this->render('centro/centros.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Editar centros',
            'mensaje' => $avisoCreacion,
        ));
    }

        /**
     * @Route("/centros/eliminar/{id<\d+>}", name="centro_delete")
     */
    public function delete($id, Request $request)
    {
        $mensajeErrorFK="";
        $centro = $this->getDoctrine()
            ->getRepository(Centro::class)
            ->find($id);

            $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findUsuariosCentro($id);

        if(sizeof($users) !=0){
            $mensajeErrorFK="Error, no se ha podido eliminar este centro. Contiene uno o varios usuarios, por favor elimine préviamente los usuarios.";
        } else{
            
                $entityManager = $this->getDoctrine()->getManager();
                $nomCentro = $centro->getNombre();
                $entityManager->remove($centro);
                $entityManager->flush();
                $mensajeErrorFK = "Centro eliminado correctamente.";

                $this->addFlash(
                    'notice',
                    'Centro '.$nomCentro.' eliminado!'
                );
        }
        return $this->redirectToRoute('centros_list', array(
            'mensaje'=>$mensajeErrorFK,
            )
        );
    }
}
