<?php

namespace App\DataFixtures;

use App\Entity\Permission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PermissionFixture extends Fixture
{
    public const REFERENCE = 'permission';
    public function load(ObjectManager $manager): void
    {
        $permission = new Permission();
        $permission->setName('test permission');
        $manager->persist($permission);
        $manager->flush();
        $this->addReference(self::REFERENCE, $permission);
    }
}
