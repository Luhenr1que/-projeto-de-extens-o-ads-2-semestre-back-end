<?php

namespace App\Modules\Agendamentos\Queries;

use App\Modules\Agendamentos\Models\Agendamento;
use Illuminate\Database\Eloquent\Collection;

class ListAgendamentosQuery
{
    /**
     * @param  array{barbeiro_id?: int, cliente_id?: int, status?: string, data?: string}  $filtros
     */
    public function execute(array $filtros = []): Collection
    {
        return Agendamento::query()
            ->with(['cliente', 'barbeiro', 'servicos'])
            ->when($filtros['barbeiro_id'] ?? null, fn ($query, $valor) => $query->where('barbeiro_id', $valor))
            ->when($filtros['cliente_id'] ?? null, fn ($query, $valor) => $query->where('cliente_id', $valor))
            ->when($filtros['status'] ?? null, fn ($query, $valor) => $query->where('status', $valor))
            ->when($filtros['data'] ?? null, fn ($query, $valor) => $query->whereDate('data_hora', $valor))
            ->orderBy('data_hora')
            ->get();
    }
}
