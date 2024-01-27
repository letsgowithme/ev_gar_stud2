<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setEntityLabelInSingular('Annonce')
            ->setEntityLabelInPlural('Annonces')
            ->setPageTitle(pageName: Crud::PAGE_INDEX, title: 'Annonces')
            ->setPageTitle(pageName: Crud::PAGE_NEW, title: 'Créer une annonce')
            ->setPageTitle(pageName: Crud::PAGE_EDIT, title: 'Modifier l\'annonce');
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('title')
            ->setLabel('Titre d\'annonce'),
            ImageField::new('imageName')
            ->setFormType(FileUploadType::class)
            ->setUploadDir('/public/uploads')
            ->setRequired(false)
            ->setLabel('Image principale')
            ->hideOnIndex(),
            AssociationField::new('images')
            ->setRequired(false)
            ->setLabel('Images')
            ->hideOnIndex(),
            NumberField::new('year')
            ->setLabel('Année de mise en circulation')
            ->hideOnIndex(),
            NumberField::new('km')
            ->setLabel('Kilométrage '),
            TextField::new('fuelType')
            ->setLabel('Type de carburant'),
            TextField::new('color')
            ->setLabel('Couleur'),
            NumberField::new('price')
            ->setLabel('Prix '),
            AssociationField::new('equipments')
            ->setLabel('Équipement')
            ->hideOnIndex(),
            AssociationField::new('carOptions')
            ->setLabel('Options')
            ->hideOnIndex(),
            NumberField::new('width')
            ->setLabel('Largeur(cm)')
            ->hideOnIndex(),
            NumberField::new('length')
            ->setLabel('Longueur(cm)')
            ->hideOnIndex(),
            NumberField::new('height')
            ->setLabel('Hauteur(cm)')
            ->hideOnIndex(),
            NumberField::new('weight')
            ->setLabel('Poids(kg)')
            ->hideOnIndex(),
            NumberField::new('priceMin')
            ->hideOnIndex()
            ->setLabel('Prix minimal(€)'),
            NumberField::new('priceMax')
            ->setLabel('Prix maximal(€)')
            ->hideOnIndex(),
            AssociationField::new('images')
            ->setLabel('Images'),
            AssociationField::new('author')
            ->setLabel('Auteur')
        ];
    }
    
}
