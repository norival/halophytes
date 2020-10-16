<?php

namespace App\Controller;

use App\Repository\SpeciesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpeciesController extends AbstractController
{
    private $em;
    private $speciesRepo;

    public function __construct(
        EntityManagerInterface $em,
        SpeciesRepository $speciesRepo
    ) {
        $this->em         = $em;
        $this->speciesRepo = $speciesRepo;
    }

    /**
     * @Route("/species", name="species_list")
     */
    public function list()
    {
        $species = $this->speciesRepo->findAll();

        return $this->render('species/list.html.twig', [
            'species' => $species,
        ]);
    }
}
