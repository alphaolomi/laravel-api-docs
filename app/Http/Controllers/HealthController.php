<?php

namespace App\Http\Controllers;

class HealthController extends Controller
{
    /**
     * @return array{status: string, services: array<string, string>}
     */
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
