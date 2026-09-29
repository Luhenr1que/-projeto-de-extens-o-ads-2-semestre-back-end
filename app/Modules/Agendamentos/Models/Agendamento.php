<?php

namespace App\Modules\Agendamentos\Models;

use App\Modules\Agendamentos\Enums\AgendamentoStatus;
use App\Modules\Barbeiros\Models\Barbeiro;
use App\Modules\Clientes\Models\Cliente;
use App\Modules\Servicos\Models\Servico;
use Database\Factories\AgendamentoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Agendamento extends Model
{
    /** @use HasFactory<AgendamentoFactory> */
    use HasFactory;

    protected $table = 'agendamentos';

    const UPDATED_AT = null;

    const CREATED_AT = 'criado_em';

    protected $fillable = [
        'cliente_id',
        'barbeiro_id',
        'data_hora',
        'status',
        'observacao',
    ];

    protected function casts(): array
    {
        return [
            'data_hora' => 'datetime',
            'status' => AgendamentoStatus::class,
        ];
    }

    /**
     * @return BelongsTo<Cliente, $this>
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * @return BelongsTo<Barbeiro, $this>
     */
    public function barbeiro(): BelongsTo
    {
        return $this->belongsTo(Barbeiro::class);
    }

    /**
     * @return BelongsToMany<Servico, $this>
     */
    public function servicos(): BelongsToMany
    {
        return $this->belongsToMany(Servico::class, 'agendamento_servicos')
            ->withPivot('preco_cobrado');
    }

    protected static function newFactory(): AgendamentoFactory
    {
        return AgendamentoFactory::new();
    }
}
