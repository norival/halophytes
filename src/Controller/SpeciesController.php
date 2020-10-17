<?php

namespace App\Controller;

use App\Entity\Species;
use App\Form\SpeciesType;
use App\Repository\SpeciesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SpeciesController extends AbstractController
{
    private $em;
    private $speciesRepo;

    public function __construct(
        EntityManagerInterface $em,
        SpeciesRepository $speciesRepo
    ) {
        $this->em          = $em;
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

    /**
     * @Route("/species/add", name="species_add")
     * @IsGranted("ROLE_CONTRIBUTOR")
     */
    public function add(Request $request)
    {
        $species = new Species();
        $form = $this->createForm(SpeciesType::class, $species);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $species->setUser($this->getUser());
            $species->setCreatedAt(\date_create());

            $this->em->persist($species);
            $this->em->flush();

            $this->addFlash('success', 'New species added');
            return $this->redirectToRoute('species_list');
        }

        return $this->render('species/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
