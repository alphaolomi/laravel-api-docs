<?php

namespace Tests\Http\Middleware;

use App\Http\Middleware\LogApiRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LogApiRequestsTest extends TestCase
{
    public function testHandleReturnsResponseFromNext()
    {
        $middleware = new LogApiRequests();

        $request = Request::create('/test', 'GET');
        $response = new Response('Test response');

        $next = function ($request) use ($response) {
            return $response;
        };

        $result = $middleware->handle($request, $next);

        $this->assertSame($response, $result);
    }

    public function testTerminateLogsApiRequest()
    {
        $middleware = new LogApiRequests();

        $request = Request::create('/test', 'GET');
        $response = new Response('Test response');

        $expectedLogData = [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'status_code' => $response->status(),
            'user_agent' => $request->header('User-Agent'),
            'total_time' => microtime(true) - LARAVEL_START,
        ];

        Log::shouldReceive('channel')->with('api')->andReturnSelf();
        Log::shouldReceive('info')->with('API Request', $expectedLogData);

        $middleware->terminate($request, $response);
    }
}