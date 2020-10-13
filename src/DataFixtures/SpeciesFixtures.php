<?php

namespace App\DataFixtures;

use App\Entity\Species;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpeciesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var \App\Entity\User Regerence to the dummy user */
        $userUser = $this->getReference(UserFixtures::USER_USER_REFERENCE);

        // Dummy species 1 *****************************************************
        $species = new Species();
        $species->setCommonName('The awesome species');
        $species->setScientificName('Awesomus_species');
        $species->setCreatedAt(\date_create());
        $species->setUserId($user);

        $manager->persist($species);

        // Dummy species 2 *****************************************************
        $species = new Species();
        $species->setCommonName('The best species');
        $species->setScientificName('Bestus_bestus');
        $species->setCreatedAt(\date_create());
        $species->setUserId($user);

        $manager->persist($species);

        $manager->flush();
    }
}
