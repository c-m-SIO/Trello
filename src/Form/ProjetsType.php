<?php

namespace App\Form;

use App\Entity\Projets;
use App\Repository\ProjetsRepository;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjetsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md'
                ],
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer',
                'attr' => [
                    'id' => 'submit-button',
                    'class' => 'px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projets::class,
            'method' => 'POST',
            'attr' => [
                'id' => 'projectForm',
                 'onsubmit' => 'addProject(event)',
            ],
        ]);
    }
}
