<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setEntityLabelInSingular('Service')
            ->setEntityLabelInPlural('Services')
            ->setPageTitle(pageName: Crud::PAGE_INDEX, title: 'Services')
            ->setPageTitle(pageName: Crud::PAGE_NEW, title: 'Créer une service')
            ->setPageTitle(pageName: Crud::PAGE_EDIT, title: 'Modifier le service');
    }


    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('title')
            ->setLabel('Titre'),
            TextEditorField::new('description')
            ->setFormType(CKEditorType::class)
            ->hideOnIndex(),
        ];
    }
    
}
