<?php

namespace App\DataFixtures;


use App\Entity\MemberType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MemberTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create an Owner user
        $memberType_1 = new MemberType();
        $memberType_1->setMemberType('Moderator');
        $manager->persist($memberType_1);

        $memberType_2 = new MemberType();
        $memberType_2->setMemberType('Secretary General');
        $manager->persist($memberType_2);

        $memberType_3 = new MemberType();
        $memberType_3->setMemberType('Member');
        $manager->persist($memberType_3);

        $memberType_4 = new MemberType();
        $memberType_4->setMemberType('Pion');
        $manager->persist($memberType_4);

        $memberType_5 = new MemberType();
        $memberType_5->setMemberType('Security Gard');
        $manager->persist($memberType_5);

        $memberType_6 = new MemberType();
        $memberType_6->setMemberType('Caretaker');
        $manager->persist($memberType_6);

        $memberType_7 = new MemberType();
        $memberType_7->setMemberType('Maker');
        $manager->persist($memberType_7);

        $this->addReference("memberType1", $memberType_1);
        $this->addReference("memberType2", $memberType_2);
        $this->addReference("memberType3", $memberType_3);
        $this->addReference("memberType4", $memberType_4);
        $this->addReference("memberType5", $memberType_5);
        $this->addReference("memberType6", $memberType_6);
        $this->addReference("memberType7", $memberType_7);

        $manager->flush();
    }
}
