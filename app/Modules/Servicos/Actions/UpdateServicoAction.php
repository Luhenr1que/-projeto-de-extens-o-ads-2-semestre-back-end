<?php

namespace App\Modules\Servicos\Actions;

use App\Modules\Servicos\Data\ServicoData;
use App\Modules\Servicos\Models\Servico;

class UpdateServicoAction
{
    public function execute(Servico $servico, ServicoData $data): Servico
    {
        $servico->update([
            'nome' => $data->nome,
            'descricao' => $data->descricao,
            'preco' => $data->preco,
            'duracao_minutos' => $data->duracaoMinutos,
            'ativo' => $data->ativo,
        ]);

        return $servico;
    }
}
