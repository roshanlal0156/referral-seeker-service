<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserService
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * register user
     *
     * @param Collection
     */
    public function store(Collection $data)
    {
        $user = $this->userRepository->store($data);
        return collect(["id" => $user->id, "username" => $user->username, "mobile" => $user->mobile]);
    }

    /**
     * find by email
     *
     * @param string $email
     *
     * @return User
     */
    public function findByEmail(string $email)
    {
        return $this->userRepository->findByEmail($email);
    }

    /**
     * find by mobile
     *
     * @param string $mobile
     *
     * @return User
     */
    public function findByMobile(string $mobile)
    {
        return $this->userRepository->findByMobile($mobile);
    }

    /**
     * find by username
     *
     * @param string $username
     *
     * @return User
     */
    public function findByUsername(string $username)
    {
        return $this->userRepository->findByUsername($username);
    }
}
