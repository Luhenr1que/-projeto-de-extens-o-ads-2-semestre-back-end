<?php

namespace App\Modules\Agendamentos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgendamentoRequest extends FormRequest
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
            'cliente_id' => ['required', 'integer', 'exists:clientes,id'],
            'barbeiro_id' => ['required', 'integer', 'exists:barbeiros,id'],
            'data_hora' => ['required', 'date'],
            'observacao' => ['nullable', 'string', 'max:500'],
            'servicos' => ['required', 'array', 'min:1'],
            'servicos.*' => ['integer', 'exists:servicos,id'],
        ];
    }
}
