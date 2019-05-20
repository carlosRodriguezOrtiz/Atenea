<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\QuestionsExternes;
use App\Entity\SubTipusQE;
use App\Entity\TipusQE;
use App\Entity\Empresa;
use App\Entity\Centro;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Form\QuestionsExternesType;


class QuestionsExternesController extends AbstractController
{
   
    /**
     * @Route("/questionsexternesEmpresas/{id<\d+>}", name="qe_listEmpresas")
     */
    public function listEmpresasExternes($id)
    {
            // $qe = $this->getDoctrine()
            // ->getRepository(QuestionsExternes::class)
            // ->find($id);
            $qe = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->findByEmpresaId($id);
        
            return $this->render('questions_externes/list.empresa.html.twig', ['qes' => $qe, 'id' => $id]);

    }


       /**
     * @Route("/questionsexternesCentro/{id<\d+>}", name="qe_listCentros")
     */
    public function listCentrosExternes($id)
    {
            // $qe = $this->getDoctrine()
            // ->getRepository(QuestionsExternes::class)
            // ->find($id);

            $qe = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->findByCentroId($id);
        
            return $this->render('questions_externes/list.centro.html.twig', ['qes' => $qe, 'id' => $id]);

    }



    /**
     * @Route("/questionsexternesEmpresas/new/{id<\d+>}", name="crearQeEmpresa")
     */
    public function newQeEmpresa($id)
    {
        
        $subtipus = null;

        $tiposQE = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->findAll();
    
        // POST Form Subir los datos a la BBDD
        if (isset($_POST['nombre'])) {

            $empresa = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->find($id);

            $qe = new QuestionsExternes();
            $qe->setEmpresa($empresa);
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

        return $this->render('questions_externes/create.qe.empresa.html.twig', array(
            'title' => 'Nova QE',
            'tiposQE' => $tiposQE,
            'subtipus' => $subtipus,
            'id' => $id,
        ));
    }



    /**
     * @Route("/questionsexternesCentro/new/{id<\d+>}", name="crearQeCentro")
     */
    public function newQeCentro($id)
    {
        
        $subtipus = null;

        $tiposQE = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->findAll();
    
        // POST Form Subir los datos a la BBDD
        if (isset($_POST['nombre'])) {

            $entityManager = $this->getDoctrine()->getManager();
            $centro = $this->getDoctrine()
            ->getRepository(Centro::class)
            ->find($id);

            $qe = new QuestionsExternes();
            $qe->setCentro($centro);
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

        return $this->render('questions_externes/create.qe.centro.html.twig', array(
            'title' => 'Nova QE',
            'tiposQE' => $tiposQE,
            'subtipus' => $subtipus,
            'id' => $id,
        ));
    }

 

    /**
     * @Route("/questionsexternesEmpresas/edit/{id<\d+>}/{idQe<\d+>}", name="qe_edit_empresa")
     */
    public function editQeEmpresa($id, $idQe)
    {
            $tiposQE = $this->getDoctrine()
            ->getRepository(TipusQE::class)
            ->findAll();

            $qes = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->findByEmpresaIdAndQeId($id,$idQe);
            $qe = $qes[0];
            $tipusQE = $this->getDoctrine()
            ->getRepository(TipusQE::class)
            ->find($qe->getSubtipus()->getTipusQE()->getId());

            $subtipus = $tipusQE->getSubtipus();

            if (isset($_POST['nombre'])) {
            
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
        
            return $this->render('questions_externes/edit.qe.empresa.html.twig', [
                'title' => 'Edit QE',
                'qe' => $qe,
                'tiposQE' => $tiposQE,
                'subtipus' => $subtipus,
                'id' => $id,
                'idQe' => $idQe,
                ]);
    }

    /**
     * @Route("/questionsexternesCentro/edit/{id<\d+>}/{idQe<\d+>}", name="qe_edit_centro")
     */
    public function editQeCentro($id, $idQe)
    {
        $tiposQE = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->findAll();

        $qes = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findByCentroIdAndQeId($id,$idQe);
        $qe = $qes[0];
        $tipusQE = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->find($qe->getSubtipus()->getTipusQE()->getId());

        $subtipus = $tipusQE->getSubtipus();

        if (isset($_POST['nombre'])) {
        
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
    
        return $this->render('questions_externes/edit.qe.centro.html.twig', [
            'title' => 'Edit QE',
            'qe' => $qe,
            'tiposQE' => $tiposQE,
            'subtipus' => $subtipus,
            'id' => $id,
            'idQe' => $idQe,
            ]);
    }

    /**
     * @Route("/questionsexternes/dte/{id<\d+>}/{idQe<\d+>}", name="qe_delete")
     */
    public function delete($id, $idQe)
    {
            $qe = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->findAll();
        
            // return $this->render('questions_externes/list.html.twig', ['qes' => $qe]);
            return $this->render('questions_externes/delete.qe.empresa.html.twig', ['qes' => $qe, 'id' => $id]);


            
    }

     /**
     * @Route("/questionsexternes/deleteCentro/{id<\d+>}/{idQe<\d+>}", name="qe_deleteCentro")
     */
    public function deleteCentro($id, $idQe)
    {
            $qeCentro = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->find($idQe);
            
       
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($qeCentro);
            $entityManager->flush();
            // return $this->render('questions_externes/list.html.twig', ['qes' => $qe]);
            return $this->redirectToRoute('qe_listCentros', ['qes' => $qeCentro, 'id' => $id]);
      
    }


         /**
     * @Route("/questionsexternes/deleteEmpresa/{id<\d+>}/{idQe<\d+>}", name="qe_deleteEmpresa")
     */
    public function deleteEmpresa($id, $idQe)
    {
            $qeEmpresa = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->find($idQe);
            
       
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($qeEmpresa);
            $entityManager->flush();
            // return $this->render('questions_externes/list.html.twig', ['qes' => $qe]);
            return $this->redirectToRoute('qe_listEmpresas', ['qes' => $qeEmpresa, 'id' => $id]);
      
    }



     /**
     * @Route("/questionsexternes/getQE/{id}", name="getSubTipusQE")
     */
    public function getQE($id, Request $request){
        // AJAX para el form /qe/new para sacar los subtipus
        $subtipus = null;
        $tiposQE = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->findAll();
        
        $idQe = $request->request->get('idtipusQE');
        $qes = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->find($idQe);
        $subtipus = $qes->getSubtipus();
        
        
        
        return $this->render('questions_externes/create.qe.empresa.html.twig', array(
            // 'form' => $form->createView(),
            'title' => "POST",
            'tiposQE' => $tiposQE,
            'subtipus' => $subtipus,
            'id' => $id,
        ));
    }
}
