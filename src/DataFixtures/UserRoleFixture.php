<?php

namespace App\DataFixtures;

use App\Entity\UserRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserRoleFixture extends Fixture
{
    public const USER_ID = 10001;
    public const REFERENCE = 'user-role';

    public function load(ObjectManager $manager): void
    {
        $userRole = new UserRole();
        $userRole->setUserId(self::USER_ID);
        $userRole->addRole($this->getReference(RoleFixture::REFERENCE));
        $manager->persist($userRole);
        $manager->flush();
        $this->addReference(self::REFERENCE, $userRole);
    }
}
