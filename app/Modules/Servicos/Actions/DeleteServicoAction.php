<?php

namespace App\Modules\Servicos\Actions;

use App\Modules\Servicos\Models\Servico;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class DeleteServicoAction
{
    public function execute(Servico $servico): void
    {
        try {
            $servico->delete();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                throw ValidationException::withMessages([
                    'servico' => 'Não é possível excluir um serviço já utilizado em agendamentos. Desative-o em vez de excluir.',
                ]);
            }

            throw $e;
        }
    }
}
