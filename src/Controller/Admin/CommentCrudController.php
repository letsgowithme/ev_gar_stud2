<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class CommentCrudController extends AbstractCrudController
{
   
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Témoignage')
            ->setEntityLabelInPlural('Témoignages')
            ->setPageTitle(pageName:Crud::PAGE_INDEX, title: 'Témoignage')
            ->setPageTitle(pageName:Crud::PAGE_NEW, title: 'Créer un Témoignage')
            ->setPageTitle(pageName:Crud::PAGE_EDIT, title: 'Modifier le Témoignage')
            ;
    } 
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('subject')
            ->setLabel('Sujet'),     
            TextEditorField::new('content')
            ->setFormType(CKEditorType::class)
            ->setLabel('Contenu'), 
            TextField::new('commentator')
            ->setLabel('Nom/Prénom'),   
            NumberField::new('mark')
            ->setLabel('Note'),
            BooleanField::new('isApproved')
            ->setLabel('Approuvé ?'),
            BooleanField::new('isProcessed')
            ->setLabel('Traité ?')
          
        ];
    }
    
}
