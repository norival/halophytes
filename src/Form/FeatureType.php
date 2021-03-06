<?php

namespace App\Form;

use App\Entity\Feature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
            ])
            ->add('data_type', ChoiceType::class, [
                'choices' => Feature::DATA_TYPES,
            ])
            ->add('unit', TextType::class, [
            ])
            ->add('description', TextType::class, [
            ]);

        if (!$options['embed']) {
            $builder->add('save', SubmitType::class, [
                'label' => 'Create feature',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Feature::class,
            'embed'      => false,
        ]);
    }
}
