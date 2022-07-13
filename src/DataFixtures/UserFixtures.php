<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');

        $password = $this->hasher->hashPassword($user, 'pass_1234');
        $user->setPassword($password)
            ->setFirstname('nicolas')
            ->setLastname('vauche')
            ->setRoles(["ROLE_ADMIN"])
            ->setEmail('nicolas@orgaapp.fr');
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setUsername('alexis');

        $password = $this->hasher->hashPassword($user, 'qwerty');
        $user->setPassword($password)
            ->setFirstname('test')
            ->setLastname('test')
            ->setRoles(["ROLE_USER"])
            ->setEmail('test@orgaapp.fr');
        $manager->persist($user);
        $manager->flush();
    }
}
