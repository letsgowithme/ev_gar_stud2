<?php

namespace App\Form;

use App\Entity\Car;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CarType extends AbstractType
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
        ->add('year', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'L\'année de mise en circulation',
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
        ->add('km', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 1440
            ],
            'label' => 'Kilometrage',
            'label_attr' => [
                'class' => 'form-label mt-4 text-dark fs-5'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan(1440)
            ]
        ])
        ->add('fuelType', CheckboxType::class, [
            'attr' => [
                'class' => 'form-check-input mt-4 mb-4',
            ],
            'required' => false,
            'label' => 'Type de carburant',
            'label_attr' => [
                'class' => 'form-check-label mt-3 ms-3 text-dark fs-5 mb-4'
            ],
            'constraints' => [
                new Assert\NotNull()
            ]
        ])
        ->add('price', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 1440
            ],
            'label' => 'Prix',
            'label_attr' => [
                'class' => 'form-label mt-4 text-dark fs-5'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan(1440)
            ]
        ])
        ->add('color', ChoiceType::class, [
            'choices' => [
                'Choisir la couleur' => "",
                'Noir' => 1,
                'Blanc' => 2,
                'Vert' => 3,
                'Rouge' => 4,
                'Argent' => 5,
                'Orange' => 6,
                'Bleu' => 7,
                'Gris' => 8,
                'Beige' => 9,
                'Autre' => 10,
            ],
            'attr' => [
                'class' => 'form-select mb-4 fs-4'
            ],
            'label' => 'Couleur',
            'label_attr' => [
                'class' => 'form-label mt-4 d-none'
            ],
            'required' => true,

        ])
        ->add('imageFile', VichImageType::class, [
            'label' => 'Image de la recette',
            'label_attr' => [
                'class' => 'form-label mt-4 w-350 h-auto mt-4 mb-4'
            ],
            'required' => false
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
            'data_class' => Car::class,
        ]);
    }
}
