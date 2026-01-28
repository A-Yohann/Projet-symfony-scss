<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Commentaire')
            ->setEntityLabelInPlural('Commentaires')
            ->setDefaultSort(['creatAt' => 'DESC'])
            ->setPageTitle('index', 'Gestion des Commentaires')
            ->setPageTitle('detail', 'Détails du Commentaire');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::EDIT, Action::NEW)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            
            TextField::new('author', 'Auteur')
                ->setColumns(6),
            
            AssociationField::new('categorieHorloge', 'Horloge')
                ->setColumns(6),
            
            TextareaField::new('content', 'Commentaire')
                ->setColumns(12)
                ->hideOnIndex(),
            
            TextField::new('content', 'Commentaire')
                ->formatValue(function ($value) {
                    return strlen($value) > 100 ? substr($value, 0, 100) . '...' : $value;
                })
                ->onlyOnIndex(),
            
            DateTimeField::new('creatAt', 'Date de création')
                ->setFormat('dd/MM/yyyy HH:mm')
                ->setColumns(6),
        ];
    }
}