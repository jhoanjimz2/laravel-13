<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class SignInRequest extends FormRequest
{

    #[Override]
    public function attributes() : array
    {
        return [
            'password' => 'contraseña'
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'email.exists' => 'No encontramos una cuenta con ese e-mail'
        ];
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ];
    }
}
