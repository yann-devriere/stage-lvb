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
            ->add('email', RepeatedType::class , [
                'type'=> EmailType::class,
                'invalid_message'=>'Les adresses doivent être identiques',
                'required'=>true,
                'first_options'=>['label'=>false,
            'attr'=>[
                'placeholder'=>'Votre adresse email'
            ]],
                'second_options'=>['label'=>false,
                'attr'=>[
                    'placeholder'=>'Vérifiez votre adresse email'
                ]]

                ])

            ->add('submit', SubmitType::class, ['label'=>"S'inscrire",
                'attr'=> ['placeholde'=>"S'inscrire à la newsletter",
                'class'=>'bg-bleu text-light']
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Newsletter::class,
        ]);
    }
}
