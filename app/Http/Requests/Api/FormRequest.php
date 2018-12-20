<?php

namespace App\Http\Requests\Api;



class FormRequest extends \Dingo\Api\Http\FormRequest
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
}
