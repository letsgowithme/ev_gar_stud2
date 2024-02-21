<?php

namespace App\Form;

use App\Entity\Comment;
use Doctrine\DBAL\Types\BooleanType;
use PhpParser\Node\Expr\Cast\Bool_;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('subject', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Sujet',
            'label_attr' => [
                'class' => 'form-label mt-4 text-light fs-5 fw-bold',
                'minLength' => '2',
                'maxLength' => '50'
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 50]),
                new Assert\NotBlank()
            ]
        ])
            ->add('content', TextareaType::class, [
                    'attr' => [
                        'class' => 'form-control block w-full px-3 text-base font-normal bg-white bg-clip border border-solid text-gray-700 focus:border-blue-600 focus-outline-none',
                        'minLength' => '1',
                        'maxLength' => '255'
                    ],
                    'label' => 'Contenu',
                    'label_attr' => [
                        'class' => 'form-label inline-block mb-2 fs-5 text-light fw-bold'
                    ],
                    'constraints' => [
                        new Assert\Length(['min' => 1, 'max' => 255]),
                        new Assert\NotBlank()
                    ]
                ]
            )
            ->add('commentator', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-4'
                ],
                'label' => 'Nom/Prénom',
                'label_attr' => [
                    'class' => 'form-label mt-4 text-light fs-5  fw-bold',
                    'minLength' => '1',
                    'maxLength' => '50'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('mark', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select  mb-4 fs-5'
                ],
                'choices' => [
                    'Choisir' => "",
                    '5 - Très bien'=> '5',
                    '4 - Bien'=> '4',
                    '3 - Moyen' => '3',
                    '2 - Pas bien' => '2',
                    '1 - Pas bien du tout' => '1',  
   
                ],
                
                'label' => 'Note :',
                'label_attr' => [
                    'class' => 'form-label mt-4 text-light fs-5 fw-bold'
                ],
                'multiple' => false,
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank()
                ]
    
            ])
            // ->add('isApproved', HiddenType::class,[
            //     'data' => '0',
            // ])
            ->add('isApproved', ChoiceType::class,[
                'attr' => [
                    'class' => 'form-select  mb-4 fs-5 hidden'
                ],
                "choices" => [
                'Non approuvé' => '0',
                'Approuvé' => '1'
                ],
                'label' => 'Approuver:',
                'label_attr' => [
                    'class' => 'form-label mt-4 text-light fs-5 fw-bold hidden'
                ],
            ])
            ->add('isProcessed', ChoiceType::class,[
                'attr' => [
                    'class' => 'form-select  mb-4 fs-5 hidden'
                ],
                "choices" => [
                'Non traité' => '0',
                'Traité' => '1'
                ],
                'label' => 'Traiter:',
                'label_attr' => [
                    'class' => 'form-label mt-4 text-light fs-5 fw-bold hidden'
                ],
            ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4 mb-5'
                ],
                'label' => 'Enregistrer'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
