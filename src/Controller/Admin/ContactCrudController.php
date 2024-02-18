<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Contact')
            ->setEntityLabelInPlural('Contacts')
            ->setPageTitle(pageName:Crud::PAGE_INDEX, title: 'Demandes de contact')
            ->setPageTitle(pageName:Crud::PAGE_EDIT, title: 'Modifier la demande de contact')
            ;
    } 
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('fullName')
            ->setLabel('Nom/Prénom'),
            TextField::new('email')
            ->setLabel('Email'),
            TextField::new('subject')
            ->setLabel('Sujet'),
            TextEditorField::new('message')
            ->setFormType(CKEditorType::class)
            ->hideOnIndex(),
            TextField::new('phoneNumber')
            ->setLabel('Numéro de téléphone')
        ];
    }
    
}
