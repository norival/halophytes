<?php

namespace App\Controller;

use App\Entity\SpeciesFeature;
use App\Entity\State;
use App\Form\ChooseSpeciesType;
use App\Form\SpeciesFeatureType;
use App\Repository\FeatureRepository;
use App\Repository\SpeciesFeatureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SpeciesFeatureController extends AbstractController
{
    private $em;
    private $featureRepo;
    private $sfRepo;

    public function __construct(
        EntityManagerInterface $em,
        FeatureRepository $featureRepo,
        SpeciesFeatureRepository $sfRepo
    ) {
        $this->em          = $em;
        $this->featureRepo = $featureRepo;
        $this->sfRepo      = $sfRepo;
    }

    /**
     * @Route("/speciesFeature/{id}", name="sf_show", requirements={"id"="\d+"})
     */
    public function show(string $id)
    {
        /** @var \App\Entity\SpeciesFeature $sf */
        $sf = $this->sfRepo->find($id);
        /* $sfs = $this->sfRepo->findAll(); */

        return $this->render('species_feature/index.html.twig', [
            /* 'sfs' => $sfs, */
        ]);
    }

    /**
     * @Route("/speciesFeature", name="sf_list")
     */
    public function list()
    {
        /** @var \App\Entity\SpeciesFeature[] $sfs */
        $sfs = $this->sfRepo->findAll();

        return $this->render('species_feature/list.html.twig', [
            'sfs' => $sfs,
        ]);
    }

    /**
     * @Route("/speciesFeature/choose", name="sf_choose")
     */
    public function choice()
    {
        $form = $this->createForm(ChooseSpeciesType::class);

        return $this->render('species_feature/choose.html.twig', [
            'form' => $form->createView(),
            /* 'features' => $features, */
        ]);
    }

    /**
     * @Route("/speciesFeature/add", name="sf_add")
     * @IsGranted("ROLE_CONTRIBUTOR")
     */
    public function add(Request $request)
    {
        $speciesFeature = new SpeciesFeature();
        $form = $this->createForm(SpeciesFeatureType::class, $speciesFeature);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();

            if (!$speciesFeature->getArticle()) {
                /** @var \App\Entity\Article $article */
                $article = $form->get('new_article')->getData();
                $article->setUser($user);
                $article->setCreatedAt(\date_create());
                $this->em->persist($article);
                $speciesFeature->setArticle($article);
            }

            if (!$speciesFeature->getFeature()) {
                /** @var \App\Entity\Feature $feature */
                $feature = $form->get('new_feature')->getData();
                $feature->setUser($user);
                $feature->setCreatedAt(\date_create());
                $this->em->persist($feature);
                $speciesFeature->setFeature($feature);
            }

            if (!$speciesFeature->getSpecies()) {
                /** @var \App\Entity\Species $species */
                $species = $form->get('new_species')->getData();
                $species->setUser($user);
                $species->setCreatedAt(\date_create());
                $this->em->persist($species);
                $speciesFeature->setSpecies($species);
            }

            $speciesFeature->setCreatedAt(\date_create());
            $speciesFeature->setUser($user);

            $speciesFeature->setState(SpeciesFeature::STATE_NEEDS_REVIEW);

            $this->em->persist($speciesFeature);

            $this->em->flush();

            return $this->redirectToRoute('sf_add_success');
        }

        return $this->render('species_feature/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/speciesFeature/add_success", name="sf_add_success")
     * @IsGranted("ROLE_CONTRIBUTOR")
     */
    public function addSuccess()
    {

        return $this->render('species_feature/add_success.html.twig', [
        ]);
    }
}
