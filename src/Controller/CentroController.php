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
        $centro = $this->getDoctrine()
        ->getRepository(Centro::class)
        ->find($id);

        return $this->render('centro/view.html.twig', ['centro'=>$centro]);
    }

   /**
     * @Route("/centros/new/{id<\d+>}", name="centros_new")
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
     * @Route("/centros/list", name="centros_list")
     */
    public function list()
    {
        $centro = $this->getDoctrine()
            ->getRepository(Centro::class)
            ->findAll();
        return $this->render('centro/list.html.twig', ['centro' => $centro]);
    }


    /**
     * @Route("/centros/edit/{id<\d+>}", name="centro_edit")
     */
    public function edit($id, Request $request)
    {
        $centros = $this->getDoctrine()
            ->getRepository(Centro::class)
            ->find($id);

       
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
            
       

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($centros);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Centros '.$centros->getNombre().' desada!'
            );

            return $this->redirectToRoute('centros_list');
        }

        return $this->render('centro/centros.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Editar centros',
        ));
    }

        /**
     * @Route("/centros/delete/{id<\d+>}", name="centro_delete")
     */
    public function delete($id, Request $request)
    {
        $centro = $this->getDoctrine()
            ->getRepository(Centro::class)
            ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $nomCentro = $centro->getNombre();
        $entityManager->remove($centro);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Centro '.$nomCentro.' eliminada!'
        );

        return $this->redirectToRoute('centros_list');
    }
}
