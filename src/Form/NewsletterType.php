<?php

namespace App\Form;

use App\Entity\Newsletter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class , [
                'required'=>true,
                    'label'=>false,
            'attr'=>[
                'placeholder'=>'Votre adresse email',
                'class' => 'ps-3  m-0 ',

            ],

                ])

        //     ->add('submit', SubmitType::class, ['label'=>"S'inscrire",
        //         'attr'=> ['placeholde'=>"S'inscrire à la newsletter",
        //         'class'=>'text-light   m-0 btn my-auto py-0 '],
        //         'row_attr'=> ['class'=>'m-0 p-0'],
        // ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Newsletter::class,
        ]);
    }
}
