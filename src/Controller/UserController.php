<?php

namespace App\Controller;
use App\Entity\User;
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


    /**
     * @Route("/user/userinfo", name="contexto")
     */
    public function infouser()
    {
        $usr= $this->getUser();

  
        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find($usr->getId());
        var_dump($user->getRole()->getNombre());
        var_dump($user->getEmpresa()->getNombre());
        exit();
    }




}
