<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LendingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'attr' =>
                    [
                        'class' => 'form-control',
                        'placeholder' => 'Record title',
                    ]
                ]
            )
            ->add(
                'lendingDate',
                DateType::class,
                [
                    'widget' => 'choice',
                    'placeholder' =>
                    [
                        'year' => 'Year',
                        'month' => 'Month',
                        'day' => 'Day'
                    ],
                    'format' => 'yyyy-MM-dd',
                    'attr' =>
                    [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add(
                'dueDate',
                DateType::class,
                [
                    'widget' => 'choice',
                    'placeholder' =>
                        [
                            'year' => 'Year',
                            'month' => 'Month',
                            'day' => 'Day'
                        ],
                    'format' => 'yyyy-MM-dd',
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'returnDate',
                DateType::class,
                [
                    'required' => false,
                    'widget' => 'choice',
                    'placeholder' =>
                        [
                            'year' => 'Year',
                            'month' => 'Month',
                            'day' => 'Day'
                        ],
                    'format' => 'yyyy-MM-dd',
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'required' => false,
                    'attr' =>
                    [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'user',
                EntityType::class,
                [
                    'class' => 'AppBundle\Entity\User',
                    'choice_label' => 'fullName',
                    'attr' =>
                    [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'book',
                EntityType::class,
                [
                    'class' => 'AppBundle\Entity\Book',
                    'choice_label' => 'bookAndAuthor',
                    'attr' =>
                        [
                            'class' => 'form-control'
                        ]
                ]
            )
            ->add(
                'status',
                ChoiceType::class,
                [
                    'choices' =>
                    [
                        'Lent' => 'Lent',
                        'Returned' => 'Returned',
                        'Other' => 'Other',
                    ],
                    'attr' =>
                        [
                            'class' => 'form-control'
                        ]
                ]
            )
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Lending'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_lending';
    }
}
