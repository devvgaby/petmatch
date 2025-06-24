<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMensagemRequest extends FormRequest
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
            'remetente_id' => 'required|exists:usuarios,id',
            'destinatario_id' => 'required|exists:usuarios,id|different:remetente_id',
            'match_id' => 'required|exists:matches,id',
            'conteudo' => 'required|string',
        ];
    }
}
