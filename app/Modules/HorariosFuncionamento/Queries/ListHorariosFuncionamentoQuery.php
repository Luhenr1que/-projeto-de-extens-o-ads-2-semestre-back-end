<?php

namespace App\Modules\HorariosFuncionamento\Queries;

use App\Modules\HorariosFuncionamento\Models\HorarioFuncionamento;
use Illuminate\Database\Eloquent\Collection;

class ListHorariosFuncionamentoQuery
{
    public function execute(): Collection
    {
        return HorarioFuncionamento::query()->orderBy('id')->get();
    }
}
