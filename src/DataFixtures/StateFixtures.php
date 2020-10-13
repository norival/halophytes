<?php

namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public const STATE_ACCEPTED = 'state-accepted';
    public const STATE_REVIEW = 'state-review';

    public function load(ObjectManager $manager)
    {
        $state = new State();

        // Dummy state 1 *******************************************************
        $state = new State();
        $state->setName('Accepted');
        $state->setDescription('The data is accepted');

        $manager->persist($state);
        $this->addReference(self::STATE_ACCEPTED, $state);

        // Dummy state 2 *******************************************************
        $state = new State();
        $state->setName('Needs review');
        $state->setDescription('The data needs review');

        $manager->persist($state);
        $this->addReference(self::STATE_REVIEW, $state);

        $manager->flush();
    }
}
