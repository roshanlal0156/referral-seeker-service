<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\RestResponse;
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
     * @return RestResponse
     */
    public function login(UserLoginRequest $request)
    {
        $token = $this->authService->login($request->getData());
        return RestResponse::done("data", $token);
    }
    /**
     * Register a User.
     *
     * @return RestResponse
     */
    public function register(UserRegistrationRequest $request)
    {
        $user = $this->authService->register($request->getData());
        return RestResponse::successResponse(["message" => "User registered successfully.", "user" => $user]);
    }

    public function test()
    {
        return "ok";
    }
}
