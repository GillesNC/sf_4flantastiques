<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'attr' => ['class' => 'form-input'],
                'label' => 'Pseudo*',
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-input'],
                'label' => 'Adresse email*',
            ])
            ->add('bio', TextareaType::class, [
                'attr' => ['class' => 'form-input-bio'],
                'label' => 'Présentation',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'attr' => ['class' => 'form-input', 'placeholder' => '*******************'],
                    'label' => 'Mot de passe actuel',
                    'required' => false,
                ],
                'second_options' => [
                    'attr' => ['class' => 'form-input', 'placeholder' => '*******************'],
                    'label' => 'Confirmer le nouveau mot de passe',
                ],
                'invalid_message' => 'Le mot de passe et sa confirmation doivent être identiques.',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
