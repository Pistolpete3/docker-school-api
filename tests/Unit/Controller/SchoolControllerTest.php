<?php

namespace Tests\Unit;

use Tests\TestCase;

class SchoolControllerTest extends TestCase
{
    private function checkSchoolPayload(array $data, $checkProducts = true)
    {
        $this->assertIsString($data['name']);
        $this->assertIsString($data['city']);
        $this->assertIsString($data['state']);
        $this->assertIsInt($data['zip']);
        $this->assertIsInt($data['circulation']);

        if ($checkProducts) {
            $this->assertIsNumeric($data['products'][0]['price']);
            $this->assertIsString($data['products'][0]['name']);
        }
    }

    public function testShowAllSchools()
    {
        $response = $this->call('GET', '/api/v1/schools');
        $results = $response->getData(true);

        $this->checkSchoolPayload($results['data'][0]);
    }

    public function testExportAllSchools()
    {
        $response = $this->call('GET', '/api/v1/export/schools');
        $this->assertNotNull($response);
    }

    public function testShow()
    {
        $response = $this->call('GET', '/api/v1/school/1');
        $results = $response->getData(true);

        $this->checkSchoolPayload($results['data'], false);
    }
}
