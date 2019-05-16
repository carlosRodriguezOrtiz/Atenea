<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\QuestionsExternes;
use App\Entity\SubTipusQE;
use App\Entity\TipusQE;
use Symfony\Component\Form\Extension\Core\Type\DateType;


use App\Form\QuestionsExternesType;


class QuestionsExternesController extends AbstractController
{
   
    /**
     * @Route("/questionsexternesEmpresas/{id}", name="qe_listEmpresas")
     */
    public function listEmpresasExternes($id)
    {
            $qe = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->find($id);
        
            return $this->render('questions_externes/list.html.twig', ['qes' => $qe]);

    }

       /**
     * @Route("/questionsexternesCentros/{id}", name="qe_listCentros")
     */
    public function listCentrosExternes($id)
    {
            $qe = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->find($id);
        
            return $this->render('questions_externes/list.html.twig', ['qes' => $qe]);

    }

    



    /**
     * @Route("/questionsexternes/new", name="crearQE")
     */
    public function newQE(Request $request)
    {
        
        $subtipus = null;

        $tiposQE = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->findAll();
    
        // POST Form Subir los datos a la BBDD
        if (isset($_POST['nombre'])) {
            $qe = new QuestionsExternes();
            $qe->setNombre($_POST['nombre']);
            $qe->setFechaAlta(new \DateTime($_POST['dateA']));
            $qe->setFechaBaja(new \DateTime($_POST['dateB']));
            $subtipus = $this->getDoctrine()
            ->getRepository(SubTipusQE::class)
            ->find($_POST['subtipus']);

            $qe->setSubtipus($subtipus);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($qe);
            $entityManager->flush();
        }

        return $this->render('questions_externes/questions_externes.html.twig', array(
            'title' => 'Nova QE',
            'tiposQE' => $tiposQE,
            'subtipus' => $subtipus
        ));
    }

    /**
     * @Route("/questionsexternes/edit/{id}", name="qe_edit")
     */
    public function edit($id)
    {
            $qe = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->findAll();
        
            return $this->render('questions_externes/list.html.twig', ['qes' => $qe]);
    }

    /**
     * @Route("/questionsexternes/delete/{id}", name="qe_delete")
     */
    public function delete($id)
    {
            $qe = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->findAll();
        
            return $this->render('questions_externes/list.html.twig', ['qes' => $qe]);
    }

     /**
     * @Route("/questionsexternes/getQE", name="getSubTipusQE")
     */
    public function getQE(Request $request){
        // AJAX para el form /qe/new para sacar los subtipus
        $subtipus = null;
        $tiposQE = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->findAll();
        
        $id = $request->request->get('idtipusQE');
        $qes = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->find($id);
        $subtipus = $qes->getSubtipus();
        
        
        
        return $this->render('questions_externes/questions_externes.html.twig', array(
            // 'form' => $form->createView(),
            'title' => "POST",
            'tiposQE' => $tiposQE,
            'subtipus' => $subtipus
        ));
    }
}
