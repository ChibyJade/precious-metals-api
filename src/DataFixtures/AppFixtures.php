<?php

namespace App\DataFixtures;

use App\Entity\Metal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->createMetal($manager, 'Gold', 'XAU');
        $this->createMetal($manager, 'Silver', 'XAG');
        $this->createMetal($manager, 'Platinum', 'XPT');
        $this->createMetal($manager, 'Palladium', 'XPD');

        $manager->flush();
    }

    private function createMetal(ObjectManager $manager, string $name, string $ISO4217Code): void
    {
        $metal = new Metal();
        $metal->setName($name);
        $metal->setISO4217Code($ISO4217Code);

        $manager->persist($metal);
    }
}
