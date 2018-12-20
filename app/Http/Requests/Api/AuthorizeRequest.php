<?php

namespace App\Http\Requests\Api;

class AuthorizeRequest extends FormRequest
{

    /**
     * 普通登录验证
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ];
    }
}
