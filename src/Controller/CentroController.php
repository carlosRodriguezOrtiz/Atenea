<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CentrosType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
     * @Route("/centros/new/{id<\d+>}", name="centros_new")
     */
    public function new($id ,Request $request)
    {
        $centros= new Centro();

        $form = $this->createForm(CentrosType::class , $centros, array ('submit'=>'Crear Centro'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
     
            $centros = $form->getData();
           
            
            $empresas = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->find($id);

            $centros->setEmpresas($empresas);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($centros);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nuevos centros '.$centros->getNombre() .' creada!'
            );

            return $this->redirectToRoute('login'); 
        }

        return $this->render('centro/centros.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nuevo centro',
        ));
    }


}
