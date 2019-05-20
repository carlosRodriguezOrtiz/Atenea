<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\QuestionsExternes;
use App\Entity\QuestionsInternes;
use App\Entity\SubTipusQE;
use App\Entity\TipusQE;
use App\Entity\Corporacion;
use App\Entity\Empresa;
use App\Entity\Centro;
use App\Entity\AspecteQ;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AspectesQController extends AbstractController
{

    /**
     * @Route("/aspectos", name="aspectes_q")
     */
    public function index()
    {
        $questions = null;
        return $this->render('aspec_fav_desfav/qi.corp.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
        ]);
    }

        /**
     * @Route("/aspectos-corporacion/ci/{id<\d+>}", name="aspectes_qi_corporacion")
     */
    public function qiCorp($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findByCorporacionId($id);

        return $this->render('aspec_fav_desfav/corp.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "interna",
            'id' => $id,
        ]);
    }

       /**
     * @Route("/aspectos-empresa/ci/{id<\d+>}", name="aspectes_qi_empresa")
     */
    public function qiEmpresa($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findByEmpresaId($id);

        return $this->render('aspec_fav_desfav/empresa.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "interna",
            'id' => $id,
        ]);
    }

       /**
     * @Route("/aspectos-centro/ci/{id<\d+>}", name="aspectes_qi_centro")
     */
    public function qiCentre($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findByCentroId($id);

        return $this->render('aspec_fav_desfav/centro.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "interna",
            'id' => $id,
        ]);
    }

    /**
     * @Route("/aspectos-corporacion/ce/{id<\d+>}", name="aspectes_qe_corporacion")
     */
    public function qeCorporacion($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findByCorporacionId($id);

        return $this->render('aspec_fav_desfav/corp.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "externa",
            'id' => $id,
        ]);
    }



    /**
     * @Route("/aspectos-empresa/ce/{id<\d+>}", name="aspectes_qe_empresa")
     */
    public function qeEmpresa()
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findByEmpresaId();
        return $this->render('aspec_fav_desfav/empresa.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "externa",
            'id' => $id,
        ]);
    }

    /**
     * @Route("/aspectos-centro/ce/{id<\d+>}", name="aspectes_qe_centro")
     */
    public function qeCentro($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findByCentroId();

        return $this->render('aspec_fav_desfav/centro.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "externa",
            'id' => $id,
        ]);
    }


    /**
     * @Route("/aspectos-corporacion/ce/new/{id<\d+>}", name="aspectes_ce_corporacionCrear")
     */
    public function crearqeCorporacion($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findByCorporacionId($id);

        $aspectoQ = new AspecteQ();
        $empresaCreada = false;
        $avisoCreacion = "";

        if (isset($_POST['hidden'])) {
            $ce = $this->getDoctrine()->getRepository(QuestionsExternes::class)->find($_POST['hidden']);
            $aspectoQ->setQuestioExterna($ce);
            if (isset($_POST['amenaza'])) {
                $aspectoQ->setDescripcio($_POST['amenaza']);
                $aspectoQ->setNom($_POST['amenaza']);
                $aspectoQ->setDafo("A");
            } elseif (isset($_POST['oportunidad'])){
                $aspectoQ->setDescripcio($_POST['oportunidad']);
                $aspectoQ->setNom($_POST['oportunidad']);
                $aspectoQ->setDafo("O");
            } 


            if ($aspectoQ->getAlta() == null) {
                $aspectoQ->setAlta(new \DateTime());
            }

            if ($aspectoQ->getBaixa() == null) {
                $aspectoQ->setBaixa(new \DateTime());
            }
   

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aspectoQ);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nuevo aspectoQ ' . $aspectoQ->getNom() . ' creada!'
            );

                $empresaCreada = true;
                $avisoCreacion = "La empresa ha sido creada";

        } else {
            $empresaCreada = false;
            $avisoCreacion = "La empresa ya existe , porfavor introduzca una nueva";
        }

        return $this->render('aspec_fav_desfav/corp.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "externa",
            'id' => $id,
        ]);
    }

    /**
     * @Route("/aspectos-empresa/ce/new/{id<\d+>}", name="aspectes_ce_empresaCrear")
     */
    public function crearqeEmpresa($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findByEmpresaId($id);

        $aspectoQ = new AspecteQ();
        $empresaCreada = false;
        $avisoCreacion = "";

        if (isset($_POST['hidden'])) {
            $ce = $this->getDoctrine()->getRepository(QuestionsExternes::class)->find($_POST['hidden']);
            $aspectoQ->setQuestioExterna($ce);
            if (isset($_POST['amenaza'])) {
                $aspectoQ->setDescripcio($_POST['amenaza']);
                $aspectoQ->setNom($_POST['amenaza']);
                $aspectoQ->setDafo("A");
            } elseif (isset($_POST['oportunidad'])){
                $aspectoQ->setDescripcio($_POST['oportunidad']);
                $aspectoQ->setNom($_POST['oportunidad']);
                $aspectoQ->setDafo("O");
            } 


            if ($aspectoQ->getAlta() == null) {
                $aspectoQ->setAlta(new \DateTime());
            }

            if ($aspectoQ->getBaixa() == null) {
                $aspectoQ->setBaixa(new \DateTime());
            }
   

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aspectoQ);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nuevo aspectoQ ' . $aspectoQ->getNom() . ' creada!'
            );

                $empresaCreada = true;
                $avisoCreacion = "La empresa ha sido creada";

        } else {
            $empresaCreada = false;
            $avisoCreacion = "La empresa ya existe , porfavor introduzca una nueva";
        }

        return $this->render('aspec_fav_desfav/empresa.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "externa",
            'id' => $id,
        ]);
    }

    /**
     * @Route("/aspectos-centro/ce/new/{id<\d+>}", name="aspectes_ce_centroCrear")
     */
    public function crearqeCentro($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findByCentroId($id);

        $aspectoQ = new AspecteQ();
        $empresaCreada = false;
        $avisoCreacion = "";

        if (isset($_POST['hidden'])) {
            $ce = $this->getDoctrine()->getRepository(QuestionsExternes::class)->find($_POST['hidden']);
            $aspectoQ->setQuestioExterna($ce);
            if (isset($_POST['amenaza'])) {
                $aspectoQ->setDescripcio($_POST['amenaza']);
                $aspectoQ->setNom($_POST['amenaza']);
                $aspectoQ->setDafo("A");
            } elseif (isset($_POST['oportunidad'])){
                $aspectoQ->setDescripcio($_POST['oportunidad']);
                $aspectoQ->setNom($_POST['oportunidad']);
                $aspectoQ->setDafo("O");
            } 


            if ($aspectoQ->getAlta() == null) {
                $aspectoQ->setAlta(new \DateTime());
            }

            if ($aspectoQ->getBaixa() == null) {
                $aspectoQ->setBaixa(new \DateTime());
            }
   

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aspectoQ);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nuevo aspectoQ ' . $aspectoQ->getNom() . ' creada!'
            );

                $empresaCreada = true;
                $avisoCreacion = "La empresa ha sido creada";

        } else {
            $empresaCreada = false;
            $avisoCreacion = "La empresa ya existe , porfavor introduzca una nueva";
        }

        return $this->render('aspec_fav_desfav/centro.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "externa",
            'id' => $id,
        ]);
    }

    /**
     * @Route("/aspectos-corporacion/ci/new/{id<\d+>}", name="aspectes_ci_corporacionCrear")
     */
    public function crearqiCorporacion($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findByCorporacionId($id);

        $aspectoQ = new AspecteQ();
        $empresaCreada = false;
        $avisoCreacion = "";

        if (isset($_POST['hidden'])) {
            $ci = $this->getDoctrine()->getRepository(QuestionsInternes::class)->find($_POST['hidden']);
            $aspectoQ->setQuestioInterna($ci);
            if (isset($_POST['debilidad'])) {
                $aspectoQ->setDescripcio($_POST['debilidad']);
                $aspectoQ->setNom($_POST['debilidad']);
                $aspectoQ->setDafo("D");
            } elseif (isset($_POST['fortaleza'])){
                $aspectoQ->setDescripcio($_POST['fortaleza']);
                $aspectoQ->setNom($_POST['fortaleza']);
                $aspectoQ->setDafo("F");
            } 
    
            if ($aspectoQ->getAlta() == null) {
                $aspectoQ->setAlta(new \DateTime());
            }

            if ($aspectoQ->getBaixa() == null) {
                $aspectoQ->setBaixa(new \DateTime());
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aspectoQ);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nuevo aspectoQ ' . $aspectoQ->getNom() . ' creada!'
            );

                $empresaCreada = true;
                $avisoCreacion = "La empresa ha sido creada";

        } else {
            $empresaCreada = false;
            $avisoCreacion = "La empresa ya existe , porfavor introduzca una nueva";
        }

        return $this->render('aspec_fav_desfav/corp.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "interna",
            'id' => $id,
        ]);
    }

    /**
     * @Route("/aspectos-empresa/ci/new/{id<\d+>}", name="aspectes_ci_empresaCrear")
     */
    public function crearqiEmpresa($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findByEmpresaId($id);

        $aspectoQ = new AspecteQ();
        $empresaCreada = false;
        $avisoCreacion = "";

        if (isset($_POST['hidden'])) {
            $ci = $this->getDoctrine()->getRepository(QuestionsInternes::class)->find($_POST['hidden']);
            $aspectoQ->setQuestioInterna($ci);
            if (isset($_POST['debilidad'])) {
                $aspectoQ->setDescripcio($_POST['debilidad']);
                $aspectoQ->setNom($_POST['debilidad']);
                $aspectoQ->setDafo("D");
            } elseif (isset($_POST['fortaleza'])){
                $aspectoQ->setDescripcio($_POST['fortaleza']);
                $aspectoQ->setNom($_POST['fortaleza']);
                $aspectoQ->setDafo("F");
            } 
    
            if ($aspectoQ->getAlta() == null) {
                $aspectoQ->setAlta(new \DateTime());
            }

            if ($aspectoQ->getBaixa() == null) {
                $aspectoQ->setBaixa(new \DateTime());
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aspectoQ);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nuevo aspectoQ ' . $aspectoQ->getNom() . ' creada!'
            );

                $empresaCreada = true;
                $avisoCreacion = "La empresa ha sido creada";

        } else {
            $empresaCreada = false;
            $avisoCreacion = "La empresa ya existe , porfavor introduzca una nueva";
        }

        return $this->render('aspec_fav_desfav/empresa.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "interna",
            'id' => $id,
        ]);
    }

    /**
     * @Route("/aspectos-centro/ci/new/{id<\d+>}", name="aspectes_ci_centroCrear")
     */
    public function crearqiCentro($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findByCentroId($id);

        $aspectoQ = new AspecteQ();
        $empresaCreada = false;
        $avisoCreacion = "";

        if (isset($_POST['hidden'])) {
            $ci = $this->getDoctrine()->getRepository(QuestionsInternes::class)->find($_POST['hidden']);
            $aspectoQ->setQuestioInterna($ci);
            if (isset($_POST['debilidad'])) {
                $aspectoQ->setDescripcio($_POST['debilidad']);
                $aspectoQ->setNom($_POST['debilidad']);
                $aspectoQ->setDafo("D");
            } elseif (isset($_POST['fortaleza'])){
                $aspectoQ->setDescripcio($_POST['fortaleza']);
                $aspectoQ->setNom($_POST['fortaleza']);
                $aspectoQ->setDafo("F");
            } 
    
            if ($aspectoQ->getAlta() == null) {
                $aspectoQ->setAlta(new \DateTime());
            }

            if ($aspectoQ->getBaixa() == null) {
                $aspectoQ->setBaixa(new \DateTime());
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aspectoQ);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nuevo aspectoQ ' . $aspectoQ->getNom() . ' creada!'
            );

                $empresaCreada = true;
                $avisoCreacion = "La empresa ha sido creada";

        } else {
            $empresaCreada = false;
            $avisoCreacion = "La empresa ya existe , porfavor introduzca una nueva";
        }

        return $this->render('aspec_fav_desfav/centro.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "interna",
            'id' => $id,
        ]);
    }
}




