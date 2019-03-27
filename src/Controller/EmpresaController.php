<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



use App\Form\EmpresasType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Empresa;


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

       

        return $this->render('empresa/list.html.twig', ['empresas' => $empresas]);
    }

   /**
     * @Route("/empresas/new", name="empresas_new")
     */
    public function new(Request $request)
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

            return $this->redirectToRoute('login'); 
        }

        return $this->render('empresa/empresas.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nova empresa',
        ));
    }

























}
