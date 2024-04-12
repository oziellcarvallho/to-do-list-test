<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'min:3'],
            'description' => ['max:255', 'min:2'],
            'users_id' => ['required', 'exists:users,id'],
            'responsible_id' => ['required', 'exists:users,id']
        ];
    }

    public function messages() {
        return [
            'title.max' => 'O campo do título deve ter no máximo 255 caracteres.',
            'title.min' => 'O campo do título deve ter pelo menos 3 caracteres.',
            'title.required' => 'O campo título não pode ficar vazio.',
            'description.max' => 'O campo de descrição deve ter no máximo 255 caracteres.',
            'description.min' => 'O campo de descrição deve ter pelo menos 2 caracteres.',
            'users_id.required' => 'O campo usuários não pode estar vazio.',
            'users_id.exists' => 'O(s) usuário(s) especificado(s) não existe(m).',
            'responsible_id.required' => 'O campo responsável não pode estar vazio.',
            'responsible_id.exists' => 'O responsável especificado não existe.'
        ];
    }
}