<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                TextType::class,
                [
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'password',
                PasswordType::class,
                [
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'firstName',
                TextType::class,
                [
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'lastName',
                TextType::class,
                [
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'identificationNumber',
                TextType::class,
                [
                    'required' => false,
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'address1',
                TextType::class,
                [
                    'required' => false,
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'address2',
                TextType::class,
                [
                    'required' => false,
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'city',
                TextType::class,
                [
                    'required' => false,
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'zipCode',
                TextType::class,
                [
                    'required' => false,
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'phone',
                TextType::class,
                [
                    'required' => false,
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'dateOfBirth',
                BirthdayType::class,
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
                'userCategory',
                EntityType::class,
                [
                    'class' => 'AppBundle\Entity\UserCategory',
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
                            'Active' => 'Active',
                            'Banned' => 'Banned',
                            'Inactive' => 'Inactive',
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
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
