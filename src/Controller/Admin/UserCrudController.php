<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
   
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
{
return $crud
            ->setEntityLabelInPlural('Employés')
            ->setEntityLabelInSingular('Employé')
            ->setSearchFields(['lastname'])
            ->setPageTitle("index", "Administration des employés")
            ->setDefaultSort(['lastname' => 'asc'])
            ->setPageTitle(pageName:Crud::PAGE_INDEX, title: 'Employé')
            ->setPageTitle(pageName:Crud::PAGE_NEW, title: 'Créer un employé')
            ->setPageTitle(pageName:Crud::PAGE_EDIT, title: 'Modifier l\'employé');
}

 public function configureActions(Actions $actions): Actions
 {
  
    $linkExterne = Action::new('linkExterne', 'Générer le mot de passe', 'fa fa-glob')
        ->linkToUrl("https://www.motdepasse.xyz/")
        ->setHtmlAttributes([
            'target' => '_blank'
        ])
        
        ->addCssClass('btn btn-success');
    return $actions
    ->add(Crud::PAGE_NEW, $linkExterne);
 }

public function configureFields(string $pageName): iterable
{
     $roles = ['ROLE_USER', 'ROLE_ADMIN'];
return [
IdField::new('id')
->hideOnForm(),
TextField::new('lastname')
->setLabel('Nom'),
TextField::new('firstname')
->setLabel('Prénom'),
TextField::new('email'),
TextField::new('plainPassword', 'password')
    ->setFormType(PasswordType::class)
    ->setRequired($pageName === Crud::PAGE_NEW)
    ->onlyOnForms()
    ->setLabel('Mot de passe'),
ArrayField::new('roles')
        ->setLabel('Rôle'),
];
}

public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    $this->encodePassword($entityInstance);
    parent::persistEntity($entityManager, $entityInstance);
}

// public function passGenerator(AdminContext $context):Response
// {
//  $password = $context->getEntity()->getInstance('password');
// }

public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    $this->encodePassword($entityInstance);
    parent::updateEntity($entityManager, $entityInstance);
}
private UserPasswordHasherInterface $hasher;

public function __construct(UserPasswordHasherInterface $hasher) 
{
$this->hasher = $hasher;
}
public function prePersist(User $user) {
$this->encodePassword($user);
}

public function preUpdate(User $user) {
$this->encodePassword($user);
}
/**
* 
* Encode password based on plain password
*
* @param User $user
* @return void
*/
private function encodePassword(User $user)
{
    if ($user->getPlainPassword() !== null) {
        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                $user->getPlainPassword()
   
   )
   );
   $user->setPlainPassword(null);
   }

    }
}




