<?php

namespace App\Form;

use App\Entity\Species;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpeciesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('genus', TextType::class, [
                'required' => !$options['embed'],
            ])
            ->add('species', TextType::class, [
                'required' => !$options['embed'],
            ])
            ->add('variety', TextType::class, [
                'required' => !$options['embed'],
            ]);

        if (!$options['embed']) {
            $builder->add('save', SubmitType::class, [
                'label' => 'Create species',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Species::class,
            'embed'      => false,
        ]);
    }
}
