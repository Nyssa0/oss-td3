<?php

use Nyssa\OssTd3\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase {

    public function testGetProductName() {
        $api = new Api();
        $this->assertIsArray($api->getAllMangas());
        $this->assertNotEmpty($api->getAllMangas());
    }
}