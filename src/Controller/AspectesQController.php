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
     * @Route("/aspectos-corporacion/ci/{id<\d+>}", name="aspectes_qI_corporacion")
     */
    public function qiCorp($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findAll();

        if (isset($_POST['aa'])) {

        }

        return $this->render('aspec_fav_desfav/qi.corp.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "interna",
            'id' => $id,
        ]);
    }

       /**
     * @Route("/aspectos-empresa/ci/{id<\d+>}", name="aspectes_qI_empresa")
     */
    public function qiEmpresa($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findAll();

        if (isset($_POST['aa'])) {

        }
        return $this->render('aspec_fav_desfav/qi.corp.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "interna",
            'id' => $id,
        ]);
    }

       /**
     * @Route("/aspectos-centro/ci/{id<\d+>}", name="aspectes_qI_centro")
     */
    public function qiCentre($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findAll();

        if (isset($_POST['aa'])) {

        }

        return $this->render('aspec_fav_desfav/qi.corp.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "interna",
            'id' => $id,
        ]);
    }

    /**
     * @Route("/aspectos-corporacion/ce/{id<\d+>}", name="aspectes_qE_corporacion")
     */
    public function qeCorporacion($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findByCorporacionId($id);

        return $this->render('aspec_fav_desfav/qe.corp.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "externa",
            'id' => $id,
        ]);
    }



    /**
     * @Route("/aspectos-empresa/ce/{id<\d+>}", name="aspectes_qE_empresa")
     */
    public function qeEmpresa()
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findAll();
        return $this->render('aspec_fav_desfav/qe.corp.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "externa",
            'id' => $id,
        ]);
    }

    /**
     * @Route("/aspectos-centro/ce/{id<\d+>}", name="aspectes_qE_centro")
     */
    public function qeCentro($id)
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findAll();
        return $this->render('aspec_fav_desfav/qe.corp.aspec_fav_desfav.html.twig', [
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

            var_dump($_POST);
            exit();
            $empresas = $form->getData();

            $empresa2 = $this->getDoctrine()->getRepository(Empresa::class)->findByNombre($empresas->getNombre());


            if (sizeof($empresa2) == 0) {
                $corporacion=$this->getDoctrine()->getRepository(Corporacion::class)->find($id);
                $empresas->setCorporaciones($corporacion);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($empresas);
                $entityManager->flush();

                $this->addFlash(
                    'notice',
                    'Nova empresas ' . $empresas->getNombre() . ' creada!'
                );

                $empresaCreada = true;
                $avisoCreacion = "La empresa ha sido creada";

                $empresas = new Empresa();
                $form = $this->createForm(EmpresasType::class, $empresas, array('submit' => 'Crear Empresa'));
            } else {
                $empresaCreada = false;
                $avisoCreacion = "La empresa ya existe , porfavor introduzca una nueva";
            }

        return $this->render('aspec_fav_desfav/qe.corp.aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "externa",
            'id' => $id,
        ]);
    }
}




}
