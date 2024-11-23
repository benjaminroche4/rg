<?php

namespace App\Controller\Admin;

use App\Entity\BlogPost;
use App\Enum\PublicationStatus;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class BlogPostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogPost::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setPageTitle('index', 'Articles')
            ->setPageTitle('new', 'Créer un article')
            ->setPageTitle('edit', 'Modifier un article')
            ->setPageTitle('detail', 'Détail de l\'article')
            ->setEntityLabelInSingular('un article')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('title', 'Titre'),
            TextareaField::new('summary', 'Résumé')->setHelp('Max 160 caractères'),
            TextEditorField::new('content', 'Contenu')
                ->setTrixEditorConfig(
                    [
                        'blockAttributes' => [
                            'default' => ['tagName' => 'p'],
                            'heading1' => ['tagName' => 'h2'],
                        ],
                    ])
                ->setHelp('Ceci est le corp du l\'article. Pensez à structurer votre contenu pour le SEO.'),
            ChoiceField::new('status', 'Statut')->setChoices(PublicationStatus::getChoices()),
            AssociationField::new('category', 'Catégorie')->setRequired(true),
            AssociationField::new('editor', 'Éditeur')->setRequired(true),
            ImageField::new('mainPhotoUrl', 'Photo de l\'article')->setUploadDir('public/uploads/blog')
                ->setBasePath('medias/images')
                ->setRequired(false)
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            //max size + type JPG PNG WEBP
        ];
    }
}
