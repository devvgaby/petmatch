<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
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
            'nome' => 'required|string|max:255',
            'especie' => 'required|string|max:50',
            'raca' => 'nullable|string|max:100',
            'idade' => 'required|integer|min:0',
            'sexo' => 'required|in:macho,femea',
            'descricao' => 'nullable|string',
            'preferencias' => 'nullable|string',
            'foto_perfil_url' => 'nullable|string|max:255',
            'usuario_id' => 'required|exists:usuarios,id',
        ];
    }
}
