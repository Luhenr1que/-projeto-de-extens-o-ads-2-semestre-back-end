<?php

namespace Database\Seeders;

use App\Modules\Barbeiros\Models\Barbeiro;
use App\Modules\Servicos\Models\Servico;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarbeariaSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('TRUNCATE servicos, barbeiros RESTART IDENTITY CASCADE');

        // [nome, descricao, preco, duracao_minutos]
        $servicos = [
            ['Barba', null, 40.00, 40],
            ['Cabelo e barba', null, 79.99, 80],
            ['Combo pai e filho (cabelo/barba, cabelo)', null, 120.00, 120],
            ['Corte', "\u{201c}s\u{00f3} cabelo\u{201d}", 45.00, 30],
            ['Corte e penteado', null, 70.00, 60],
            ['Corte e sobrancelha', null, 50.00, 40],
            ["Corte + hidrata\u{00e7}\u{00e3}o", null, 65.00, 40],
            ['Corte infantil', null, 45.00, 40],
            [
                "Depila\u{00e7}\u{00e3}o com cera (nariz)",
                "Remo\u{00e7}\u{00e3}o dos pelos nasais com cera morna, proporcionando limpeza, conforto e um visual mais alinhado. Procedimento r\u{00e1}pido, seguro e indolor.",
                10.00,
                10,
            ],
            [
                "Depila\u{00e7}\u{00e3}o com cera (orelha)",
                "Limpeza completa da regi\u{00e3}o externa da orelha com cera morna, eliminando os pelos vis\u{00ed}veis e deixando o visual mais limpo e bem cuidado.",
                10.00,
                10,
            ],
            [
                "Depila\u{00e7}\u{00e3}o com cera (orelha/nariz)",
                "Combo de depila\u{00e7}\u{00e3}o completa nas regi\u{00f5}es do nariz e orelha, utilizando cera morna para garantir higiene, conforto e acabamento impec\u{00e1}vel.",
                15.00,
                20,
            ],
            ['Penteado', null, 35.00, 20],
            [
                'Perfil',
                'Acabamento detalhado para alinhar o contorno do cabelo, deixando o visual limpo e definido.',
                25.00,
                10,
            ],
            [
                'Plano mensal cabelo/barba',
                "Pacote mensal que inclui cortes e ajustes de barba ao longo do m\u{00ea}s, ideal para quem busca praticidade e manter o visual sempre em dia. Consultar no nosso WhatsApp!",
                0,
                80,
            ],
            [
                'Plano mensal corte',
                "Pacote mensal de cortes, pensado para quem gosta de estar sempre alinhado com praticidade e economia. Consultar no nosso WhatsApp!",
                0,
                40,
            ],
            ['Progressiva Masculina', null, 90.00, 100],
            ['Sobrancelha', null, 15.00, 10],
        ];

        foreach ($servicos as [$nome, $descricao, $preco, $duracao]) {
            Servico::create([
                'nome' => $nome,
                'descricao' => $descricao,
                'preco' => $preco,
                'duracao_minutos' => $duracao,
                'ativo' => true,
            ]);
        }

        Barbeiro::create([
            'nome' => 'Otavio',
            'especialidade' => "Cortes cl\u{00e1}ssicos",
            'ativo' => true,
        ]);

        Barbeiro::create([
            'nome' => 'Bruno Nathan',
            'especialidade' => 'Barba e navalha',
            'ativo' => true,
        ]);
    }
}
