<?php

namespace App\Http\Controllers\Api\Web\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\Customer\Auth\SignInRequest;
use App\Http\Resources\Api\CurrentUserResource;
use App\Http\Resources\Api\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function signUp(Request $request): JsonResponse
    {

        // Sign up logic here (not provided in the original snippets)
        return $this->success("Sign up successful.");
    }

    public function signIn(SignInRequest $request): JsonResponse
    {
        if (!$request->authenticate()) return $this->error('Invalid credentials.', 401);

        $token = $request->authenticatedUser()->createToken(
            'auth_token',
            expiresAt: $request->remember ? now()->addYear() : now()->addDay()
        )->plainTextToken;

        return $this->success(
            "Sign in successful.",
            201,
            [
                "user" => CurrentUserResource::make($request->authenticatedUser()),
                "accessToken" => $token,
                "tokenType" => "Bearer",
            ]
        );
    }

    public function signOut(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return $this->success("Sign out successful.");
    }
}
