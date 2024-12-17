<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BranchFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Example data for the Branch entity
        $branch1 = new Branch();
        $branch1->setName('Community A');
        $branch1->setEmail('community.a@example.com');
        $branch1->setAddress('123 Main St, City A');
        $branch1->setContactNo('123-456-7890');
        $branch1->setStatus(1);

        $branch2 = new Branch();
        $branch2->setName('Community B');
        $branch2->setEmail('community.b@example.com');
        $branch2->setAddress('456 Oak Ave, City B');
        $branch2->setContactNo('098-765-4321');
        $branch2->setStatus(1);
        // Set other fields as necessary

        // Persist the branches to the database
        $manager->persist($branch1);
        $manager->persist($branch2);

        $this->addReference("branch1", $branch1);
        $this->addReference("branch2", $branch2);

        // Save all changes
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SuperAdminFixtures::class, // Admin fixtures must be loaded first
        ];
    }
}
