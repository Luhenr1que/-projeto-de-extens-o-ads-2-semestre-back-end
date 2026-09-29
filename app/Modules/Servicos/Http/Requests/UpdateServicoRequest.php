<?php

namespace App\Modules\Servicos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServicoRequest extends FormRequest
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
            'nome' => ['required', 'string', 'max:120', Rule::unique('servicos', 'nome')->ignore($this->route('servico'))],
            'descricao' => ['nullable', 'string', 'max:300'],
            'preco' => ['required', 'numeric', 'min:0'],
            'duracao_minutos' => ['required', 'integer', 'min:1'],
            'ativo' => ['sometimes', 'boolean'],
        ];
    }
}
