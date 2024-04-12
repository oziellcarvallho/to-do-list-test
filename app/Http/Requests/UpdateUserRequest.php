<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['max:255', 'min:3'],
            'email' => ['email', 'unique:users,email,'.$this->user->id],
            'password' => ['nullable', 'min:6', 'confirmed']
        ];
    }

    public function messages() {
        return [
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'name.min' => 'O campo nome deve ter pelo menos 3 caracteres.',
            'email.email' => 'E-mail inválido.',
            'email.unique' => 'O e-mail já está em uso.',
            'password.confirmed' => 'As senhas não coincidem.',
            'password.min' => 'O campo de senha deve ter pelo menos 6 caracteres.'
        ];
    }
}
