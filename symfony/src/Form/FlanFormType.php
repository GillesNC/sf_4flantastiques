<?php

namespace App\Form;

use App\Entity\Flan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class FlanFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('photo', FileType::class, [
                'label' => 'Télécharger les photos de flan',
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
                'label' => 'Nom du flan*',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple : Flan pâtissier',
                ],
                'required' => true,
            ])

            ->add('bio', TextareaType::class, [
                'label' => 'Présentation du flan',
                'attr' => [
                    'class' => 'form-input-bio',
                    'placeholder' => 'Ma description du flan',
                ],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => flan::class,
        ]);
    }
}
