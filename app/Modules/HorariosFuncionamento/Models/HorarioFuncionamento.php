<?php

namespace App\Modules\HorariosFuncionamento\Models;

use Database\Factories\HorarioFuncionamentoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioFuncionamento extends Model
{
    /** @use HasFactory<HorarioFuncionamentoFactory> */
    use HasFactory;

    protected $table = 'horarios_funcionamento';

    public $timestamps = false;

    protected $fillable = [
        'dia_semana',
        'horario_inicio',
        'horario_fim',
    ];

    protected static function newFactory(): HorarioFuncionamentoFactory
    {
        return HorarioFuncionamentoFactory::new();
    }
}
