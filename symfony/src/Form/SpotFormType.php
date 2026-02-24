<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Spot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SpotFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('photo', FileType::class, [
                'label' => 'Télécharger une photo l’enseigne',
                'attr' => [
                    'class' => 'form-input',
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Assert\File(
                        maxSize: '1M',
                        mimeTypesMessage: 'Veuillez télécharger une image valide (JPEG, PNG, GIF, WEBP) de moins de 1 Mo.',
                        extensions: ['jpg', 'jpeg', 'png', 'webp', 'gif'],
                    ),
                ],
            ])

            ->add('name', TextType::class, [
                'label' => 'Nom de l\'enseigne*',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple : La pâtisserie de mon quartier',
                ],
                'required' => true,
            ])

            ->add('address', TextType::class, [
                'label' => 'Adresse de l\'enseigne*',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple : 123 rue de la pâtisserie',
                ],
                'required' => true,
            ])

            ->add('postalCode', TextType::class, [
                'label' => 'Code postal de l\'enseigne*',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple : 75000',
                ],
                'required' => true,
            ])

            ->add('city', EntityType::class, [
                'class' => City::class,
                'choice_label' => 'name',
                'label' => 'Ville de l\'enseigne*',
                'attr' => [
                    'class' => 'form-input',
                ],
            ])

            ->add('website', TextType::class, [
                'label' => 'Site internet de l\'enseigne',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple : https://www.lapatisseriedemonquartier.fr',
                ],
                'required' => false,
            ])

            ->add('bio', TextareaType::class, [
                'label' => 'Présentation de l\'enseigne',
                'attr' => [
                    'class' => 'form-input-bio',
                    'placeholder' => 'Ma description de l\'enseigne',
                ],
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Spot::class,
        ]);
    }
}
