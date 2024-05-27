<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Client\GoldApiClient;
use App\Entity\MetalPrice;
use App\Factory\MetalPriceFactory;
use App\Repository\MetalRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class MetalPriceProvider implements ProviderInterface
{
    public function __construct(
        private MetalRepository $metalRepository,
        private GoldApiClient $goldApiClient,
        private MetalPriceFactory $metalPriceFactory,
        private EntityManagerInterface $entityManager
    ) {

    }

    /**
     * @return MetalPrice|array|null
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $metalSymbol = $uriVariables['symbol'];
        $metal = $this->metalRepository->find($metalSymbol);

        if (!$metal) {
            return null;
        }

        $spotMetalPrice = $this->goldApiClient->getSpotMetalPrice($metalSymbol);

        if (!$spotMetalPrice) {
            return null;
        }

        $metalPrice = $this->metalPriceFactory->createFromGoldApiResponse($metal, $spotMetalPrice['currency'], $spotMetalPrice['price'], $spotMetalPrice['timestamp']);
        $this->entityManager->persist($metalPrice);
        $this->entityManager->flush();

        return $metalPrice;
    }
}
