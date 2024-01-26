<?php

namespace App\Controller\Admin;

use App\Entity\CarOption;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarOptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CarOption::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setEntityLabelInSingular('Option')
            ->setEntityLabelInPlural('Options')
            ->setPageTitle(pageName: Crud::PAGE_INDEX, title: 'Options')
            ->setPageTitle(pageName: Crud::PAGE_NEW, title: 'Créer une option')
            ->setPageTitle(pageName: Crud::PAGE_EDIT, title: 'Modifier l\'option');
    }


    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('name')
            ->setLabel('Titre')
        ];
    }
    
}
