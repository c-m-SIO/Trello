<?php

namespace App\Form;

use App\Entity\Cartes;
use App\Entity\Colonnes;
use App\Entity\Tags;
use App\Entity\users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('date_creation', null, [
                'widget' => 'single_text',
            ])
            ->add('date_fin', null, [
                'widget' => 'single_text',
            ])
            ->add('date_fin_prevu', null, [
                'widget' => 'single_text',
            ])
            ->add('cloture')
            ->add('fichier')
            ->add('description')
            ->add('users', EntityType::class, [
                'class' => users::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('tags', EntityType::class, [
                'class' => Tags::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('colonnes', EntityType::class, [
                'class' => Colonnes::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cartes::class,
        ]);
    }
}
