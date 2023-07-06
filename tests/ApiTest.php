<?php

use Nyssa\OssTd3\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase {

    public function testGetProductName() {
        $api = new Api();
        $result = $api->getAllMangas();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);

        foreach ($result as $item) {
            $this->assertIsString($item);
        }
    }

    public function testGetAllMangasWithPrices() {
        $api = new Api();

        $result = $api->getAllMangasWithPrices();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);

        foreach ($result as $item) {
            $this->assertIsArray($item);
            $this->assertArrayHasKey('title', $item);
            $this->assertArrayHasKey('price', $item);
            $this->assertIsString($item['title']);
            $this->assertIsString($item['price']);
        }
    }
}