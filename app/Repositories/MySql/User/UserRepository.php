<?php

namespace App\Repositories\MySql\User;

use App\Common\Utils;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * store
     *
     * @param Collection $data
     *
     * @return User
     */
    public function store(Collection $data)
    {
        $userData = collect($this->formFields($data));

        if (!Utils::containsAll($userData, ["name", "email", "password"])) {
            throw new Exception("Data field missing");
        }

        $model = new User($userData->toArray());

        $model->save();
        return $model->refresh();
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
        return User::where(["email" => $email, "status" => "active"])->first();
    }

    /**
     * form feilds
     *
     * @param Collection $data
     *
     * @return Collection
     */
    private function formFields(Collection $data)
    {
        $result = new Collection();

        if ($data->has("name")) {
            $result->put("name", $data->get("name"));
        }

        if ($data->has("email")) {
            $result->put("email", $data->get("email"));
        }

        if ($data->has("password")) {
            $result->put("password", $data->get("password"));
        }

        return $result;
    }
}
