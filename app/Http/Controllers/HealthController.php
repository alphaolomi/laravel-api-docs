<?php

namespace App\Http\Controllers;

use Knuckles\Scribe\Attributes\Group;

#[Group('Health Checks', 'APIs for health checks')]
class HealthController extends Controller
{
    public function __invoke()
    {
        return [
            'status' => 'up',
            'services' => [
                'database' => 'up',
                'redis' => 'up',
            ],
        ];
    }
}
