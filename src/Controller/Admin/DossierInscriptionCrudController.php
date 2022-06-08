<?php

namespace App\Controller\Admin;

use App\Entity\DossierInscription;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DossierInscriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DossierInscription::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('fichier')->setBasePath('uploads/')
            ->setUploadDir('public/uploads/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(true),
        ];
    }
    
}
