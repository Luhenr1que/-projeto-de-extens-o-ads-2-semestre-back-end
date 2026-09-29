<?php

namespace App\Modules\Servicos\Models;

use App\Modules\Agendamentos\Models\Agendamento;
use Database\Factories\ServicoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Servico extends Model
{
    /** @use HasFactory<ServicoFactory> */
    use HasFactory;

    protected $table = 'servicos';

    const UPDATED_AT = null;

    const CREATED_AT = 'criado_em';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'duracao_minutos',
        'ativo',
    ];

    protected function casts(): array
    {
        return [
            'preco' => 'decimal:2',
            'duracao_minutos' => 'integer',
            'ativo' => 'boolean',
        ];
    }

    protected static function newFactory(): ServicoFactory
    {
        return ServicoFactory::new();
    }

    /**
     * @return BelongsToMany<Agendamento, $this>
     */
    public function agendamentos(): BelongsToMany
    {
        return $this->belongsToMany(Agendamento::class, 'agendamento_servicos')
            ->withPivot('preco_cobrado');
    }
}
