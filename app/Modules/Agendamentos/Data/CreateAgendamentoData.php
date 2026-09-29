<?php

namespace App\Modules\Agendamentos\Data;

use Illuminate\Foundation\Http\FormRequest;

final readonly class CreateAgendamentoData
{
    /**
     * @param  array<int, int>  $servicoIds
     */
    public function __construct(
        public int $clienteId,
        public int $barbeiroId,
        public string $dataHora,
        public ?string $observacao,
        public array $servicoIds,
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            clienteId: (int) $request->validated('cliente_id'),
            barbeiroId: (int) $request->validated('barbeiro_id'),
            dataHora: $request->validated('data_hora'),
            observacao: $request->validated('observacao'),
            servicoIds: $request->validated('servicos'),
        );
    }
}
