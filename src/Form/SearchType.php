<?php
namespace App\Form;


use App\Classe\Search;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
                    'pattern' => '/\d/',
                    'match' => false,
                    'message' => 'Vous ne pouvez faire de recherche avec un chiffre',
                ]),
                'attr'=>[
                'placeholder'=>'Votre recherche...',
                'class'=>'form-control-sm'
                ]
            ])
        
            ->add('categories', EntityType::class,[
                'label'=>false,
                'required'=> false,
                'class'=> Categorie::class,
                'multiple'=> true,
                'expanded'=> true
            ])

            ->add('submit', SubmitType::class,[
                'label'=>'Filtrer',
                'attr'=>[
                    'class'=>'btn btn-inscription ms-4'
                ]
            ])
        ;
    }

    public function getBlockPrefix()
    {
        return '';
    }

}
