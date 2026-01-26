<?php

namespace App\Controller\Admin;

use App\Entity\CategorieHorloge;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class CategorieHorlogeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategorieHorloge::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Catégorie Horloge')
            ->setEntityLabelInPlural('Catégories Horloge')
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),

            // TextField::new('title', 'Titre'),

            ImageField::new('image')
                ->setUploadDir('public/uploads/categories')
                ->setBasePath('/uploads')
                ->setRequired(false),

            // BooleanField::new('isActive', 'Visible'),
        ];
    }
}
