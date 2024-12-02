<?php

namespace App\Form;

use App\Entity\Cartes;
use App\Entity\Projets;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idUser')
            ->add('roles')
            ->add('password')
            ->add('cartes', EntityType::class, [
                'class' => Cartes::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('projets', EntityType::class, [
                'class' => Projets::class,
                'choice_label' => 'id',
                'multiple' => true,
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
