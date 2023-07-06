<?php

declare(strict_types=1);

namespace Nyssa\OssTd3;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

class Api {

    public function getRandomNumber(): int {
        return rand(0, 100);
    }

    public function httpRequest(): ?string
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://www.bulleenstock.com/category/manga-5'
        );

        return $response->getContent();
    }

    /**
     * Gets the title of all the mangas
     * @return string[]
     */
    public function getAllMangas(): array
    {
        $html = $this->httpRequest();

        $crawler = new Crawler($html);

        $crawler = $crawler->filter('h2>a');

        $allMangas = [];

        foreach ($crawler as $domElement) {
            $allMangas[] = $domElement->textContent;
        }

        return $allMangas;
    }

    /**
     * Returns the list of mangas with their prices
     * @return array<int, array<string, string>>|null
     */
    public function getAllMangasWithPrices(): ?array
    {
        $html = $this->httpRequest();

        $crawler = new Crawler($html);

        $allProducts = [];
         $crawler->filter('.product')->each(function (Crawler $node) use (&$allProducts): void {
            $title = $node->filter('h2>a')->text();
            $price = $node->filter('p')->text();
            $allProducts[] = [
                'title' => $title,
                'price' => $price
            ];
        });

        return $allProducts;

    }

}