<?php

namespace App\Modules\Agendamentos\Shapes;

use App\Modules\Agendamentos\Models\Agendamento;
use App\Modules\Barbeiros\Shapes\BarbeiroShape;
use App\Modules\Clientes\Shapes\ClienteShape;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Agendamento */
class AgendamentoShape extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->value,
            'data_hora' => $this->data_hora,
            'observacao' => $this->observacao,
            'cliente' => ClienteShape::make($this->whenLoaded('cliente')),
            'barbeiro' => BarbeiroShape::make($this->whenLoaded('barbeiro')),
            'servicos' => $this->whenLoaded('servicos', fn () => $this->servicos->map(fn ($servico) => [
                'id' => $servico->id,
                'nome' => $servico->nome,
                'preco_cobrado' => (float) $servico->pivot->preco_cobrado,
            ])),
            'criado_em' => $this->criado_em,
        ];
    }
}
