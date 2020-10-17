<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => !$options['embed'],
            ])
            ->add('url', UrlType::class, [
                'required' => !$options['embed'],
            ])
            ->add('abstract', TextareaType::class, [
                'required' => !$options['embed'],
            ])
            ->add('first_author_last_name', TextType::class, [
                'required' => !$options['embed'],
            ])
            ->add('year', TextType::class, [
                'required' => !$options['embed'],
            ]);

        if (!$options['embed']) {
            $builder->add('save', SubmitType::class, [
                'label' => 'Create article',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'embed'      => false,
        ]);
    }
}
