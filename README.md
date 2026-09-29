# Backend — Barbearia (Laravel)

API para o sistema de agendamento da barbearia. O schema do banco é gerenciado pelos scripts SQL em [`../DATABASE`](../DATABASE) — este backend não usa migrations do Laravel, apenas consome as tabelas já modeladas ali.

## Arquitetura

Monólito modular orientado a casos de uso, com separação estilo CQRS entre leitura e escrita. Cada domínio mora em `app/Modules/<Dominio>`:

```
app/Modules/<Dominio>/
├── Http/Controllers/   Adaptador HTTP — thin, delega para Action/Query
├── Http/Requests/      Validação estrutural da entrada
├── Data/                DTOs que atravessam camadas sem carregar HTTP
├── Actions/             Casos de uso que escrevem/mudam estado
├── Queries/             Casos de uso de leitura
├── Shapes/              Formato de saída (JsonResource)
└── Models/               Estado e comportamento da própria entidade
```

Módulos: `Clientes`, `Barbeiros`, `Servicos`, `HorariosFuncionamento`, `Agendamentos`.

`Agendamentos` é o único com transições de estado (`AGENDADO → CONFIRMADO/CANCELADO`, `AGENDADO|CONFIRMADO → CONCLUIDO`) e uma regra real derivada do schema: um barbeiro não pode ter dois agendamentos não cancelados no mesmo horário.

### O que foi deixado de fora, e por quê

Seguindo a mesma regra de "por necessidade, não por obrigação": nenhuma dessas peças tem um caso de uso real hoje, então não foram criadas pastas vazias para elas.

| Peça | Por que não existe ainda | Quando criar |
|---|---|---|
| Policy | Não há autenticação/usuários no schema | Quando houver login de barbeiro/admin |
| Middleware customizado | Nenhuma regra de borda além do padrão do Laravel | Multi-tenant, rate limit por empresa, etc. |
| Event/Listener | Nenhuma reação assíncrona a um fato ainda | Notificar cliente por e-mail/WhatsApp ao confirmar |
| Job/Queue | Nenhuma chamada a sistema externo | Envio de webhook, e-mail, SMS |
| Notification | Nenhum canal de envio configurado | Quando existir envio de e-mail/SMS |
| Repository | Eloquent resolve tudo sem uma segunda fonte de dado | Se um dia trocar de storage ou precisar mockar persistência |
| Command (CLI) | Nenhuma rotina recorrente | Ex.: fechar agendamentos vencidos via cron |

## Banco de dados

- **Fonte da verdade do schema**: [`DATABASE/02-create-tables.sql`](../DATABASE/02-create-tables.sql). Não há migrations Laravel — os Models apontam diretamente para as tabelas já criadas por esse script (nomes de tabela/coluna em português, sem `updated_at`).
- **Dados iniciais**: [`DATABASE/03-insert-data.sql`](../DATABASE/03-insert-data.sql). Não há seeders Laravel para não duplicar essa fonte.
- Configure `.env` com as credenciais do Postgres (`DB_HOST`, `DB_PORT`, `DB_DATABASE=barbearia_db`, `DB_USERNAME`, `DB_PASSWORD`) e rode os scripts de `DATABASE/` na ordem descrita no README daquela pasta antes de usar a API.

## Rodar localmente

```bash
composer install
cp .env.example .env   # ajuste as credenciais do Postgres
php artisan key:generate
php artisan serve
```

## Rotas

Todas prefixadas com `/api/v1`. Ver `routes/api.php`. Resumo:

- `clientes`, `barbeiros`, `servicos`: CRUD REST padrão (`GET/POST /recurso`, `GET/PUT/DELETE /recurso/{id}`).
- `horarios-funcionamento`: `GET` lista os 6 dias cadastrados; `PUT /horarios-funcionamento/{dia_semana}` atualiza o horário de um dia (não há criação/remoção — os dias são fixos).
- `agendamentos`: `GET` (com filtros `barbeiro_id`, `cliente_id`, `status`, `data`), `POST` (cria com lista de `servicos`), `GET /{id}`, e `PATCH /{id}/confirmar|concluir|cancelar` para as transições de status.
