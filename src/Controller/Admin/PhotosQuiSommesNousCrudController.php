<?php

namespace App\Controller\Admin;

use App\Entity\PhotosQuiSommesNous;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class PhotosQuiSommesNousCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PhotosQuiSommesNous::class;
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
