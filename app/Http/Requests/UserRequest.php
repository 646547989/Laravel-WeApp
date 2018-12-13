<?php

namespace App\Http\Requests;
class UserRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'sometimes|required',
            'email' => 'sometimes|required|email',
            'intro' => 'sometimes|max:51',
            'password'  => 'sometimes|confirmed'
        ];

    }
}
