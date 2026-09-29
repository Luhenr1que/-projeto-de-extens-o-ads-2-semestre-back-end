<?php

namespace App\Modules\Barbeiros\Actions;

use App\Modules\Barbeiros\Data\BarbeiroData;
use App\Modules\Barbeiros\Models\Barbeiro;

class UpdateBarbeiroAction
{
    public function execute(Barbeiro $barbeiro, BarbeiroData $data): Barbeiro
    {
        $barbeiro->update([
            'nome' => $data->nome,
            'especialidade' => $data->especialidade,
            'ativo' => $data->ativo,
        ]);

        return $barbeiro;
    }
}
