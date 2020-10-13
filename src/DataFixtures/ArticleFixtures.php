<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public const ARTICLE_1_REFERENCE = 'article-1';
    public const ARTICLE_2_REFERENCE = 'article-2';

    public function load(ObjectManager $manager)
    {
        /** @var \App\Entity\User Regerence to the dummy user */
        $userUser = $this->getReference(UserFixtures::USER_USER_REFERENCE);

        // Dummy article 1 *****************************************************
        $article = new Article();

        $article->setUrl('https://www.sciencedirect.com/science/article/abs/pii/S0378112719316421');
        $article->setTitle('This is my spot: What are the characteristics of
            the trees excavated by the Black Woodpecker? A case study in two
            managed French forests');
        $article->setAbstract("The Black Woodpecker (Dryocopus martius L.) is
            both an ecosystem engineer and an umbrella species: it has the
            capacity to modify its environment through cavity excavation, which
            in turn favors a large range of species that depend on cavities but
            are unable to dig them themselves (secondary cavity nesters).
            However, the factors driving cavity excavation by the Black
            woodpecker at the tree scale remain poorly known. We analyzed the
            characteristics of trees bearing Black Woodpecker cavities to
            assess the bird's local habitat requirements and their conservation
            potential as habitat trees. We compared the traits and
            characteristics of trees bearing Black Woodpecker cavities (n = 60)
            and control trees (n = 56) in two managed lowland
            broadleave-dominated forests in France. We hypothesized that:");

        $article->setUser($userUser);
        $article->setCreatedAt(\date_create());

        $manager->persist($article);
        $this->addReference(self::ARTICLE_1_REFERENCE, $article);

        // Dummy article 2 *****************************************************
        $article = new Article();

        $article->setUrl('https://journals.sagepub.com/doi/abs/10.1366/12-06870');
        $article->setTitle('Spectroscopic Characterization of Urea Aqueous
            Solutions: Experimental Phase Diagram of the Urea–Water Binary
            System');
        $article->setAbstract("Raman spectroscopy was used to analyze mixtures
            of urea and water in order to identify the influence of the urea
            concentration on the solution's freezing point. Our approach
            consisted in the analysis of urea aqueous solutions and the
            determination of their phase transitions at low temperatures.
            Hence, Raman spectra of these solutions were acquired in a −30 to
            10 °C temperature range. This enabled us to build the experimental
            phase diagram of the urea–water binary system.");
        $article->setUser($userUser);
        $article->setCreatedAt(\date_create());

        $manager->persist($article);
        $this->addReference(self::ARTICLE_2_REFERENCE, $article);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
