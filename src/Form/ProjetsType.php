<?php

namespace App\Form;

use App\Entity\Projets;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('date_creation', null, [
                'widget' => 'single_text',
            ])
            ->add('date_fin_prevu', null, [
                'widget' => 'single_text',
            ])
            ->add('cloture')
            ->add('description')
            ->add('image')
            ->add('users', EntityType::class, [
                'class' => Users::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projets::class,
        ]);
    }
}
