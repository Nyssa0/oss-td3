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

}