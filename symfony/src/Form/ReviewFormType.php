<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('texture', ChoiceType::class, [
                'label' => 'Texture/crème',
                'attr' => ['class' => 'form-star'],
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'choice_label' => function() {
                    return ' ';
                },
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('dough', ChoiceType::class, [
                'label' => 'Pâte',
                'attr' => ['class' => 'form-star'],
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'choice_label' => function() {
                    return ' ';
                },
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('visual', ChoiceType::class, [
                'label' => 'Aspect visuel',
                'attr' => ['class' => 'form-star'],
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'choice_label' => function() {
                    return ' ';
                },
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('valueForMoney', ChoiceType::class, [
                'label' => 'Rapport qualité/prix',
                'attr' => ['class' => 'form-star'],
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'choice_label' => function() {
                    return ' ';
                },
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('comment', TextareaType::class, [
                'attr' => ['placeholder' => 'Votre petite présentation  en quelques mots...'],
                'label' => 'Expliquez vos notes en laissez votre avis',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
