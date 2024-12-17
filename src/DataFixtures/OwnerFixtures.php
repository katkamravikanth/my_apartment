<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use App\Entity\Owner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class OwnerFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Create an Owner user
        $owner = new Owner();
        $owner->setName('Owner A');
        $owner->setContact('+919123456789');
        $owner->setEmail('owner@example.com');
        $owner->setBranch($this->getReference("branch1"));

        $hashedPassword = $this->passwordHasher->hashPassword($owner, 'owner123');
        $owner->setPassword($hashedPassword);

        $owner->setPresentAddress('123 Main St, City A');
        $owner->setPermanentAddress('123 Main St, City A');

        // Persist the owner to the database
        $manager->persist($owner);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BranchFixtures::class,
            AdminFixtures::class,
        ];
    }
}
