<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class UserLoginRequest extends FormRequest
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
            'mobile' => ['required', 'string', 'regex:/^[6-9]\d{9}$/'],
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
        $data->put('mobile', $this->get('mobile'));
        $data->put('password', $this->get('password'));

        $data = $this->filterFiles($data);

        return $data;
    }
}
