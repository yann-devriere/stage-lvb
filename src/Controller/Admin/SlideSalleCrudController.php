<?php

namespace App\Controller\Admin;

use App\Entity\SlideSalle;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SlideSalleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SlideSalle::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setEntityLabelInSingular('Photo du diaporama concernant la salle')
        ->setEntityLabelInPlural('Photos du diaporama concernant la salle')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('photo')->setBasePath('uploads/')
            ->setUploadDir('public/uploads/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(true),
            BooleanField::new('visible'),
        ];
    }
    
}
