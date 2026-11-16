INSERT OR IGNORE INTO barbeiros (nome, especialidade) VALUES
('Gleide', 'Terapeuta / Naturopatia'),
('Bruno Natan', 'Barbeiro'),
('Otavio Silva', 'Barbeiro');

INSERT OR IGNORE INTO servicos (nome, descricao, preco, duracao_minutos) VALUES
('Barba', 'Modelagem e acabamento de barba.', 40.00, 40),
('Cabelo e barba', 'Corte de cabelo e barba completa.', 79.99, 80),
('Combo pai e filho (cabelo/barba, cabelo)', 'Atendimento completo com cabelo e barba para o pai e corte para o filho.', 120.00, 120),
('Corte', 'Só cabelo.', 45.00, 40),
('Corte e penteado', 'Corte de cabelo com finalização e penteado.', 70.00, 60),
('Corte e sobrancelha', 'Corte de cabelo com alinhamento de sobrancelha.', 50.00, 40),
('Corte + hidratação', 'Corte de cabelo acompanhado de hidratação capilar.', 65.00, 40),
('Corte infantil', 'Corte de cabelo infantil.', 45.00, 40),
('Depilação com cera (nariz)', 'Remoção dos pelos nasais com cera morna, proporcionando limpeza, conforto e um visual mais alinhado. Procedimento rápido, seguro e indolor.', 10.00, 10),
('Depilação com Cera (Orelha)', 'Limpeza completa da região externa da orelha com cera morna, eliminando os pelos visíveis e deixando o visual mais limpo e bem cuidado.', 10.00, 10),
('Depilação com Cera (Orelha/Nariz)', 'Combo de depilação completa nas regiões do nariz e orelha, utilizando cera morna para garantir higiene, conforto e acabamento impecável.', 15.00, 15),
('Penteado', 'Finalização e penteado.', 35.00, 20),
('Perfil', 'Acabamento detalhado para alinhar o contorno do cabelo, deixando o visual limpo e definido.', 25.00, 10),
('Plano mensal cabelo/barba', 'Pacote mensal que inclui cortes e ajustes de barba ao longo do mês, ideal para quem busca praticidade e manter o visual sempre em dia. Consultar no nosso WhatsApp!', 0.00, 80),
('Plano mensal corte', 'Pacote mensal de cortes, pensado para quem gosta de estar sempre alinhado com praticidade e economia. Consultar no nosso WhatsApp!', 0.00, 40),
('Progressiva Masculina', 'Alinhamento e redução de volume capilar.', 90.00, 100),
('Sobrancelha', 'Design e limpeza de sobrancelha.', 15.00, 10);

INSERT OR IGNORE INTO clientes (nome, telefone, email) VALUES
('Cliente Exemplo', '(11) 99999-9999', 'cliente@exemplo.com');

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

INSERT OR IGNORE INTO agendamento_servicos (agendamento_id, servico_id, preco_cobrado)
SELECT a.id, s.id, s.preco
FROM agendamentos a
JOIN clientes c ON c.id = a.cliente_id
CROSS JOIN servicos s
WHERE c.email = 'cliente@exemplo.com'
  AND a.data_hora = '2026-10-01 14:00:00'
  AND s.nome IN ('Corte', 'Barba');

INSERT OR IGNORE INTO horarios_funcionamento (dia_semana, horario_inicio, horario_fim) VALUES
('Segunda', '15:00', '20:20'),
('Terca',   '09:00', '21:40'),
('Quarta',  '09:00', '21:40'),
('Quinta',  '09:00', '21:40'),
('Sexta',   '09:00', '21:40'),
('Sabado',  '09:00', '20:20');
