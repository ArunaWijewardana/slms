<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
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
                        ]
                ]
            )
            ->add(
                'author',
                TextType::class,
                [
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'publishingYear',
                DateType::class,
                [
                    'label' => 'Publishing Year',
                    'years' => $this->getYears(1800),
                    'months' => array(true),
                    'days' => array(true),
                    'attr' =>
                        [
                            'class' => 'form-control',
                        ]
                ]
            )
            ->add(
                'publishingPlace',
                TextType::class,
                [
                    'label' => 'Publishing Place',
                    'attr' =>
                        [
                            'class' => 'form-control',
                            'placeholder' => 'City, Country',
                        ]
                ]
            )
            ->add(
                'quantity',
                IntegerType::class,
                [
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
                'bookCategory',
                EntityType::class,
                [
                    'label' => 'Book Category',
                    'class' => 'AppBundle\Entity\BookCategory',
                    'choice_label' => 'title',
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
            'data_class' => 'AppBundle\Entity\Book'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_book';
    }

    private function getYears($max, $min='current')
    {
        $years = range(($min === 'current' ? date('Y') : $min), $max);

        return array_combine($years, $years);
    }
}
