<?php

namespace App\Modules\Clientes\Actions;

use App\Modules\Clientes\Models\Cliente;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class DeleteClienteAction
{
    public function execute(Cliente $cliente): void
    {
        try {
            $cliente->delete();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                throw ValidationException::withMessages([
                    'cliente' => 'Não é possível excluir um cliente com agendamentos registrados.',
                ]);
            }

            throw $e;
        }
    }
}
