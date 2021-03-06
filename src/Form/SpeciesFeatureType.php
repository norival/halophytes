<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Feature;
use App\Entity\Species;
use App\Entity\SpeciesFeature;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpeciesFeatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* dump($options['data']); */
        $builder
            ->add('species', EntityType::class, [
                'class'    => Species::class,
                'required' => false,
                'attr'     => [
                    'hidden' => true,
                ]
            ])
            ->add('search_species', SearchType::class, [
                'mapped'   => false,
                'label'    => 'Species',
                'required' => false,
            ])
            ->add('feature', EntityType::class, [
                'class'    => Feature::class,
                'required' => false,
                'attr'     => [
                    'hidden' => true,
                ]
            ])
            ->add('search_feature', SearchType::class, [
                'mapped'   => false,
                'label'    => 'Feature',
                'required' => false,
            ])
            ->add('value', TextType::class, [
                'label' => 'Feature value',
            ])
            ->add('range_value', CheckboxType::class, [
                'label'    => 'Specify range?',
                'required' => false,
            ])
            ->add('value_min', NumberType::class, [
                'label'    => 'Feature min value',
            ])
            ->add('value_max', NumberType::class, [
                'label'    => 'Feature max value',
            ])
            ->add('article', EntityType::class, [
                'class'        => Article::class,
                'placeholder'  => 'New article',
                'empty_data'   => 'new',
                'required'     => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save'
            ])
            ->add('save_continue', SubmitType::class, [
                'label' => 'Save and add another entry'
            ])
            ->add('new_species', SpeciesType::class, [
                'mapped'   => false,
                'embed'    => true,
                'required' => false,
            ])
            ->add('new_feature', FeatureType::class, [
                'mapped'   => false,
                'embed'    => true,
                'required' => false,
            ])
            ->add('new_article', ArticleType::class, [
                'mapped'   => false,
                'embed'    => true,
                'required' => false,
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            if (!$data['article']) {
                // remove article form
                $form->remove('article');
            }

            if (!$data['feature']) {
                // remove feature form
                $form->remove('feature');
            }

            if (!$data['species']) {
                // remove species form
                $form->remove('species');
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SpeciesFeature::class,
            'allow_extra_fields' => true,
        ]);
    }
}
