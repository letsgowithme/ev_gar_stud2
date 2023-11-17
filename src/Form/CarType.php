<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Equipment;
use App\Entity\Option;
use App\Entity\Modeles;
use App\Repository\EquipmentRepository;
use App\Repository\OptionRepository;
use App\Repository\ModelesRepository;
use PhpParser\Parser\Multiple;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
                'class' => 'form-label mt-4 fw-bold text-dark fs-4',
                'minLength' => '2',
                'maxLength' => '255'
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 50]),
                new Assert\NotBlank()
            ]
        ])
        // ->add('modele', EntityType::class, [
        //     'class' => Modele::class,
        //     'query_builder' => function (ModeleRepository $r) {
        //         return $r->createQueryBuilder('i')
        //             ->orderBy('i.marque', 'ASC');
        //     },
        //     'label' => 'Modele',
        //     'label_attr' => [
        //         'class' => 'form-label mt-4 mb-4 text-dark fs-4'
        //     ],

        //     'choice_label' => 'marque',
        //     'multiple' => false,
        //     'expanded' => false
        // ])
        ->add('year', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'L\'année de mise en circulation',
            'label_attr' => [
                'class' => 'form-label mt-4  fw-bold  text-dark fs-4',
                'minLength' => '4',
                'maxLength' => '4'
            ],
            'constraints' => [
                new Assert\Length(['min' => 4, 'max' => 4]),
                new Assert\NotBlank()
            ]
        ])
        ->add('km', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 300000
            ],
            'label' => 'Kilometrage',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan(300000)
            ]
        ])
        ->add('fuelType', ChoiceType::class, [
            'choices' => [
                'Choisir' => "",
                'Essence' => 'Essence',
                'Diesel' => 'Diesel',
                'Electrique' => 'Electrique'
                
            ],
            'attr' => [
                'class' => 'form-select mb-4 fs-4'
            ],
            'label' => 'Type de carburant',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'multiple' => false,
            'required' => true,

        ])
       
        ->add('price', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 1000000
            ],
            'label' => 'Prix',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan(1000000)
            ]
        ])
        ->add('color', ChoiceType::class, [
            'choices' => [
                'Choisir la couleur' => "",
                'Noir' => 'Noir',
                'Blanc' => 'Blanc',
                'Vert' => 'Vert',
                'Rouge' => 'Rouge',
                'Argent' => 'Argent',
                'Orange' => 'Orange',
                'Bleu' => 'Bleu',
                'Gris' => 'Gris',
                'Beige' => 'Beige',
                'Autre' => 'Autre',
            ],
            'attr' => [
                'class' => 'form-select mb-4 fs-4'
            ],
            'label' => 'Couleur',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'required' => true,

        ])
        ->add('imageFile', VichImageType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => "Photo principale",
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'required' => false,
           
        ])
        ->add('images', FileType::class, [
            'attr' => [
                'class' => 'form-control mb-4'
            ],
            'label' => 'Vous pouvez rajouter 3 photos',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'multiple' => true,
            'required' => false,
            'mapped' => false
            
        ])
        ->add('equipments', EntityType::class, [
            'class' => Equipment::class,
            'query_builder' => function (EquipmentRepository $r) {
                return $r->createQueryBuilder('i')
                    ->orderBy('i.name', 'ASC');
            },
            'attr' => [
                'class' => 'mb-4'
            ],
            'label' => 'Équipement',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  mb-4 text-dark fs-4'
            ],

            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true
        ])
        ->add('options', EntityType::class, [
            'class' => Option::class,
            'query_builder' => function (OptionRepository $r) {
                return $r->createQueryBuilder('i')
                    ->orderBy('i.name', 'ASC');
            },
            'attr' => [
                'class' => 'mb-4'
            ],
            'label' => 'Options',
            'label_attr' => [
                'class' => 'form-label mt-4 mb-4 fw-bold  text-dark fs-4'
            ],

            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true
        ])
        ->add('width', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
               
            ], 
            'label' => 'Largeur',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'required' => false,
            'constraints' => [
                new Assert\Positive(),
               
            ]
        ])
        ->add('length', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
               
            ],
            'label' => 'Longueur',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'required' => false,
            'constraints' => [
                new Assert\Positive(),
               
            ]
        ])
        ->add('height', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
               
            ],
            'label' => 'Hauteur',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'required' => false,
            'constraints' => [
                new Assert\Positive(),
               
            ]
        ])
        ->add('weight', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
               
            ],
            'label' => 'Poids',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'required' => false,
            'constraints' => [
                new Assert\Positive(),
               
            ]
        ])
        ->add('priceMin', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
               
            ],
            'label' => 'Prix minimal',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'required' => false,
            'constraints' => [
                new Assert\Positive(),
               
            ]
        ])
        ->add('priceMax', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
               
            ],
            'required' => false,
            'label' => 'Prix maximal',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'constraints' => [
                new Assert\Positive(),
               
            ]
        ])
            
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4 fs-4'
                ],
                'label' => 'Sauvegarder',
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
