<?php

namespace App\Controller\Admin;

use App\Entity\PhotosQuiSommesNous;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PhotosQuiSommesNousCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PhotosQuiSommesNous::class;
    }

    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setEntityLabelInSingular('Photo dans le diaporama')
        ->setEntityLabelInPlural('Photos dans le diaporama')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            ImageField::new('photo')->setBasePath('uploads/')
            ->setUploadDir('public/uploads/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(true),
            BooleanField::new('visible')
        ];
    }
    
}
