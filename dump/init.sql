Create database ditech;
use ditech;
CREATE TABLE `Usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomeUsuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
); 
CREATE TABLE `Salas` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `numero` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `Horario` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `hr_ini` Time NOT NULL,
  `hr_fim` Time  NOT NULL,
  PRIMARY KEY (`id`)
);
CREATE TABLE `Reserva` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `sala_id` INTEGER NOT NULL,
  `hr_ini` time NOT NULL,
  `hr_id` Integer NOT NULL,
  PRIMARY KEY (`id`)
);
/*Adiciona chaves estrangeiras na tabela Reserva de relacionamento com as tabelas Usuário e Salas.*/
ALTER TABLE `Reserva` ADD FOREIGN KEY (usuario_id) REFERENCES `Usuario` (`id`);
ALTER TABLE `Reserva` ADD FOREIGN KEY (sala_id) REFERENCES `Salas` (`id`);
ALTER TABLE `Reserva` ADD FOREIGN KEY (hr_id) REFERENCES `Horario` (`id`);
/*Nova coluna para chave estrageira horario*/
ALTER TABLE `Reserva` ADD hr_id Integer;
/*Formata dados do banco para utf8*/
ALTER TABLE `Salas` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `Usuario` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `Reserva` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `Horario` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


/* Insere Horarios */
INSERT INTO `Horario` (`hr_ini`,`hr_fim`) VALUES ('08:00','09:00');
INSERT INTO `Horario` (`hr_ini`,`hr_fim`) VALUES ('09:00','10:00');
INSERT INTO `Horario` (`hr_ini`,`hr_fim`) VALUES ('10:00','11:00');
INSERT INTO `Horario` (`hr_ini`,`hr_fim`) VALUES ('11:00','12:00');
INSERT INTO `Horario` (`hr_ini`,`hr_fim`) VALUES ('13:00','14:00');