<?php

namespace App\DataFixtures;

use App\Entity\Species;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SpeciesFixtures extends Fixture implements DependentFixtureInterface
{
    public const SPECIES_1_REFERENCE = 'species-1';
    public const SPECIES_2_REFERENCE = 'species-2';

    public function load(ObjectManager $manager)
    {
        /** @var \App\Entity\User Regerence to the dummy user */
        $userUser = $this->getReference(UserFixtures::USER_USER_REFERENCE);

        // Dummy species 1 *****************************************************
        $species = new Species();
        $species->setCommonName('The awesome species');
        $species->setScientificName('Awesomus_species');
        $species->setCreatedAt(\date_create());
        $species->setUser($userUser);

        $manager->persist($species);
        $this->addReference(self::SPECIES_1_REFERENCE, $species);

        // Dummy species 2 *****************************************************
        $species = new Species();
        $species->setCommonName('The best species');
        $species->setScientificName('Bestus_bestus');
        $species->setCreatedAt(\date_create());
        $species->setUser($userUser);

        $manager->persist($species);
        $this->addReference(self::SPECIES_2_REFERENCE, $species);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
