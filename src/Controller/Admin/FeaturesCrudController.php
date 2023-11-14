<?php

namespace App\Controller\Admin;

use App\Entity\Features;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FeaturesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Features::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setEntityLabelInSingular('Caratéristique')
            ->setEntityLabelInPlural('Caratéristiques')
            ->setPageTitle(pageName: Crud::PAGE_INDEX, title: 'Caratéristiques')
            ->setPageTitle(pageName: Crud::PAGE_NEW, title: 'Créer une caratéristique')
            ->setPageTitle(pageName: Crud::PAGE_EDIT, title: 'Modifier la caratéristiques');
    }


    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            NumberField::new('width')
            ->setLabel('Largeur'),
            NumberField::new('length')
            ->setLabel('Longueur'),
            NumberField::new('height')
            ->setLabel('Hauteur'),
            NumberField::new('weight')
            ->setLabel('Poids'),
            NumberField::new('price_min')
            ->setLabel('Prix minimal'),
            NumberField::new('price_max')
            ->setLabel('Prix maximal'),
           
        ];
    }
    
}
