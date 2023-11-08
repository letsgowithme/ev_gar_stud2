<?php

namespace App\Form;

use App\Entity\Features;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FeaturesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('width', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 1440
            ],
            'label' => 'Largeur',
            'label_attr' => [
                'class' => 'form-label mt-4 text-dark fs-5'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan(1440)
            ]
        ])
        ->add('length', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 1440
            ],
            'label' => 'Longueur',
            'label_attr' => [
                'class' => 'form-label mt-4 text-dark fs-5'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan(1440)
            ]
        ])
        ->add('height', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 1440
            ],
            'label' => 'Hauteur',
            'label_attr' => [
                'class' => 'form-label mt-4 text-dark fs-5'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan(1440)
            ]
        ])
        ->add('weight', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 1440
            ],
            'label' => 'Poids',
            'label_attr' => [
                'class' => 'form-label mt-4 text-dark fs-5'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan(1440)
            ]
        ])
        ->add('price_min', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 1440
            ],
            'label' => 'Prix minimal',
            'label_attr' => [
                'class' => 'form-label mt-4 text-dark fs-5'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan(1440)
            ]
        ])
        ->add('price_max', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 1440
            ],
            'label' => 'Prix maximal',
            'label_attr' => [
                'class' => 'form-label mt-4 text-dark fs-5'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan(1440)
            ]
        ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4 fs-4'
                ],
                'label' => 'Sauvegarder',
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Features::class,
        ]);
    }
}