<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Titre',
            'label_attr' => [
                'class' => 'form-label mt-4 text-dark fs-5',
                'minLength' => '2',
                'maxLength' => '255'
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 255]),
                new Assert\NotBlank()
            ]
        ])
        ->add('description', CKEditorType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Description',
            'label_attr' => [
                'class' => 'form-label mt-4 text-dark fs-5'
            ],
            'constraints' => [
                new Assert\NotBlank()
            ]
        ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary mt-4 fs-4'
            ],
            'label' => 'Sauvegarder',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
