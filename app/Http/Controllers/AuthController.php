<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Unauthenticated;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Response;


#[Group("Authentication", "APIs for authentication")]
class AuthController extends Controller
{
    #[Endpoint("Login the user")]
    #[Unauthenticated]
    #[BodyParam("email", "string", "The Email of the user.", example: "user@example.com")]
    #[BodyParam("password", "string", "The password of the user.", example: "password")]
    #[Response([
        "token" => "1|0M0VCKSJam4zQU058p3ZJ4GXCiDCWYkCyJflPegA",
        "user" => [
            "id" => 1,
            "name" => "John Doe",
            "email" => "johndoe@example.com",
        ]
    ])]
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        /** @var \App\Models\User|null $user */
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        /** @var \Laravel\Sanctum\NewAccessToken */
        $token = $user->createToken($request->ip());

        return response()->json([
            'token' => $token->plainTextToken,
            'user' => $user
        ]);
    }

    #[Endpoint("Logout the user")]
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
