<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\TipusQE;
use App\Entity\SubTipusQE;



class QuestionsExternesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        
            ->add('Nombre', TextType::class)
            ->add('tipus', EntityType::class, array('class' => TipusQE::class,
            'choice_label' => 'nombre'))
            ->add('subtipus', EntityType::class, array('class' => SubTipusQE::class,
              'choice_label' => 'descripcion' 
            ))  
            ->add('save', SubmitType::class, array('label' => $options['submit']));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'submit' => 'Enviar',
            'data_class' => 'App\Entity\QuestionsExternes',

        ]);
    }

} 
