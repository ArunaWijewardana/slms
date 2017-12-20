<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
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
                'amount',
                NumberType::class,
                [
                    'attr' =>
                        [
                            'class' => 'form-control',
                            'step' => '0.01'
                        ]
                ]
            )
            ->add(
                'paymentDate',
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
                'paymentCategory',
                EntityType::class,
                [
                    'class' => 'AppBundle\Entity\PaymentCategory',
                    'choice_label' => 'title',
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
                            'Pending' => 'Pending',
                            'Settled' => 'Settled',
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
            'data_class' => 'AppBundle\Entity\Payment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_payment';
    }
}
