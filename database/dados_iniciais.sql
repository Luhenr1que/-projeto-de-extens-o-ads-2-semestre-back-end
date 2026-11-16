INSERT INTO barbeiros (nome, especialidade) VALUES
('Gleide', 'Terapeuta / Naturopatia'),
('Bruno Natan', 'Barbeiro'),
('Otavio Silva', 'Barbeiro')
ON CONFLICT DO NOTHING;

INSERT INTO servicos (nome, descricao, preco, duracao_minutos)
VALUES
    ('Corte Clássico', 'Tesoura e máquina para um visual clássico.', 60.00, 45),
    ('Barba Completa', 'Modelagem e acabamento completo da barba.', 50.00, 30),
    ('Pacote Completo', 'Corte e barba em um único atendimento.', 95.00, 75)
ON CONFLICT (nome) DO NOTHING;

INSERT INTO clientes (nome, telefone, email)
VALUES ('Cliente Exemplo', '(11) 99999-9999', 'cliente@exemplo.com')
ON CONFLICT (email) DO NOTHING;

INSERT INTO agendamentos (cliente_id, barbeiro_id, data_hora, status, observacao)
SELECT c.id, b.id, '2026-10-01 14:00:00', 'AGENDADO', 'Agendamento de demonstração'
FROM clientes c
JOIN barbeiros b ON b.nome = 'Otavio Silva'
WHERE c.email = 'cliente@exemplo.com'
  AND NOT EXISTS (
      SELECT 1 FROM agendamentos a
      WHERE a.cliente_id = c.id
        AND a.barbeiro_id = b.id
        AND a.data_hora = '2026-10-01 14:00:00'
  );

INSERT INTO agendamento_servicos (agendamento_id, servico_id, preco_cobrado)
SELECT a.id, s.id, s.preco
FROM agendamentos a
JOIN clientes c ON c.id = a.cliente_id
CROSS JOIN servicos s
WHERE c.email = 'cliente@exemplo.com'
  AND a.data_hora = '2026-10-01 14:00:00'
  AND s.nome IN ('Corte Clássico', 'Barba Completa')
ON CONFLICT (agendamento_id, servico_id) DO NOTHING;

INSERT INTO horarios_funcionamento (dia_semana, horario_inicio, horario_fim) VALUES
('Segunda', '15:00', '20:20'),
('Terca',   '09:00', '21:40'),
('Quarta',  '09:00', '21:40'),
('Quinta',  '09:00', '21:40'),
('Sexta',   '09:00', '21:40'),
('Sabado',  '09:00', '20:20')
ON CONFLICT (dia_semana) DO NOTHING;