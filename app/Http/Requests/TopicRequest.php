<?php

namespace App\Http\Requests;

class TopicRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        switch ($this->method()) {
            case 'POST':
            case 'PUT';
                $rules = [
                    'title' => 'sometimes|required|min:3|max:30',
                    'category_id' => 'sometimes|required',
                    'body' => 'sometimes|required|min:5',
                    'captcha' => 'sometimes|required|captcha',
                    'upload_file' => 'sometimes|max:1024'
                ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码不正确'
        ];
    }
}
