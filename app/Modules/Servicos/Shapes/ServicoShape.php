<?php

namespace App\Modules\Servicos\Shapes;

use App\Modules\Servicos\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Servico */
class ServicoShape extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => (float) $this->preco,
            'duracao_minutos' => $this->duracao_minutos,
            'ativo' => $this->ativo,
            'criado_em' => $this->criado_em,
        ];
    }
}
