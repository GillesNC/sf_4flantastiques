<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlanFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFlanUpload', FileType::class, [
                'label' => 'Télécharger les photos de flan',
                'attr' => [
                    'class' => 'form-input',
                ],
                'mapped' => false,
                'required' => false,
            ])

            ->add('flanName', TextType::class, [
                'label' => 'Nom du flan*',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple : Flan pâtissier',
                ],
                'required' => true,
            ])

            ->add('flanBio', TextareaType::class, [
                'label' => 'Présentation du flan',
                'attr' => [
                    'class' => 'form-input-bio',
                    'placeholder' => 'Ma description du flan',
                ],
                'required' => false,
            ])

            ->add('imageSpotUpload', FileType::class, [
                'label' => 'Télécharger une photo l’enseigne',
                'attr' => [
                    'class' => 'form-input',
                ],
                'mapped' => false,
                'required' => false,
            ])

            ->add('spotName', TextType::class, [
                'label' => 'Nom de l\'enseigne*',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple : La pâtisserie de mon quartier',
                ],
                'required' => true,
            ])

            ->add('adress', TextType::class, [
                'label' => 'Adresse de l\'enseigne*',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple : 123 rue de la pâtisserie',
                ],
                'required' => true,
            ])

            ->add('codePostal', TextType::class, [
                'label' => 'Code postal de l\'enseigne*',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple : 75000',
                ],
                'required' => true,
            ])

            ->add('ville', TextType::class, [
                'label' => 'Ville de l\'enseigne*',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple : Paris',
                ],
                'required' => true,
            ])

            ->add('site', TextType::class, [
                'label' => 'Site internet de l\'enseigne',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple : https://www.lapatisseriedemonquartier.fr',
                ],
                'required' => false,
            ])

            ->add('spotBio', TextType::class, [
                'label' => 'Présentation de l\'enseigne',
                'attr' => [
                    'class' => 'form-input-bio',
                    'placeholder' => 'Ma description de l\'enseigne',
                ],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
