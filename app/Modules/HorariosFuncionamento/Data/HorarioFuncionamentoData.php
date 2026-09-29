<?php

namespace App\Modules\HorariosFuncionamento\Data;

use Illuminate\Foundation\Http\FormRequest;

final readonly class HorarioFuncionamentoData
{
    public function __construct(
        public string $horarioInicio,
        public string $horarioFim,
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            horarioInicio: $request->validated('horario_inicio'),
            horarioFim: $request->validated('horario_fim'),
        );
    }
}
