<?php

namespace App\Form;

use App\Repository\FeatureRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChooseSpeciesType extends AbstractType
{
    private $repo;

    public function __construct(FeatureRepository $repo)
    {
        $this->repo = $repo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var \App\Entity\Feature[] $features */
        $features = $this->repo->findAll();

        foreach ($features as $feature) {
            $builder->add(
                preg_replace('/ /', '_', $feature->getName()),
                TextType::class,
            );
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
