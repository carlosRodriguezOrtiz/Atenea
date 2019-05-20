<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\QuestionsInternesType;
use App\Entity\QuestionsInternes;
use App\Entity\Empresa;
use App\Entity\Centro;
use App\Entity\Corporacion;

class QuestionsInternesController extends AbstractController
{
   

    /**
     * @Route("/questionsinternesEmpresas/{id<\d+>}", name="qi_listEmpresas")
     */
    public function listEmpresasInternes($id)
    {
        $qi = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findByEmpresaId($id);
        
            return $this->render('questions_internes/list.empresa.html.twig', ['qis' => $qi, 'id' => $id]);
    }

            /**
     * @Route("/questionsinternesCorporacion/{id<\d+>}", name="qi_listCorporacion")
     */
    public function listCorporacionInternes($id)
    {
            $qi = $this->getDoctrine()
            ->getRepository(QuestionsInternes::class)
            ->findByCorporacionId($id);

            return $this->render('questions_internes/list.corporacion.html.twig', ['qis' => $qi, 'id' => $id]);
    }

        /**
     * @Route("/questionsinternesCentros/{id<\d+>}", name="qi_listCentros")
     */
    public function listCentrosInternes($id)
    {
            $qi = $this->getDoctrine()
            ->getRepository(QuestionsInternes::class)
            ->findByCentroId($id);

            return $this->render('questions_internes/list.centro.html.twig', ['qis' => $qi, 'id' => $id]);
    }


    /**
     * @Route("/questionsinternesEmpresa/new/{id<\d+>}", name="crearQiEmpresa")
     */
    public function newQiEmpresa($id, Request $request)
    {
        $QI = new QuestionsInternes();

        $form = $this->createForm(QuestionsInternesType::class , $QI, array ('submit'=>'Crear QI'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $empresa = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->find($id);

            $qi = $form->getData();
            $qi->setEmpresa($empresa);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($qi);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nova QI '.$QI->getNombre() .' creada!'
            );

            // return $this->redirectToRoute('login'); 
        }

        return $this->render('questions_internes/create.qi.empresa.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nova QI',
            'id' => $id,
        ));
    }

    /**
     * @Route("/questionsinternesCentro/new/{id<\d+>}", name="crearQiCentro")
     */
    public function newQiCentro($id, Request $request)
    {
        $QI = new QuestionsInternes();

        $form = $this->createForm(QuestionsInternesType::class , $QI, array ('submit'=>'Crear QI'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centro = $this->getDoctrine()
            ->getRepository(Centro::class)
            ->find($id);

            $qi = $form->getData();
            $qi->setCentro($centro);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($qi);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nova QI '.$QI->getNombre() .' creada!'
            );
        }

        return $this->render('questions_internes/create.qi.centro.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nova QI',
            'id' => $id,
        ));
    }

    /**
     * @Route("/questionsinternesCorporacion/new/{id<\d+>}", name="crearQiCorporacion")
     */
    public function newQiCorporacion($id, Request $request)
    {
        $QI = new QuestionsInternes();

        $form = $this->createForm(QuestionsInternesType::class , $QI, array ('submit'=>'Crear QI'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centro = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->find($id);

            $qi = $form->getData();
            $qi->setCorporacion($centro);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($qi);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nova QI '.$QI->getNombre() .' creada!'
            );
        }

        return $this->render('questions_internes/create.qi.corporacion.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nova QI',
            'id' => $id,
        ));
    }
}
