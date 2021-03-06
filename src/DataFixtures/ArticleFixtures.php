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
        $article->setUser($userUser);

        $manager->persist($article);
        $this->addReference(self::ARTICLE_1_REFERENCE, $article);

        // Dummy article 2 *****************************************************
        $article = new Article();

        $article->setUrl('https://journals.sagepub.com/doi/abs/10.1366/12-06870');
        $article->setTitle('Spectroscopic Characterization of Urea Aqueous
            Solutions: Experimental Phase Diagram of the Urea–Water Binary
            System');
        $article->setUser($userUser);

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
