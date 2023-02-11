<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class UserRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Validation rules for the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'regex:/(.+)@(.+)\.(.+)/i'],
            'password' => ['required', 'string'],

        ];
    }

    /**
     * Get Doctor Registration Data
     *
     * @return
     */
    public function getData()
    {
        $data = new Collection();
        $data->put('name', $this->get('name'));
        $data->put('email', $this->get('email'));
        $data->put('password', bcrypt($this->get('password')));

        $data = $this->filterFiles($data);

        return $data;
    }
}
