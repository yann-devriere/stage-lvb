<?php

namespace App\Form;

use App\Entity\Album;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>"Nom de l'album",
               'constraints'=>new Regex([
                    'pattern' => '/[^a-zA-Z0-9]$/',
                    'match' => false,
                    'message' => 'Aucun caractère spécial.',
                ])
            ])
            ->add('public', CheckboxType::class,[
                "label"=>"L'album doit il être visible par tout le monde ?",
                'required'=>false,
            ])


                ->add('images', FileType::class,[
                    'label'=>'Ajout des photos',
                    'multiple'=>true,
                    'mapped'=>false,
                    'required'=>true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
