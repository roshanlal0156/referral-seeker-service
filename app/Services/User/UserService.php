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
        return $this->userRepository->store($data);
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
}
