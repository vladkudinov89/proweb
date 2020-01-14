<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'about' => 'required|string|min:10|max:255',
            'gender' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Вы не указали Имя',
            'about.required' => 'Вы не указали данные "О Себе"',
            'name.min' => 'Минимум 2 символа в имени',
            'about.min' => 'Минимум 10 символов в описании "О Себе"',
        ];
    }
}
