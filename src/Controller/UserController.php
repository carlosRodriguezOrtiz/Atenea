<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Corporacion;
use App\Entity\Empresa;
use App\Entity\Centro;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\UserEditType;

class UserController extends AbstractController
{
    /**
     * @Route("/user/edit/{id}", name="user_edit")
     */
    public function edit($id, Request $request , User $user)
    {
        $user0 = $this->getDoctrine()
        ->getRepository(User::class)
        ->find($id);
        // 1) Miramos si existe el usuario en la BBDD, si no existe le envia al template donde saca el error.
        if(!$user0){
            return $this->render('error/userNotFound.html.twig', [ 
                'id' => $id,
            ]);
        } else {
            $form = $this->createForm(UserEditType::class, $user);
            

            // 2) Manejamos el envío (sólo pasará con POST)
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                
                $user0->setUsername($user->getUsername());
                $user0->setPassword($user->getPassword());
                $user0->setEmail($user->getEmail());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user0);
                $entityManager->flush();
            }


            return $this->render('user/edit.html.twig', 
            array('form' => $form->createView())
            );
        }

        
    }



    /**
     * @Route("/user/list", name="user_list")
     */
    public function list()
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

       

        return $this->render('user/list.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/users/corporacion/{id<\d+>}", name="users_corp")
     */
    public function usersCorp($id)
    {
        $user = [];
        if($this->getUser()->getCorporacion()->getId() == $id){
        $corp = $this->getDoctrine()
            ->getRepository(Corporacion::class)
            ->find($id);

        $user = $corp->getUsers();
        
        foreach ($corp->getArrayEmpresa() as $empresa) {
            array_combine($user,$empresa->getUsers());
            foreach($empresa->getArrayCentros() as $centro ){
                array_combine($user,$centro->getUsuarios());
            }
        }
        
        return $this->render('user/list.html.twig', ['user' => $user]);
        }

        return $this->render('user/list.html.twig', ['user' => $user]);
    }
   

 /**
     * @Route("/users/centro/{id<\d+>}", name="users_centro")
     */
    public function usersCentro($id)
    {       
        $user = [];
        if($this->getUser()->getCentro()->getId() == $id){

            $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findUsuariosCentro($id);

        return $this->render('user/list.html.twig', ['user' => $users]);
        }

        return $this->render('user/list.html.twig', ['user' => $users]);
    }





    /**
     * @Route("/users/empresa/{id<\d+>}", name="users_emp")
     */
    public function usersEmp($id)
    {
        $user = [];
        if($this->getUser()->getEmpresa()->getId() == $id){
            $empresa = $this->getDoctrine()
            ->getRepository(Empresa::class)
            ->find($id);

        $user = $empresa->getUsers();
        

        foreach($empresa->getArrayCentros() as $centro ){
                array_combine($user,$centro->getUsuarios());
        }
        
        return $this->render('user/list.html.twig', ['user' => $user]);
        }

        return $this->render('user/list.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/users/delete/{id<\d+>}", name="user_delete")
     */
    public function delete($id, Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $nomUser = $user->getUsername();
        $entityManager->remove($user);
        $entityManager->flush();
        $this->addFlash(
            'notice',
            'Usuario '.$nomUser.' eliminada!'
        );
        return $this->redirectToRoute('user_list');
    }




}
