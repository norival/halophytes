<?php

namespace App\DataFixtures;

use App\Entity\Feature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FeatureFixtures extends Fixture implements DependentFixtureInterface
{
    public const FEATURE_1_REFERENCE = 'feature-1';
    public const FEATURE_2_REFERENCE = 'feature-2';
    public const FEATURE_3_REFERENCE = 'feature-3';
    public const FEATURE_4_REFERENCE = 'feature-4';

    public function load(ObjectManager $manager)
    {
        /** @var \App\Entity\User Regerence to the dummy user */
        $userUser = $this->getReference(UserFixtures::USER_USER_REFERENCE);

        // Dummy feature 1 *****************************************************
        $feature = new Feature();
        $feature->setName('Na absorption');
        $feature->setUnit('mg/g');
        $feature->setDataType('quantitative');
        $feature->setDescription('The capacity of the plant to absorb Na in soil');
        $feature->setCreatedAt(\date_create());
        $feature->setUser($userUser);

        $this->addReference(self::FEATURE_1_REFERENCE, $feature);
        $manager->persist($feature);

        // Dummy feature 2 *****************************************************
        $feature = new Feature();
        $feature->setName('Cl absorption');
        $feature->setUnit('mg/g');
        $feature->setDataType('quantitative');
        $feature->setDescription('The capacity of the plant to absorb Cl in soil');
        $feature->setCreatedAt(\date_create());
        $feature->setUser($userUser);

        $this->addReference(self::FEATURE_2_REFERENCE, $feature);
        $manager->persist($feature);

        // Dummy feature 3 *****************************************************
        $feature = new Feature();
        $feature->setName('Food usage');
        $feature->setDataType('qualitative');
        $feature->setDescription('Can the plant be used as food?');
        $feature->setCreatedAt(\date_create());
        $feature->setUser($userUser);

        $this->addReference(self::FEATURE_3_REFERENCE, $feature);
        $manager->persist($feature);

        // Dummy feature 4 *****************************************************
        $feature = new Feature();
        $feature->setName('Fodder usage');
        $feature->setDataType('qualitative');
        $feature->setDescription('Can the plant be used as fodder?');
        $feature->setCreatedAt(\date_create());
        $feature->setUser($userUser);

        $this->addReference(self::FEATURE_4_REFERENCE, $feature);
        $manager->persist($feature);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
