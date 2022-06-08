<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
            $builder
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'constraints' => new Length(null, 2, 35),
                'constraints' => new Regex([
                'pattern' => '/[^a-zA-Z]$/',
                'match' => false,
                    'message' => 'Seules les lettres sont autorisées',
                ]),
                'required' => true,
                'attr' => [
                    'placeholder'=> 'Merci de saisir votre prénom',
                    'class'=>'form-control',
                ]
            ])
            ->add('nom', TextType::class,[
                'label'=> 'Nom',
                'constraints' => new Length(null, 2, 35),
                'constraints' => new Regex([
                    'pattern' => '/[^a-zA-Z]$/',
                    'match' => false,
                    'message' => 'Seules les lettres sont autorisées',
                ]),
                'required' => true,
                'attr' => [
                    'class'=>'form-control',
                    'placeholder' =>'Merci de saisir votre nom'
                ]
            ])



            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [new Length(null, 2, 55), new Email([
                    'message' => 'Le mail "{{ value }}" est invalide.',
                ])],
                'required' => true,
                'attr' => [
                    'class'=>'form-control',
                    'placeholder' => 'Merci de saisir votre adresse email'
                ]
            ])


            ->add('password', RepeatedType::class, [
                'type'=> PasswordType::class,
                'invalid_message'=> 'Le mot de passe et la confirmation doivent être identiques.',

                'required' => true,
                'first_options'=> [
                    'label' => 'Mot de passe',
                    'constraints' => new Length(null, 8, 55),
                    'constraints' => new Regex([
                    'pattern' => '/^(?=.*?[A-Z])(?=.*?[0-9]).{8,}$/',


                    'message' => 'Doit contenir au moins 8 caractères dont une majuscule et un chiffre' ,
                    ]),

                    'attr' => [
                        'class'=>'form-control',
                        'placeholder' => 'Merci de saisir un mot de passe'
                        ]
                ],
                'second_options' => [
                    'label' => 'Confirmez le mot de passe',
                    'constraints' => new Length(null, 8, 55),
                    'constraints' => new Regex([
                        'pattern' => '/^(?=.*?[A-Z])(?=.*?[0-9]).{8,}$/',
                        ]),
                        'required' => true,
                'attr' => [
                    'class'=>'form-control',
                    'placeholder' => 'Merci confirmer votre mot de passe'
                ]
                ],
            ])

            ->add('newsletter', CheckboxType::class , [
                'label'=> "Souaitez-vous recvoir des informations régulières concernant le club ?",   
                'required'=>false             
            ])
            ->add('cgu', CheckboxType::class , [
                'label'=> "J'accepte les conditions d'utilisations",   
                'required'=>true   
            ])
            ->add('recaptcha', ReCaptchaType::class,[
                'attr'=>[ 
                    'class'=>'text-center',
                    
                ]
            ])

            // ->add('submit', SubmitType::class, [
            //     'label' => "S'inscrire",
            //     'row_attr'=>['class'=>'text-center mb-3' ,], 
            //     'attr' => [
            //         'class'=>'btn bg-jaune text-center',
            //         'onClick'=> "this.form.submit(); this.disabled=true;",
                    
            //     ]

            // ])

            

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

