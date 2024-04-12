<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed']
        ];
    }

    public function messages() {
        return [
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'name.min' => 'O campo nome deve ter pelo menos 3 caracteres.',
            'name.required' => 'O campo nome não pode ficar vazio.',
            'email.email' => 'E-mail inválido.',
            'email.unique' => 'O e-mail já está em uso.',
            'email.required' => 'O campo de e-mail não pode ficar vazio.',
            'password.confirmed' => 'As senhas não coincidem.',
            'password.min' => 'O campo de senha deve ter pelo menos 6 caracteres.',
            'password.required' => 'O campo de senha não pode ficar vazio.',
        ];
    }
}
