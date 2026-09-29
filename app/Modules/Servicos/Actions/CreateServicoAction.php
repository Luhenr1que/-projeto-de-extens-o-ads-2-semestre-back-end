<?php

namespace App\Modules\Servicos\Actions;

use App\Modules\Servicos\Data\ServicoData;
use App\Modules\Servicos\Models\Servico;

class CreateServicoAction
{
    public function execute(ServicoData $data): Servico
    {
        return Servico::query()->create([
            'nome' => $data->nome,
            'descricao' => $data->descricao,
            'preco' => $data->preco,
            'duracao_minutos' => $data->duracaoMinutos,
            'ativo' => $data->ativo,
        ]);
    }
}
