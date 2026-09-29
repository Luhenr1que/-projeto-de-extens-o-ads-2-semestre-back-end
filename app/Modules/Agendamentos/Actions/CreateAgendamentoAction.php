<?php

namespace App\Modules\Agendamentos\Actions;

use App\Modules\Agendamentos\Data\CreateAgendamentoData;
use App\Modules\Agendamentos\Enums\AgendamentoStatus;
use App\Modules\Agendamentos\Models\Agendamento;
use App\Modules\Servicos\Models\Servico;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateAgendamentoAction
{
    public function execute(CreateAgendamentoData $data): Agendamento
    {
        $conflito = Agendamento::query()
            ->where('barbeiro_id', $data->barbeiroId)
            ->where('data_hora', $data->dataHora)
            ->where('status', '!=', AgendamentoStatus::Cancelado)
            ->exists();

        if ($conflito) {
            throw ValidationException::withMessages([
                'data_hora' => 'Este barbeiro já possui um agendamento neste horário.',
            ]);
        }

        return DB::transaction(function () use ($data) {
            $agendamento = Agendamento::query()->create([
                'cliente_id' => $data->clienteId,
                'barbeiro_id' => $data->barbeiroId,
                'data_hora' => $data->dataHora,
                'status' => AgendamentoStatus::Agendado,
                'observacao' => $data->observacao,
            ]);

            $servicos = Servico::query()->whereIn('id', $data->servicoIds)->get();

            $agendamento->servicos()->attach(
                $servicos->mapWithKeys(fn (Servico $servico) => [
                    $servico->id => ['preco_cobrado' => $servico->preco],
                ])
            );

            return $agendamento->load(['cliente', 'barbeiro', 'servicos']);
        });
    }
}
