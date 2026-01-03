<?php

namespace Src\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Application\DTOs\RegisterStudentDTO;

class RegisterStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Tout le monde peut s'inscrire
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // password_confirmation obligatoire
        ];
    }

    // Transforme la request en DTO pour le UseCase
    public function getDTO(): RegisterStudentDTO
    {
        return new RegisterStudentDTO(
            email: $this->input('email'),
            password: $this->input('password')
        );
    }
}
