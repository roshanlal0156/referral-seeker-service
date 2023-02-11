<?php

namespace App\Services\Auth;

use App\Services\User\UserService;
use Exception;
use Illuminate\Support\Collection;

class AuthService
{
    /** @var UserService */
    private $userService;

    /**
     * constructor
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * register user
     *
     * @param Collection
     */
    public function register(Collection $data)
    {
        $user = $this->userService->findByEmail($data->get("email"));
        if ($user) {
            throw new Exception("User already exists");
        }
        return $this->userService->store($data);
    }

    /**
     * register user
     *
     * @param Collection
     */
    public function login(Collection $data)
    {
        $token = auth()->attempt(["email" => $data->get("email"), "password" => $data->get("password")]);
        return ["access_token" => $token, "token_type" => "bearer", 'expires_in' => env('JWT_TTL') * 60];
    }
}
