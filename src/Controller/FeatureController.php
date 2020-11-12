<?php

namespace App\Controller;

use App\Entity\Feature;
use App\Form\FeatureType;
use App\Repository\FeatureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FeatureController extends AbstractController
{
    private EntityManagerInterface $em;
    private FeatureRepository $featureRepo;

    public function __construct(
        EntityManagerInterface $em,
        FeatureRepository $featureRepo
    ) {
        $this->em          = $em;
        $this->featureRepo = $featureRepo;
    }

    /**
     * @Route("/feature", name="feature_list")
     */
    public function list()
    {
        $features = $this->featureRepo->findAll();

        return $this->render('feature/list.html.twig', [
            'features' => $features,
        ]);
    }

    /**
     * @Route("/feature/add", name="feature_add")
     * @IsGranted("ROLE_CONTRIBUTOR")
     */
    public function add(Request $request)
    {
        $feature = new Feature();
        $form = $this->createForm(FeatureType::class, $feature);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feature->setUser($this->getUser());
            $feature->setCreatedAt(\date_create());

            $this->em->persist($feature);
            $this->em->flush();

            $this->addFlash('success', 'New feature added');
            return $this->redirectToRoute('feature_list');
        }

        return $this->render('feature/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/feature/search", name="feature_search_api")
     */
    public function ajaxSearch(Request $request, SerializerInterface $serializer)
    {
        $features = $this->featureRepo->findByName($request->get('q'));

        return $this->json([
            'results' => $this->featureRepo->findByName($request->get('q')),
        ], 200, [], ['groups' => 'search']);
    }
}
