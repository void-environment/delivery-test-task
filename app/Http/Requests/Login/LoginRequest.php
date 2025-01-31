<?php
declare(strict_types=1);

namespace App\Http\Requests\Login;

use App\Http\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:4',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email обязателен.',
            'email.email' => 'Введите корректный email.',
            'password.required' => 'Пароль обязателен.',
            'password.min' => 'Пароль должен содержать минимум 4 символов.',
        ];
    }
}
