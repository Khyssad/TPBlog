<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
IdField::new('id')->onlyOnDetail(),
            TextField::new('title')
                ->setLabel('Titre')
                ->setHelp('Entrez le titre de l\'article'),
            TextEditorField::new('content')
                ->setLabel('Contenu')
                ->hideOnIndex(),
            TextField::new('author')
                ->setLabel('Auteur'),
            BooleanField::new('isPremium')
                ->setLabel('Premium'),
            DateTimeField::new('createdAt')
                ->setLabel('Créé le')
                ->setFormat('dd/MM/yyyy HH:mm:ss')
                ->hideOnForm(),
            DateTimeField::new('updatedAt')
                ->setLabel('Mis à jour le')
                ->setFormat('dd/MM/yyyy HH:mm:ss')
                ->hideOnForm(),
        ];
    }
}
