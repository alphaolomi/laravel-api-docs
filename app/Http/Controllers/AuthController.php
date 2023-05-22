<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response as ResponseAttribute;
use Knuckles\Scribe\Attributes\Unauthenticated;

#[Group('Authentication', 'APIs for authentication')]
class AuthController extends Controller
{
    #[Endpoint('Login the user')]
    #[Unauthenticated]
    #[BodyParam('email', 'string', 'The Email of the user.', example: 'user@example.com')]
    #[BodyParam('password', 'string', 'The password of the user.', example: 'password')]
    #[ResponseAttribute([
        'access_token' => '1|0M0VCKSJam4zQU058p3ZJ4GXCiDCWYkCyJflPegA',
        'user' => ['id' => 1, 'name' => 'John Doe', 'email' => 'johndoe@example.com'],
    ])]
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        /** @var \App\Models\User|null $user */
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (! $user || ! Hash::check($fields['password'], $user->password)) {
            $data = [
                'code' => 'INVALID_CREDENTIALS',
            ];

            return response($data, Response::HTTP_UNAUTHORIZED);
        }

        $deviceId = $request->ip().'-'.hash('md5', $request->header('User-Agent'));

        $token = $user->createToken($deviceId);

        $content = [
            'access_token' => $token->plainTextToken,
            'user' => $user,
        ];

        return response()->json($content, Response::HTTP_OK);
    }

    #[Endpoint('Register a user')]
    #[Unauthenticated]
    #[BodyParam('name', 'string', 'The name of the user.', example: 'John Doe')]
    #[BodyParam('email', 'string', 'The Email of the user.', example: 'user@example.com')]
    #[BodyParam('password', 'string', 'The password of the user.', example: 'password')]
    public function register(RegisterRequest $request)
    {
        $fields = $request->validated(null, null);
        logger($fields);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $deviceId = $request->ip().'-'.hash('md5', $request->header('User-Agent'));
        $token = $user->createToken($deviceId);

        $content = [
            'access_token' => $token->plainTextToken,
            'user' => $user,
        ];

        return response()->json($content, 201);
    }

    #[Endpoint('Logout the user')]
    public function logout(Request $request)
    {
        // @phpstan-ignore-next-line
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
