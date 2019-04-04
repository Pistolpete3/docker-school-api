<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public function testRetrieveProductsBySchoolCount()
    {
        $response = $this->call('GET', '/api/v1/products/schoolsCount');
        $results = $response->getData(true);

        $this->assertIsInt($results['data'][0]['product_id']);
        $this->assertIsString($results['data'][0]['product_name']);
        $this->assertIsInt($results['data'][0]['school_count']);
    }

    public function testRetrieveProductsByValue()
    {
        $response = $this->call('GET', '/api/v1/products/value');
        $results = $response->getData(true);

        $this->assertIsInt($results['data'][0]['product_id']);
        $this->assertIsString($results['data'][0]['product_name']);
        $this->assertIsInt($results['data'][0]['school_id']);
        $this->assertIsString($results['data'][0]['school_name']);
        $this->assertIsNumeric($results['data'][0]['value']);
    }
}
