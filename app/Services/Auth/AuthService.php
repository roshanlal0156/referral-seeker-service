<?php

namespace App\Services\Auth;

use App\Common\Constants;
use App\Services\User\UserService;
use Exception;
use Illuminate\Support\Collection;
use Nette\Utils\Random;

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
        $user = $this->userService->findByMobile($data->get("mobile"));
        if ($user) {
            throw new Exception("User already exists");
        }
        $username = $this->generateUsername(Constants::$MIN_LENGTH_USERNAME);
        $data->put("username", $username);
        return $this->userService->store($data);
    }

    /**
     * register user
     *
     * @param Collection
     */
    public function login(Collection $data)
    {
        $token = auth()->attempt(["mobile" => $data->get("mobile"), "password" => $data->get("password")]);
        $user = $this->userService->findByMobile($data->get('mobile'));
        return [
            "user_id" => $user->id,
            'username' => $user->username,
            "mobile" => $user->mobile,
            "access_token" => $token,
            "token_type" => "bearer",
            'expires_in' => env('JWT_TTL') * 60
        ];
    }

    /**
     * generate username
     *
     * @param int $minLength
     *
     * @return string
     */
    public function generateUsername(int $minLength)
    {
        $username = Random::generate($minLength);
        $user = $this->userService->findByUsername($username);
        if ($user) {
            $username = $this->generateUserName($minLength + 1);
        }
        return $username;
    }
}
