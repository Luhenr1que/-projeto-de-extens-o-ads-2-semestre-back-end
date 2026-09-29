<?php

namespace App\Modules\Barbeiros\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarbeiroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:120'],
            'especialidade' => ['nullable', 'string', 'max:150'],
            'ativo' => ['sometimes', 'boolean'],
        ];
    }
}
