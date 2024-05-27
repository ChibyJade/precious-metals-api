<?php

namespace App\Client;

use App\Entity\Metal;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoldApiClient
{
    const string GOLD_API_ENDPOINT = 'https://www.goldapi.io/api';
    const string CURRENCY_EUR = 'EUR';

    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly string $goldApiKey
    )
    {
    }

    public function getSpotMetalPrice(string $metalSymbol): ?array
    {
        $response = $this->client->request(
            'GET',
            self::GOLD_API_ENDPOINT . '/' . $metalSymbol . '/' . self::CURRENCY_EUR,
            [
                'headers' => [
                    'x-access-token' => $this->goldApiKey,
                ]
            ],
        );

        $statusCode = $response->getStatusCode();

        if ($statusCode >= 300) {
            return null;
        }

        $content = $response->toArray();

        if (!isset($content['price']) || !is_float($content['price'])) {
            return null;
        }



        return $content;
    }
}
