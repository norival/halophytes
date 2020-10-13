<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpeciesFeatureController extends AbstractController
{
    /**
     * @Route("/species/feature", name="species_feature")
     */
    public function index()
    {
        return $this->render('species_feature/index.html.twig', [
            'controller_name' => 'SpeciesFeatureController',
        ]);
    }
}
