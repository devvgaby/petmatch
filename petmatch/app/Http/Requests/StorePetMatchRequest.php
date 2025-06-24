<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetMatchRequest extends FormRequest
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
            'pet1_id' => 'required|exists:pets,id',
            'pet2_id' => 'required|exists:pets,id|different:pet1_id',
            'status' => 'required|in:pendente,aceito,rejeitado',
        ];
    }
}
