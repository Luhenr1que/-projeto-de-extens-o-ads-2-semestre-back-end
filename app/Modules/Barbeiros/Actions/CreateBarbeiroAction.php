<?php

namespace App\Modules\Barbeiros\Actions;

use App\Modules\Barbeiros\Data\BarbeiroData;
use App\Modules\Barbeiros\Models\Barbeiro;

class CreateBarbeiroAction
{
    public function execute(BarbeiroData $data): Barbeiro
    {
        return Barbeiro::query()->create([
            'nome' => $data->nome,
            'especialidade' => $data->especialidade,
            'ativo' => $data->ativo,
        ]);
    }
}
