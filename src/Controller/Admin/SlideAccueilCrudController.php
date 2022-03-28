<?php

namespace App\Controller\Admin;

use App\Entity\SlideAccueil;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class SlideAccueilCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SlideAccueil::class;
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
