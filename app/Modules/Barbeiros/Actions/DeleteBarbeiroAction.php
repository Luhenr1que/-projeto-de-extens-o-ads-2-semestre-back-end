<?php

namespace App\Modules\Barbeiros\Actions;

use App\Modules\Barbeiros\Models\Barbeiro;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class DeleteBarbeiroAction
{
    public function execute(Barbeiro $barbeiro): void
    {
        try {
            $barbeiro->delete();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                throw ValidationException::withMessages([
                    'barbeiro' => 'Não é possível excluir um barbeiro com agendamentos registrados.',
                ]);
            }

            throw $e;
        }
    }
}
