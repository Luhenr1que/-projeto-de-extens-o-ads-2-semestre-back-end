<?php

namespace App\Modules\Barbeiros\Shapes;

use App\Modules\Barbeiros\Models\Barbeiro;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Barbeiro */
class BarbeiroShape extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'especialidade' => $this->especialidade,
            'ativo' => $this->ativo,
            'criado_em' => $this->criado_em,
        ];
    }
}
