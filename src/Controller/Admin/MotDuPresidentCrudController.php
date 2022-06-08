<?php

namespace App\Controller\Admin;

use App\Entity\MotDuPresident;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MotDuPresidentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MotDuPresident::class;
    }



    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setEntityLabelInSingular("Mot d'un membre du bureau")
        ->setEntityLabelInPlural("Mots des memebres du bureau (3 maximum)")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom','Prénom Nom'),
            TextField::new('role','Rôle au sein du bureau'),
            ImageField::new('photo','Portrait du membre')->setBasePath('uploads/')
            ->setUploadDir('public/uploads/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(true),
            TextEditorField::new('texte','Mot du membre'),
        ];
    }
    
}
