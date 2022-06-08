<?php

namespace App\Controller\Admin;

use App\Entity\Horaires;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HorairesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaires::class;
    }


    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->remove(Crud::PAGE_INDEX, Action::NEW)
        ->remove(Crud::PAGE_INDEX, Action::DELETE);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('jourPremierEntrainement')->setChoices([
                'Lundi' => 'Lundi',
                'Mardi' => 'Mardi',
                'Mercredi' => 'Mercredi',
                'Jeudi' => 'Jeudi',
                'Vendredi' => 'Vendredi',
                'Samedi' => 'Samedi',
                'Dimanche' => 'Dimanche',
            ]),
            TimeField::new('debutPremierEntrainement', 'Heure de debut'),
            TimeField::new('finPremierEntrainement', 'Heure de fin'),
            BooleanField::new('deuxiemeEntrainementExiste', "Y a t'il toujours un deuxieme entraînement ?"),
            ChoiceField::new('jourDeuxiemeEntrainement',"Jour du deuxième entraînement")->setChoices([
                'Lundi' => 'Lundi',
                'Mardi' => 'Mardi',
                'Mercredi' => 'Mercredi',
                'Jeudi' => 'Jeudi',
                'Vendredi' => 'Vendredi',
                'Samedi' => 'Samedi',
                'Dimanche' => 'Dimanche',
            ]),
            TimeField::new('debutDeuxiemeEntrainement', 'Heure de debut'),
            TimeField::new('finDeuxiemeEntrainement', 'Heure de fin'),

            BooleanField::new('enfantsEntrainementExiste', "Y a t'il toujours une section enfant ?"),
            ChoiceField::new('jourEnfantsEntrainement', "Jour de l'entraînement des enfants")->setChoices([
                'Lundi' => 'Lundi',
                'Mardi' => 'Mardi',
                'Mercredi' => 'Mercredi',
                'Jeudi' => 'Jeudi',
                'Vendredi' => 'Vendredi',
                'Samedi' => 'Samedi',
                'Dimanche' => 'Dimanche',
            ]),
            TimeField::new('debutEnfantsEntrainement', 'Heure de debut'),
            TimeField::new('finEnfantsEntrainement', 'Heure de fin'),

        ];
    }
    
}
