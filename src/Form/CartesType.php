<?php

namespace App\Form;

use App\Entity\Cartes;
use App\Entity\Colonnes;
use App\Entity\Tags;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CartesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md'
                ],
            ])
            ->add('date_creation', null, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                ]
            ])
            ->add('date_fin_prevu', null, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                ]
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md'
                ]
            ])
            // ->add('users', EntityType::class, [
            //     'class' => Users::class,
            //     'choice_label' => 'prenom',
            //     'multiple' => true,
            // ])
            // ->add('tags', EntityType::class, [
            //     'class' => Tags::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            ->add('colonnes', EntityType::class, [
                'class' => Colonnes::class,
                'choice_label' => 'titre',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer cartes',
                'attr' => [
                    'id' => 'submit-button',
                    'class' => 'px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cartes::class,
            'method' => 'POST',
            'attr' => [
                'id' => 'taskForm',
            ],
        ]);
    }
}
