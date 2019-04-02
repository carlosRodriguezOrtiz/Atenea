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

       

        return $this->render('corporacion/list.html.twig', ['corporaciones' => $corporaciones]);
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
}
