<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixture extends Fixture
{
    public const REFERENCE = 'role';

    public function load(ObjectManager $manager): void
    {
        $role = new Role();
        $role->setName('test role');
        $role->addPermission($this->getReference(PermissionFixture::REFERENCE));
     //   $role->addUserRole($this->getReference(UserRoleFixture::REFERENCE));
        $manager->persist($role);
        $manager->flush();

        $this->addReference(self::REFERENCE, $role);
    }
}
