<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegistrationRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Auth\AuthService;
use Validator;

class AuthApiController extends BaseApiController
{
    /** @var AuthService */
    private $authService;

    /**
     * Create a new AuthController instance.
     *
     * @param AuthService $authService
     *
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $token = $this->authService->login($request->getData());
        return response()->json([
            'success' => true,
            'message' => 'User successfully registered',
            'data' => $token
        ], 201);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRegistrationRequest $request)
    {
        $user = $this->authService->register($request->getData());
        return response()->json([
            'success' => true,
            'message' => 'User successfully registered',
            'data' => ['user' => $user]
        ], 201);
    }

    public function test()
    {
        return "ok";
    }
}
