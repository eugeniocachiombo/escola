

CREATE database escola;

use escola;

CREATE TABLE `aluno` (
  `id_aluno` int primary key AUTO_INCREMENT NOT NULL,
  `nome_aluno` varchar(50) DEFAULT NULL,
  `senha_aluno` varchar(50) DEFAULT NULL,
  `idade_aluno` int(11) DEFAULT NULL,
  `morada_aluno` varchar(50) DEFAULT NULL,
  `genero_aluno` enum('M', 'F')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `professor` (
  `id_prof` int primary key AUTO_INCREMENT NOT NULL,
  `nome_prof` varchar(50) DEFAULT NULL,
  `senha_prof` varchar(50) DEFAULT NULL,
  `idade_prof` int(11) DEFAULT NULL,
  `morada_prof` varchar(50) DEFAULT NULL,
  `genero_prof` enum('M', 'F')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `disciplina` (
  `id_disc` int primary key AUTO_INCREMENT NOT NULL,
  `nome_disc` varchar(50) DEFAULT NULL,
  `id_prof` int(11) NOT NULL,
  FOREIGN key (id_prof) REFERENCES professor(id_prof) on delete CASCADE 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `marcar_prova` (
  `id_marcar_prova` int primary key AUTO_INCREMENT NOT NULL,
  `id_aluno` INT NOT NULL,
  `id_disc` INT NOT NULL,
  `id_prof` INT NOT NULL,
  FOREIGN key (id_aluno) REFERENCES aluno(id_aluno) on delete CASCADE,
  FOREIGN key (id_disc) REFERENCES disciplina(id_disc) on delete CASCADE,
  FOREIGN key (id_prof) REFERENCES professor(id_prof) on delete CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `media` (
  `id_media` int primary key AUTO_INCREMENT NOT NULL,
  `id_aluno` INT NOT NULL,
  `mediaAluno` varchar(50) DEFAULT NULL,
  FOREIGN key (id_aluno) REFERENCES aluno(id_aluno) on delete CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pauta` (
  `id_pauta` int primary key AUTO_INCREMENT NOT NULL,
  `id_aluno` INT NOT NULL,
  `id_disc` INT NOT NULL,
  `nota` DECIMAL(4,2)  DEFAULT NULL,
  FOREIGN key (id_aluno) REFERENCES aluno(id_aluno) on delete CASCADE,
  FOREIGN key (id_disc) REFERENCES disciplina(id_disc) on delete CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



