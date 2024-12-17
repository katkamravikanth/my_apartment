<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use App\Entity\Employee;
use App\Entity\MemberType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EmployeeFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Create an Employee user
        $employee = new Employee();
        $employee->setName('Employee A');
        $employee->setContact('+919123456789');
        $employee->setEmail('employee@example.com');
        $employee->setBranch($this->getReference("branch1"));

        $hashedPassword = $this->passwordHasher->hashPassword($employee, 'employee123');
        $employee->setPassword($hashedPassword);

        $employee->setPresentAddress('123 Main St, City A');
        $employee->setPermanentAddress('123 Main St, City A');
        $employee->setDesignation($this->getReference("memberType1"));
        $employee->setJoiningDate(new \DateTime('now'));
        $employee->setStatus(1);
        $employee->setSalary(10000.00);

        // Persist the employee to the database
        $manager->persist($employee);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BranchFixtures::class,
            AdminFixtures::class,
            MemberTypeFixtures::class
        ];
    }
}
