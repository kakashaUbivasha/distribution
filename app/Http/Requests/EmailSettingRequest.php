<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmailSettingRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'email' => 'required|email|max:255',
            'smtp_host' => 'required|string|max:255',
            'smtp_port' => 'required|integer|between:1,65535',
            'smtp_username' => 'required|string|max:255',
            'smtp_password' => 'nullable|string|max:255',
            'encryption' => [
                'nullable',
                'string',
                Rule::in(['tls', 'ssl', null]),
            ],
            'default' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Необходимо указать пользователя',
            'user_id.exists' => 'Указанный пользователь не существует',
            'email.required' => 'Email обязателен для заполнения',
            'email.email' => 'Укажите корректный email адрес',
            'smtp_host.required' => 'SMTP хост обязателен',
            'smtp_port.required' => 'SMTP порт обязателен',
            'smtp_port.between' => 'Порт должен быть в диапазоне 1-65535',
            'smtp_username.required' => 'SMTP логин обязателен',
            'encryption.in' => 'Допустимые значения шифрования: tls, ssl',
        ];
    }
}
