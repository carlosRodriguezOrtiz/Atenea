<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Rol;
use App\Entity\Empresa;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

     /*    ,array(
            new NotBlank(),
            new Length(array('min' => 3))) */

            
        $builder
            ->add('email', EmailType::class )
            ->add('username', TextType::class)
            ->add('role', EntityType::class, array('class' => Rol::class,
            'choice_label' => 'nombre'))
            ->add('empresa', EntityType::class, array('class' => Empresa::class,
            'choice_label' => 'nombre'))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repetir Password'),
            ) 
        )
            ->add('Send', SubmitType::class,[
                'attr' => ['class' => 'b1']
            ], array('label' => $options['submit']));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\User',
            'submit' => 'Enviar'
        ));
    }
}
