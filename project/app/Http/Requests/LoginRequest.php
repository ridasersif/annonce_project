<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
          
            'email' => 'required|email|exists:users,email|max:255',
            'password' => 'required|string|min:3',
            
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => "L'adresse e-mail est obligatoire.",
            'email.email' => "L'adresse e-mail doit être valide.",
            'email.exists' => "Aucun compte associé à cette adresse e-mail.",
            'email.max' => "L'adresse e-mail ne doit pas dépasser 255 caractères.",
            'password.required' => "Le mot de passe est obligatoire.",
            'password.min' => "Le mot de passe doit contenir au moins 3 caractères.",
        ];
    }
}
