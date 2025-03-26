<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'sometimes|string|min:6',
            'name' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Пожалуйста, укажите ваше имя.',
            'name.string'   => 'Имя должно быть строкой.',
            'name.max'      => 'Имя не должно превышать 255 символов.',

            'email.required' => 'Пожалуйста, укажите ваш email.',
            'email.string'   => 'Email должен быть строкой.',
            'email.email'    => 'Пожалуйста, введите корректный email.',
            'email.max'      => 'Email не должен превышать 255 символов.',
            'email.unique'   => 'Этот email уже занят.',

            'password.string'    => 'Пароль должен быть строкой.',
            'password.min'       => 'Пароль должен содержать минимум 8 символов.',
        ];
    }
}
