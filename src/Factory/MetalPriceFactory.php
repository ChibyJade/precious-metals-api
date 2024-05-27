<?php

namespace App\Factory;

use App\Entity\Metal;
use App\Entity\MetalPrice;

class MetalPriceFactory
{
    public static function createFromGoldApiResponse(Metal $metal, string $currency, float $price, int $timestamp): MetalPrice
    {
        $registeredAt = (new \DateTimeImmutable())->setTimestamp($timestamp);

        return (new MetalPrice())
            ->setMetal($metal)
            ->setCurrency($currency)
            ->setPrice($price)
            ->setRegisteredAt($registeredAt);
    }
}
