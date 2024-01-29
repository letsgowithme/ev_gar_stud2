<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Equipment;
use App\Entity\Images;
use App\Entity\CarOption;
use App\Repository\EquipmentRepository;
use App\Repository\CarOptionRepository;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
                'maxLength' => '100'
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 50]),
                new Assert\NotBlank()
            ]
        ])
     
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
                'max' => 30000
            ],
            'label' => 'Prix(€)',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'constraints' => [
                new Assert\Positive(),
                new Assert\LessThan(30000)
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
            'label' => 'Ajouter les photos',
            'label_attr' => [
                'class' => 'form-label mt-4 mb-4 fw-bold  text-dark fs-4'
            ],
            'multiple' => true,
            'required' => false,
            'mapped' => false,
            'constraints' => [
                new All(
                    new Image([
                        'maxWidth' => 640,
                        'maxWidthMessage' => 'L\'image doit faire {{ max_width }} pixels de large au maximum',
                        'maxSize' => '150K',
                        'maxSizeMessage' => 'L\'images doit avoir {{ max_size }}K de taille au maximum',
                        'mimeTypes' => [ 
                            'image/jpeg',
                            'image/png',
                            'image/webp'
                        ]    
                        ])
                    )
                 
            ]
            
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
                'class' => 'form-label mt-4 fw-bold  mb-4 text-dark fs-4 bg-light p-2 rounded'
            ],

            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true
        ])
        ->add('carOptions', EntityType::class, [
            'class' => CarOption::class,
            'query_builder' => function (CarOptionRepository $r) {
                return $r->createQueryBuilder('i')
                    ->orderBy('i.name', 'ASC');
            },
            'attr' => [
                'class' => 'mb-4'
            ],
            'label' => 'Options',
            'label_attr' => [
                'class' => 'form-label mt-4 mb-4 fw-bold  text-dark fs-4 bg-light p-2 rounded'
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
            'label' => 'Largeur(cm)',
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
            'label' => 'Longueur(cm)',
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
            'label' => 'Hauteur(cm)',
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
            'label' => 'Poids(kg)',
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
            'label' => 'Prix minimal(€)',
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
            'label' => 'Prix maximal(€)',
            'label_attr' => [
                'class' => 'form-label mt-4 fw-bold  text-dark fs-4'
            ],
            'constraints' => [
                new Assert\Positive(),
               
            ]
        ])
            
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4 mb-4 fs-4'
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
