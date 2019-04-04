<?php

namespace Tests\Unit;

use App\Http\Controllers\HealthController;
use Tests\TestCase;

class HealthControllerTest extends TestCase
{
    public function testHeartbeat()
    {
        $test = (new HealthController())->heartbeat();
        $this->assertEquals(http_response_code(200), $test->getStatusCode());
    }
}
