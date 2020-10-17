<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const USER_ADMIN_REFERENCE = 'user-admin';
    public const USER_USER_REFERENCE = 'user-user';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setEmail('admin@test.com');
        $user->setFirstname('Firstadmin');
        $user->setLastname('Lastadmin');
        $user->setOrcid('0000-0002-9882-3253');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_CONTRIBUTOR']);
        $user->setCreatedAt(\date_create());

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'password'
        ));

        $manager->persist($user);

        $this->addReference(self::USER_ADMIN_REFERENCE, $user);

        $user = new User();
        $user->setEmail('user@test.com');
        $user->setFirstname('Firstuser');
        $user->setLastname('Lastuser');
        $user->setOrcid('0000-0002-9882-3253');
        $user->setRoles(['ROLE_CONTRIBUTOR']);
        $user->setCreatedAt(\date_create());

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'password'
        ));

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER_USER_REFERENCE, $user);
    }
}
