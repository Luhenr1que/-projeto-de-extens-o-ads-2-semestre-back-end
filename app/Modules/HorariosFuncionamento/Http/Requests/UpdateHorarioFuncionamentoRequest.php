<?php

namespace App\Modules\HorariosFuncionamento\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHorarioFuncionamentoRequest extends FormRequest
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
            'horario_inicio' => ['required', 'date_format:H:i'],
            'horario_fim' => ['required', 'date_format:H:i', 'after:horario_inicio'],
        ];
    }
}
