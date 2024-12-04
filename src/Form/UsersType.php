<?php

namespace App\Form;

use App\Entity\Cartes;
use App\Entity\Projets;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('mdp')
            ->add('image')
            ->add('service')
            ->add('poste')
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
            'data_class' => Users::class,
        ]);
    }
}
