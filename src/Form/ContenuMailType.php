<?php

namespace App\Form;

use App\Entity\ContenuMail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContenuMailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet', TextType::class, [
                'attr'=>[
                    'placeholde'=>'Objet du mail',
                    'label'=>'Objet du mail'
                ]
            ])
            ->add('texte', CKEditorType::class,[
                
                'attr'=>[
                    'placeholde'=>'Saissez votre mail...',
                    'label'=>'Contenu du mail'

                ]
            ])
            ->add('submit', SubmitType::class, [
                    'label'=>'Envoyer à tous les membres de la newsletter'
                
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContenuMail::class,
        ]);
    }
}
