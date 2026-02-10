<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'constraints' => [
                    new NotBlank(
                        message: 'Votre pseudo est obligatoire.'
                    )
                ],
                'attr' => ['class'=>'form-input', 'placeholder' => 'Pseudo'],
                'label' => 'Pseudo*',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-input', 'placeholder' => 'Email'],
                'label' => 'Adresse mail*',
                'constraints' => [
                    new NotBlank(
                        message: 'Please enter a valid email address')
                ],
                'required' => true,
            ])
            ->add('bio', TextareaType::class, [
                'attr' => ['class' => 'form-input', 'placeholder' => 'Votre petite présentation  en quelques mots...'],
                'label' => 'Présentation',
                'required' => false,
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
                'invalid_message' => 'fos_user.password.mismatch',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank(
                        message: 'Please enter a password',
                    ),
                    new Length(
                        min: 6,
                        minMessage: 'Your password should be at least {{ limit }} characters',
                        max: 4096,
                    ),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'En créant votre compte vous acceptez les Conditions Générales de vente du site.*',
                'constraints' => [
                    new IsTrue(
                        message: 'En créant votre compte vous acceptez les Conditions Générales de vente du site. *',
                    ),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
