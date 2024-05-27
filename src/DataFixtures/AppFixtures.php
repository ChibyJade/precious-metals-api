<?php

namespace App\DataFixtures;

use App\Entity\Metal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->createMetal($manager, 'XAU', 'Gold');
        $this->createMetal($manager, 'XAG', 'Silver');
        $this->createMetal($manager, 'XPT', 'Platinum');
        $this->createMetal($manager, 'XPD', 'Palladium');

        $manager->flush();
    }

    private function createMetal(ObjectManager $manager, string $symbol, string $name): void
    {
        $metal = new Metal();
        $metal->setSymbol($symbol);
        $metal->setName($name);

        $manager->persist($metal);
    }
}
