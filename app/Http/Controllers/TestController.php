<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function logMessage()
    {
        Log::info('Message was logged');

        return response()->json(['message' => 'Logged successfully']);
    }
}
