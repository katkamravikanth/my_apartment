<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use App\Entity\Tenant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TenantFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Create an Tenant user
        $tenant = new Tenant();
        $tenant->setName('Tenant A');
        $tenant->setContact('+919123456789');
        $tenant->setEmail('tenant@example.com');
        $tenant->setBranch($this->getReference("branch1"));

        $hashedPassword = $this->passwordHasher->hashPassword($tenant, 'tenant123');
        $tenant->setPassword($hashedPassword);

        $tenant->setAddress('123 Main St, City A');
        $tenant->setFloorNo('12');
        $tenant->setUnitNo('30');
        $tenant->setAdvanceRent(10000.00);
        $tenant->setRentPerMonth(10000.00);
        $tenant->setIssueDate(New \DateTime('now'));
        $tenant->setStatus(1);
        $tenant->setMonth(3);
        $tenant->setYear(2024);

        // Persist the tenant to the database
        $manager->persist($tenant);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BranchFixtures::class,
            AdminFixtures::class,
            OwnerFixtures::class,
        ];
    }
}
