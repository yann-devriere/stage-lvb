<?php
namespace App\Form;


use App\Classe\Search;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Regex;


class SearchType extends AbstractType
{


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
             'method'=> 'GET',
             'csrf_protection'=> false,

        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('string', TextType::class,[
                'label'=>false,
                'required'=> false,
                'constraints' => new Length(null, 2, 30),
                'constraints' => new Regex([
                    'pattern' => '/[^a-zA-Z0-9]$/',
                    'match' => false,
                    'message' => 'Vous ne pouvez faire de recherche avec des caractères autres que des chiffres ou des lettres.',
                ]),
                'attr'=>[
                'placeholder'=>'Votre recherche...',
                'class'=>'form-control-sm my-auto'
                ]
            ])

            ->add('categories', EntityType::class,[
                'class'=> Categorie::class,
                'placeholder'=>'Catégories',
                'label'=>false,
                'multiple'=>false,
                'required'=> false,
                'expanded' => false,
            'attr'=>[
                'class'=>'form-control-sm text-dark select my-auto',
            ],
                ])
        
            // ->add('categories', EntityType::class,[
            //     'class'=> Categorie::class,
            //     'label'=>false,
            //     // 'required'=> false,
            //     // 'multiple'=> false,
            //     'attr'=> [
            //         'class'=> 'form-control'
            //     ],
            //     // 'expanded'=> false
            // ])
        

            // ->add('submit', SubmitType::class,[
            //      'label'=>'Filtrer',
            //     'attr'=>[
            //         'class'=>'btn'
            //     ]
            // ])
        ;
    }

    public function getBlockPrefix()
    {
        return '';
    }

}
