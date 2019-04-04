<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthController extends Controller
{
    public function heartbeat()
    {
        return response('heartbeat', 200);
    }
}
