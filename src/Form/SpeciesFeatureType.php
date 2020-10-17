<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Feature;
use App\Entity\Species;
use App\Entity\SpeciesFeature;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                'class'       => Species::class,
                'placeholder' => 'New species',
                'empty_data'  => 'new',
                'required'    => false,
            ])
            ->add('feature', EntityType::class, [
                'class'       => Feature::class,
                'placeholder' => 'New feature',
                'empty_data'  => 'new',
                'required'    => false,
            ])
            ->add('value', TextType::class, [
                'label' => 'Feature value',
            ])
            ->add('article', EntityType::class, [
                'class'        => Article::class,
                'placeholder'  => 'New article',
                'empty_data'   => 'new',
                'required'     => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create species feature'
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
