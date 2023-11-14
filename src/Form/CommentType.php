<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            'label' => 'Titre',
            'label_attr' => [
                'class' => 'form-label mt-4 text-dark fs-5',
                'minLength' => '2',
                'maxLength' => '255'
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 50]),
                new Assert\NotBlank()
            ]
        ])
            ->add(
                'content',
                TextareaType::class,
                [
                    'attr' => [
                        'class' => 'form-control block w-full px-3 py-1.5 text-base font-normal bg-white bg-clip border border-solid text-gray-700 focus:border-blue-600 focus-outline-none'
                    ],
                    'label' => 'Poster un nouveau commentaire',
                    'label_attr' => [
                        'class' => 'form-label inline-block mb-2 text-light-700'
                    ],
                    'constraints' => [
                        new Assert\NotBlank()
                    ]
                ]
            )
            ->add('author', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom/Prénom',
                'label_attr' => [
                    'class' => 'form-label mt-4 text-dark fs-5',
                    'minLength' => '3',
                    'maxLength' => '50'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 3, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('mark', ChoiceType::class, [
                'choices' => [
                    'Choisir' => "",
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4'=> '4',
                    '5'=> '5'
   
                ],
                'attr' => [
                    'class' => 'form-select mb-4 fs-4'
                ],
                'label' => 'Note: 5-Très bien, 4-Bien, 3-Moyen, 2-Pas bien, 1- Pas bien du tout',
                'label_attr' => [
                    'class' => 'form-label mt-4 text-dark fs-5'
                ],
                'multiple' => false,
                'required' => true,
    
            ])
            ->add('isApproved', HiddenType::class,[
                'data' => '0',
            ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4 mb-5'
                ],
                'label' => 'Envoyer le commentaire'
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
