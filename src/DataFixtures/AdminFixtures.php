<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Branch;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Create an Admin user
        $admin = new Admin();
        $admin->setName('Admin');
        $admin->setContact('+919123456789');
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setBranch($this->getReference("branch1"));

        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'admin123');
        $admin->setPassword($hashedPassword);

        // Persist the admin to the database
        $manager->persist($admin);

        $this->addReference("admin", $admin);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SuperAdminFixtures::class,
            BranchFixtures::class,
        ];
    }
}
