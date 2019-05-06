<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EmpresasType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Empresa;
use App\Entity\Centro;
use App\Entity\Corporacion;
use App\Entity\User;


class EmpresaController extends AbstractController
{
    /**
     * @Route("/empresa", name="empresa")
     */
    public function index()
    {
        return $this->render('empresa/index.html.twig', [
            'controller_name' => 'EmpresaController',
        ]);
        
    }

    /**
     * @Route("/empresas/list", name="empresas_list")
     */
    public function list()
    {
        $empresas = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->findAll();

        if(isset($_REQUEST['mensaje']) && $_REQUEST['mensaje']!=""){
            return $this->render('empresa/list.html.twig', ['empresas' => $empresas, 'mensaje' => $_REQUEST['mensaje']]);
        } else {
                return $this->render('empresa/list.html.twig', ['empresas' => $empresas, 'mensaje' => " "]);
        }
    }

    /**
     * @Route("/empresa/{id<\d+>}", name="empresa")
     */
    public function view($id)
    {
        $empresa = $this->getDoctrine()
        ->getRepository(Empresa::class)
        ->find($id);

        return $this->render('empresa/view.html.twig', ['empresa'=>$empresa,'centros' => $empresa->getArrayCentros()]);
    }

   /**
     * @Route("/empresas/new/{id<\d+>}", name="empresas_new")
     */
    public function new($id, Request $request)
    {
        $empresas= new Empresa();

        $form = $this->createForm(EmpresasType::class , $empresas, array ('submit'=>'Crear Empresa'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $empresas = $form->getData();


            $corporaciones = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->find($id);

            $empresas->setCorporaciones($corporaciones);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($empresas);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nova empresas '.$empresas->getNombre() .' creada!'
            );

            return $this->redirectToRoute('corporaciones_list'); 
        }

        return $this->render('empresa/empresas.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nova empresa'
        ));
    }

       /**
     * @Route("/empresas/newEmpresa/", name="crearEmpresa")
     */
    public function newEmpresa(Request $request)
    {
        $empresas= new Empresa();

        $form = $this->createForm(EmpresasType::class , $empresas, array ('submit'=>'Crear Empresa'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $empresas = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($empresas);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nova empresas '.$empresas->getNombre() .' creada!'
            );

            return $this->redirectToRoute('crearEmpresa'); 
        }

        return $this->render('empresa/empresas.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nova empresa'
        ));
    }

        /**
     * @Route("/empresas/edit/{id<\d+>}", name="empresa_edit")
     */
    public function edit($id, Request $request)
    {
        $empresas = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->find($id);

       
        $form = $this->createForm(EmpresasType::class, $empresas, array('submit'=>'Desar'));
        $form->add('FechaAlta', DateType::class, array(
            "widget" => 'single_text',
            "format" => 'yyyy-MM-dd'));
        $form->add('FechaBaja', DateType::class, array(
                "widget" => 'single_text',
                "format" => 'yyyy-MM-dd'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $empresas = $form->getData();
            
       

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($empresas);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Empresas '.$empresas->getNombre().' desada!'
            );

            return $this->redirectToRoute('empresas_list');
        }

        return $this->render('empresa/empresas.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Editar empresas',
        ));
    }

        /**
     * @Route("/empresas/delete/{id<\d+>}", name="empresa_delete")
     */
    public function delete($id, Request $request)
    {
        $mensajeErrorFK="";
        $empresas = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->find($id);
            $centros=$empresas->getArrayCentros();
            $usuarios = $empresas->getUsers();   
        if(!$centros->isEmpty()){
            $mensajeErrorFK="Error , no se ha podido eliminar esta empresa. Contiene una o varios centros, por favor primero elimina esos centros";
        }elseif(!$usuarios->isEmpty()){
            $mensajeErrorFK="Error , no se ha podido eliminar esta empresa. Contiene uno o varios usuarios, por favor primero elimina esos usuarios";
        }else{
            $entityManager = $this->getDoctrine()->getManager();
            $nomEmpresas = $empresas->getNombre();
            $entityManager->remove($empresas);
            $entityManager->flush();
    
            $this->addFlash(
                'notice',
                'Empresa '.$nomEmpresas.' eliminada!'
            );
        }

        return $this->redirectToRoute('empresas_list', array(
            'mensaje'=>$mensajeErrorFK
            )
        );
    }


        /**
     * @Route("/empresas/contexto", name="contexto")
     */
    public function contexto()
    {
        $empresas = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->findAll();
            $centros = $this->getDoctrine()
            ->getRepository(Centro::class)
            ->findAll();

        if(isset($_REQUEST['mensaje']) && $_REQUEST['mensaje']!=""){
            return $this->render('emergente/list.html.twig', ['empresas' => $empresas, 'mensaje' => $_REQUEST['mensaje']]);
        } else {
                return $this->render('emergente/list.html.twig', ['empresas' => $empresas, 'centros' => $centros]);
        }
    }
}
























