<?php

namespace App\Controller\Admin;

use App\Entity\BlogEditor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[AdminDashboard]
class BlogEditorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogEditor::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::DELETE);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('fullName', 'Nom/Prénom'),
            TextField::new('roleEditor', 'Rôle')
                ->setHelp('Exemple: Rédacteur en chef, Journaliste, etc.'),
            ImageField::new('profilePhotoUrl', 'Photo de profil')->setUploadDir('public/uploads/blog')
                ->setBasePath('medias/images')
                ->setRequired(false)
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                ->setRequired(true),
            DateTimeField::new('createdAt')->hideOnForm(),
        ];
    }
}
