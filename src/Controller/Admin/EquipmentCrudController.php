<?php

namespace App\Controller\Admin;

use App\Entity\Equipment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EquipmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Equipment::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setEntityLabelInSingular('Équipement')
            ->setEntityLabelInPlural('Équipements')
            ->setPageTitle(pageName: Crud::PAGE_INDEX, title: 'Équipements')
            ->setPageTitle(pageName: Crud::PAGE_NEW, title: 'Créer un équipement')
            ->setPageTitle(pageName: Crud::PAGE_EDIT, title: 'Modifier l\'équipement');
    }


    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('name')
            ->setLabel('Titre'),
        ];
    }
    
}
