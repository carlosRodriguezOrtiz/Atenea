<?php

namespace App\Controller;

use App\Entity\Centro;
use App\Entity\Corporacion;
use App\Entity\Empresa;
use App\Entity\User;
use App\Form\EmpresasType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/empresas/lista", name="empresas_list")
     */
    function list()
    {
        $usuariActual = $this->getUser();
        $userDB = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($usuariActual->getId());
        if ($userDB->getRole()->getNombre() == "ROLE_ADMIN") {

            if ($this->getUser()->getCorporacion() == null && $this->getUser()->getEmpresa() == null) {

                $empresas = $this->getDoctrine()
                    ->getRepository(Empresa::class)
                    ->findAll();
            } else {
                $id = $this->getUser()->getCorporacion()->getId();
                $corp = $this->getDoctrine()
                    ->getRepository(Corporacion::class)
                    ->find($id);
                $empresas = $corp->getArrayEmpresa();
                $mensaje = "";
                return $this->render('empresa/list.html.twig', ['empresas' => $empresas, 'mensaje' => $mensaje]);
            }
        }

        if (isset($_REQUEST['mensaje']) && $_REQUEST['mensaje'] != "") {
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
        $usuariActual = $this->getUser();

        $userDB = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($usuariActual->getId());

        $empresa = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->find($id);


        if ($userDB->getRole()->getNombre() == "ROLE_ADMIN") {
            return $this->render('empresa/view.html.twig', ['empresa' => $empresa, 'centros' => $empresa->getArrayCentros()]);

        } else {

            if ($userDB->getEmpresa()->getId() == $id) {

                return $this->render('empresa/view.html.twig', ['empresa' => $empresa, 'centros' => $empresa->getArrayCentros()]);

            } else {

                $mensajeError = 'El usuario actual no puede acceder a esta empresa';
                

                return $this->render('empresa/errores.html.twig', [ 'mensajeError' => $mensajeError]);
            }

        }

    }

    /**
     * @Route("/empresa/nueva", name="crearEmpresa")
     */
    public function newEmpresa(Request $request)
    {
        $empresas = new Empresa();
        $empresaCreada = false;
        $avisoCreacion = "";
        $form = $this->createForm(EmpresasType::class, $empresas, array('submit' => 'Crear Empresa'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $empresas = $form->getData();

            $empresaCreada = $this->getDoctrine()->getRepository(Empresa::class)->findByNombre($empresas->getNombre());


            if (sizeof($empresaCreada) == 0) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($empresas);
                $entityManager->flush();

                $this->addFlash(
                    'notice',
                    'Nova empresas ' . $empresas->getNombre() . ' creada!'
                );

                $empresaCreada = true;
                $avisoCreacion = "La empresa ha sido creada con éxito.";

                $empresas = new Empresa();
                $form = $this->createForm(empresasType::class, $empresas, array('submit' => 'Crear Empresa'));
            } else {
                $empresaCreada = false;
                $avisoCreacion = "La empresa ya existe, porfavor introduzca una nueva.";
            }
        }
        return $this->render('empresa/empresas.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nueva empresa',
            'mensaje' => $avisoCreacion,
        ));
    }

        /**
     * @Route("/empresa/nueva/{id<\d+>}", name="crearEmpresaCorp")
     */
    public function newEmpresaCorp($id,Request $request)
    {
        $empresas = new Empresa();
        $empresaCreada = false;
        $avisoCreacion = "";
        $form = $this->createForm(EmpresasType::class, $empresas, array('submit' => 'Crear Empresa'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $empresas = $form->getData();

            $empresaCreada = $this->getDoctrine()->getRepository(Empresa::class)->findByNombre($empresas->getNombre());


            if (sizeof($empresaCreada) == 0) {
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
                $avisoCreacion = "La empresa ha sido creada con éxito.";

                $empresas = new Empresa();
                $form = $this->createForm(empresasType::class, $empresas, array('submit' => 'Crear Empresa'));
            } else {
                $empresaCreada = false;
                $avisoCreacion = "La empresa ya existe, porfavor introduzca una nueva.";
            }
        }
        return $this->render('empresa/empresas.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nova empresa',
            'mensaje' => $avisoCreacion,
        ));
    }



    /**
     * @Route("/empresa/editar/{id<\d+>}", name="empresa_edit")
     */
    public function edit($id, Request $request)
    {
        $empresas = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->find($id);
            $avisoCreacion = "";
        $form = $this->createForm(EmpresasType::class, $empresas, array('submit' => 'Desar'));
        $form->add('FechaAlta', DateType::class, array(
            "widget" => 'single_text',
            "format" => 'yyyy-MM-dd'
        ));
        $form->add('FechaBaja', DateType::class, array(
            "widget" => 'single_text',
            "format" => 'yyyy-MM-dd'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $empresas = $form->getData();
            $empresaModificada = $this->getDoctrine()->getRepository(Empresa::class)->findByNombre($empresas->getNombre());

            if(sizeof($empresaModificada)== 0 ){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($empresas);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Empresas ' . $empresas->getNombre() . ' desada!'
            );

            $empresaModificada=true;
                $avisoCreacion = "La empresa ha sido modificada con éxito.";

            } else {
                $empresaModificada=false;
                $avisoCreacion = "La empresa no se ha podido modificar.";
            }

            //return $this->redirectToRoute('empresas_list');
        }

        return $this->render('empresa/empresas.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Editar empresas',
            'mensaje' => $avisoCreacion,
        ));
    }

    /**
     * @Route("/empresa/eliminar/{id<\d+>}", name="empresa_delete")
     */
    public function delete($id, Request $request)
    {
        $mensajeErrorFK = "";
        $empresas = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->find($id);
        $centros = $empresas->getArrayCentros();
        $usuarios = $empresas->getUsers();
        if (!$centros->isEmpty()) {
            $mensajeErrorFK = "Error, no se ha podido eliminar esta empresa. Contiene una o varios centros, por favor elimine préviamente esos centros.";
        } elseif (!$usuarios->isEmpty()) {
            $mensajeErrorFK = "Error, no se ha podido eliminar esta empresa. Contiene uno o varios usuarios, por favor elimine préviamente esos usuarios.";
        } else {
            $entityManager = $this->getDoctrine()->getManager();
            $nomEmpresas = $empresas->getNombre();
            $entityManager->remove($empresas);
            $entityManager->flush();
            $mensajeErrorFK = "Empresa eliminada correctamente.";

            $this->addFlash(
                'notice',
                'Empresa ' . $nomEmpresas . ' eliminada!'
            );
        }

        return $this->redirectToRoute(
            'empresas_list',
            array(
                'mensaje' => $mensajeErrorFK,
            )
        );
    }


    /**
     * @Route("/empresa/contexto", name="contexto")
     */
    public function contexto()
    {
        $empresas = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->findAll();
        $centros = $this->getDoctrine()
            ->getRepository(Centro::class)
            ->findAll();

        if (isset($_REQUEST['mensaje']) && $_REQUEST['mensaje'] != "") {
            return $this->render('emergente/list.html.twig', ['empresas' => $empresas, 'mensaje' => $_REQUEST['mensaje']]);
        } else {
            return $this->render('emergente/list.html.twig', ['empresas' => $empresas, 'centros' => $centros]);
        }
    }

    /**
     * @Route("/empresas/contextoUser", name="contexto")
     */
    public function contextoUser()
    {

        $usuariActual = $this->getUser();

        $userDB = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($usuariActual->getId());

        if ($userDB->getCorporacion() == null) {
            $empresas = $userDB->getEmpresa();
            $centros = null;
            if ($empresas != null) {
                $centros =  $empresas->getArrayCentros();
            }
        } else if ($userDB->getCorporacion() != null) {
            $empresas = $userDB->getCorporacion()->getArrayEmpresa();
            $centros = [];
            foreach ($empresas as $empresa) {
                foreach ($empresa->getArrayCentros() as $centro) {
                    array_push($centros, $centro);
                }
            }
        }
        if (isset($_REQUEST['mensaje']) && $_REQUEST['mensaje'] != "") {
            return $this->render('emergente/list.html.twig', ['empresas' => $empresas, 'mensaje' => $_REQUEST['mensaje']]);
        } else if ($centros != null) {
            return $this->render('emergente/list.html.twig', ['empresas' => $empresas, 'centros' => $centros]);
        } else {
            return $this->render('emergente/list.html.twig', ['empresas' => $empresas,  'centros' => $centros]);
        }
    }
}
