<?php

namespace App\DataFixtures;

use App\Entity\SpeciesFeature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SpeciesFeatureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var \App\Entity\Species $species1 */
        $species1 = $this->getReference(SpeciesFixtures::SPECIES_1_REFERENCE);
        /** @var \App\Entity\Species $species2 */
        $species2 = $this->getReference(SpeciesFixtures::SPECIES_2_REFERENCE);

        /** @var \App\Entity\Feature $feature1 */
        $feature1 = $this->getReference(FeatureFixtures::FEATURE_1_REFERENCE);
        /** @var \App\Entity\Feature $feature2 */
        $feature2 = $this->getReference(FeatureFixtures::FEATURE_2_REFERENCE);
        /** @var \App\Entity\Feature $feature3 */
        $feature3 = $this->getReference(FeatureFixtures::FEATURE_3_REFERENCE);
        /** @var \App\Entity\Feature $feature4 */
        $feature4 = $this->getReference(FeatureFixtures::FEATURE_4_REFERENCE);

        /** @var \App\Entity\Article $article1 */
        $article1 = $this->getReference(ArticleFixtures::ARTICLE_1_REFERENCE);
        /** @var \App\Entity\Article $article2 */
        $article2 = $this->getReference(ArticleFixtures::ARTICLE_2_REFERENCE);

        /** @var \App\Entity\User $user */
        $user = $this->getReference(UserFixtures::USER_USER_REFERENCE);

        // Dummy speciesFeature 1 **********************************************
        $speciesFeature = new SpeciesFeature();
        $speciesFeature->setValue('12');
        $speciesFeature->setSpecies($species1);
        $speciesFeature->setFeature($feature1);
        $speciesFeature->setState(SpeciesFeature::STATE_PUBLISHED);
        $speciesFeature->setArticle($article1);
        $speciesFeature->setUser($user);
        $speciesFeature->setCreatedAt(\date_create());

        $manager->persist($speciesFeature);

        // Dummy speciesFeature 2 **********************************************
        $speciesFeature = new SpeciesFeature();
        $speciesFeature->setValue('24');
        $speciesFeature->setSpecies($species2);
        $speciesFeature->setFeature($feature1);
        $speciesFeature->setState(SpeciesFeature::STATE_PUBLISHED);
        $speciesFeature->setArticle($article1);
        $speciesFeature->setUser($user);
        $speciesFeature->setCreatedAt(\date_create());

        $manager->persist($speciesFeature);

        // Dummy speciesFeature 3 **********************************************
        $speciesFeature = new SpeciesFeature();
        $speciesFeature->setValue('24');
        $speciesFeature->setSpecies($species1);
        $speciesFeature->setFeature($feature1);
        $speciesFeature->setState(SpeciesFeature::STATE_PUBLISHED);
        $speciesFeature->setArticle($article2);
        $speciesFeature->setUser($user);
        $speciesFeature->setCreatedAt(\date_create());

        $manager->persist($speciesFeature);

        // Dummy speciesFeature 4 **********************************************
        $speciesFeature = new SpeciesFeature();
        $speciesFeature->setValue('true');
        $speciesFeature->setSpecies($species1);
        $speciesFeature->setFeature($feature3);
        $speciesFeature->setState(SpeciesFeature::STATE_PUBLISHED);
        $speciesFeature->setArticle($article1);
        $speciesFeature->setUser($user);
        $speciesFeature->setCreatedAt(\date_create());

        $manager->persist($speciesFeature);

        // Dummy speciesFeature 5 **********************************************
        $speciesFeature = new SpeciesFeature();
        $speciesFeature->setValue('false');
        $speciesFeature->setSpecies($species1);
        $speciesFeature->setFeature($feature4);
        $speciesFeature->setState(SpeciesFeature::STATE_PUBLISHED);
        $speciesFeature->setArticle($article1);
        $speciesFeature->setUser($user);
        $speciesFeature->setCreatedAt(\date_create());

        $manager->persist($speciesFeature);

        // Dummy speciesFeature 6 **********************************************
        $speciesFeature = new SpeciesFeature();
        $speciesFeature->setValue('12');
        $speciesFeature->setSpecies($species2);
        $speciesFeature->setFeature($feature2);
        $speciesFeature->setState(SpeciesFeature::STATE_PUBLISHED);
        $speciesFeature->setArticle($article2);
        $speciesFeature->setUser($user);
        $speciesFeature->setCreatedAt(\date_create());

        $manager->persist($speciesFeature);

        // Dummy speciesFeature 7 **********************************************
        $speciesFeature = new SpeciesFeature();
        $speciesFeature->setValue('16');
        $speciesFeature->setSpecies($species2);
        $speciesFeature->setFeature($feature3);
        $speciesFeature->setState(SpeciesFeature::STATE_NEEDS_REVIEW);
        $speciesFeature->setArticle($article1);
        $speciesFeature->setUser($user);
        $speciesFeature->setCreatedAt(\date_create());

        $manager->persist($speciesFeature);

        // Dummy speciesFeature 8 **********************************************
        $speciesFeature = new SpeciesFeature();
        $speciesFeature->setValue('true');
        $speciesFeature->setSpecies($species1);
        $speciesFeature->setFeature($feature4);
        $speciesFeature->setState(SpeciesFeature::STATE_NEEDS_REVIEW);
        $speciesFeature->setArticle($article1);
        $speciesFeature->setUser($user);
        $speciesFeature->setCreatedAt(\date_create());

        $manager->persist($speciesFeature);

        // Dummy speciesFeature 9 **********************************************
        $speciesFeature = new SpeciesFeature();
        $speciesFeature->setValue('false');
        $speciesFeature->setSpecies($species1);
        $speciesFeature->setFeature($feature4);
        $speciesFeature->setState(SpeciesFeature::STATE_REJECTED);
        $speciesFeature->setArticle($article2);
        $speciesFeature->setUser($user);
        $speciesFeature->setCreatedAt(\date_create());

        $manager->persist($speciesFeature);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ArticleFixtures::class,
            FeatureFixtures::class,
            SpeciesFixtures::class,
            UserFixtures::class,
        );
    }
}
