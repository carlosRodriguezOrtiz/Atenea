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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Console\Question\Question;

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
     * @Route("/questionsinternes/deleteEmpresa/{id<\d+>}/{idQi<\d+>}", name="qi_deleteEmpresa")
     */
    public function deleteEmpresa($id, $idQi)
    {
            $qiEmpresa = $this->getDoctrine()
            ->getRepository(QuestionsInternes::class)
            ->find($idQi);
            
       
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($qiEmpresa);
            $entityManager->flush();

            return $this->redirectToRoute('qi_listEmpresas', ['qis' => $qiEmpresa, 'id' => $id]);
      
    }

             /**
     * @Route("/questionsinternes/deleteCentro/{id<\d+>}/{idQi<\d+>}", name="qi_deleteCentro")
     */
    public function deleteCentro($id, $idQi)
    {
            $qiEmpresa = $this->getDoctrine()
            ->getRepository(QuestionsInternes::class)
            ->find($idQi);
            
       
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($qiEmpresa);
            $entityManager->flush();

            return $this->redirectToRoute('qi_listCentros', ['qis' => $qiEmpresa, 'id' => $id]);
      
    }

    /**
     * @Route("/questionsinternes/deleteCorporacion/{id<\d+>}/{idQi<\d+>}", name="qi_deleteCorporacion")
     */
    public function deleteCorporacion($id, $idQi)
    {
            $qiCorporacion = $this->getDoctrine()
            ->getRepository(QuestionsInternes::class)
            ->find($idQi);
            
       
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($qiCorporacion);
            $entityManager->flush();

            return $this->redirectToRoute('qi_listCorporacion', ['qis' => $qiCorporacion, 'id' => $id]);
      
    }

       /**
     * @Route("/questionsinternesEmpresas/edit/{id<\d+>}/{idQi<\d+>}", name="qi_edit_empresa")
     */
    public function editQIEmpresa($id, $idQi, Request $request)
    {
       
        $empresas = $this->getDoctrine()
            ->getRepository(QuestionsInternes::class)
            ->find($idQi);
      


        $form = $this->createForm(QuestionsInternesType::class, $empresas, array('submit' => 'Desar'));
        $form->add('FechaAlta', DateType::class, array(
            "widget" => 'single_text',
            "format" => 'yyyy-MM-dd'
        ));


        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {

            $empresas = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($empresas);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Empresas ' . $empresas->getNombre() . ' desada!'
            );

            return $this->redirectToRoute('qi_listEmpresas', array('id' => $id));
        }

        return $this->render('questions_internes/edit.qi.empresa.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Editar empresas de QI',
        ));
    }

          /**
     * @Route("/questionsinternesCentros/edit/{id<\d+>}/{idQi<\d+>}", name="qi_edit_centros")
     */
    public function editQICentro($id, $idQi, Request $request)
    {
       
        $centros = $this->getDoctrine()
            ->getRepository(QuestionsInternes::class)
            ->find($idQi);
      


        $form = $this->createForm(QuestionsInternesType::class, $centros, array('submit' => 'Desar'));
        $form->add('FechaAlta', DateType::class, array(
            "widget" => 'single_text',
            "format" => 'yyyy-MM-dd'
        ));


        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {

            $centros = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($centros);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Centros ' . $centros->getNombre() . ' desada!'
            );

            return $this->redirectToRoute('qi_listCentros', array('id' => $id));
        }

        return $this->render('questions_internes/edit.qi.centro.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Editar centros de QI',
        ));
    }

          /**
     * @Route("/questionsinternesCorporacion/edit/{id<\d+>}/{idQi<\d+>}", name="qi_edit_corporacion")
     */
    public function editQICorporacion($id, $idQi, Request $request)
    {
       
        $corporacion = $this->getDoctrine()
            ->getRepository(QuestionsInternes::class)
            ->find($idQi);
      


        $form = $this->createForm(QuestionsInternesType::class, $corporacion, array('submit' => 'Desar'));
        $form->add('FechaAlta', DateType::class, array(
            "widget" => 'single_text',
            "format" => 'yyyy-MM-dd'
        ));


        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {

            $corporacion = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($corporacion);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Centros ' . $corporacion->getNombre() . ' desada!'
            );

            return $this->redirectToRoute('qi_listCorporacion', array('id' => $id));
        }

        return $this->render('questions_internes/edit.qi.corporacion.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Editar centros de QI',
            'id' => $id
        ));
    }


    /**
     * @Route("/questionsinternesEmpresa/new/{id<\d+>}", name="crearQiEmpresa")
     */
    public function newQiEmpresa($id, Request $request)
    {
        $qi = new QuestionsInternes();

        $form = $this->createForm(QuestionsInternesType::class , $qi, array ('submit'=>'Crear QI'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $empresa = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->find($id);

            $qi = $form->getData();
            $qi->setEmpresa($empresa);
            // $qi->setAspecteQ(null);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($qi);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nova QI '.$qi->getNombre() .' creada!'
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
            $qi->setAspecteQ(null);
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
