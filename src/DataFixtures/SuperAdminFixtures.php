<?php

namespace App\DataFixtures;

use App\Entity\SuperAdmin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SuperAdminFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Create a Super Admin user
        $superAdmin = new SuperAdmin();
        $superAdmin->setName('Super Admin');
        $superAdmin->setContact('+919123456789');
        $superAdmin->setEmail('superadmin@example.com');
        $superAdmin->setRoles(['ROLE_SUPER_ADMIN']);

        $hashedPassword = $this->passwordHasher->hashPassword($superAdmin, 'superadmin123');
        $superAdmin->setPassword($hashedPassword);

        // Persist the super admin to the database
        $manager->persist($superAdmin);
        $manager->flush();
    }
}
