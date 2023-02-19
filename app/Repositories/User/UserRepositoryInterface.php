<?php

namespace App\Repositories\User;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    /**
     * store
     *
     * @param Collection $data
     *
     * @return User
     */
    public function store(Collection $data);

    /**
     * find by email
     *
     * @param string $email
     *
     * @return User
     */
    public function findByEmail(string $email);

    /**
     * find by mobile
     *
     * @param string $mobile
     *
     * @return User
     */
    public function findByMobile(string $mobile);

    /**
     * find by username
     *
     * @param string $username
     *
     * @return User
     */
    public function findByUsername(string $username);
}
