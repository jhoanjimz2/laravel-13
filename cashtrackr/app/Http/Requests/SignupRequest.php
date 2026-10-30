<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Override;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    #[Override]
    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El e-mail es obligatorio',
            'email.email' => 'E-mail no valido',
            'email.unique' => 'Este correo ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos :min caracteres',
            'password.letters' => 'La contraseña debe tener al menos 1 letra',
            'password.mixedCase' => 'La contraseña debe tener al menos 1 letra mayúscula y 1 minúscula',
            'password.symbols' => 'La contraseña debe tener al menos 1 caracter especial (^@_-.*)',
            'password.numbers' => 'La contraseña debe tener al menos 1 numero',
            'password.uncompromised' => 'La contraseña ha aparecido en filtraciones de datos. Elige una más segura.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->symbols()
                    ->numbers()
                    ->uncompromised()
            ]
        ];
    }
}
