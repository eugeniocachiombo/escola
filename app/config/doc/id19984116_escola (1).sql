

CREATE database escola;

use escola;

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `morada` varchar(50) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `aluno` (`id`, `nome`, `senha`, `idade`, `morada`, `genero`) VALUES
(1, 'Eugénio Cachiombo', '12', 23, 'Cazenga', 'Masculino'),
(3, 'Márcio Lima', '12', 23, 'Samba', 'Masculino'),
(6, 'Paulo Dias', '11', 23, 'Samba', 'Masculino'),
(7, 'Gp', '12', 23, 'Samba', 'Masculino'),
(8, 'John Bapts', '1507ba', 14, 'Cazenga', 'Masculino'),
(9, 'Jesus ', '12', 16, 'Cazenga', 'Masculino'),
(10, 'Capepe', 'Piter', 14, 'Cazenga', 'Femenino'),
(11, 'João Baptista', '12', 14, 'Cazenga', 'Masculino'),
(12, 'Génio Pró', '12', 20, 'Cazenga', 'Masculino'),
(13, 'Ade', '12', 14, 'Cazenga', 'Masculino'),
(14, 'Carlos', '12', 14, 'Cazenga', 'Masculino'),
(16, 'Joaquina Cachiombo', '12', 10, 'Cazenga', 'Femenino'),
(17, 'Paulo Buety', '12', 46, 'Huambo', 'Masculino'),
(18, 'Frederico Mario', '12', 24, 'Cazenga', 'Masculino'),
(19, 'Isaac Ndembi', '12', 29, 'Cazenga', 'Masculino'),
(20, 'Nanitela Pedro', '12', 29, 'Cazenga', 'Masculino'),
(21, 'Piter', '12', 29, 'Cazenga', 'Masculino'),
(22, 'Génio Pró', '12', 24, 'Cazenga', 'Masculino'),
(23, 'Capepe', '12', 10, 'Cazenga', 'Masculino'),
(24, 'Simão Lutumba', '12', 9, 'Cazenga', 'Masculino'),
(25, 'Mariza', '12', 27, 'Cazenga', 'Masculino'),
(26, 'Angélica', '12', 24, 'Cazenga', 'Masculino'),
(27, 'Tete', '12', 9, 'Cazenga', 'Masculino'),
(28, 'Jane', '12', 18, 'Cazenga', 'Femenino'),
(29, 'Frederico C. Livala', '12', 20, 'Cazenga', 'Masculino'),
(30, 'Frederico Cachiombo Livala', 'Luas', 21, 'Alfa 5', 'Masculino'),
(31, 'K3', '12', 25, 'Cazenga', 'Masculino');



CREATE TABLE `disciplina` (
  `id_disc` int(11) NOT NULL,
  `nomeDisc` varchar(50) DEFAULT NULL,
  `codprof` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `disciplina` (`id_disc`, `nomeDisc`, `codprof`) VALUES
(3, 'Informática', 1),
(4, 'Introdução à Programação', 2),
(5, 'Física', 3),
(6, 'Matemática', 4),
(7, 'Pastelaria', 5),
(8, 'Química', 6);



CREATE TABLE `marcarprova` (
  `idMarcarProva` int(11) NOT NULL,
  `nomeAluno` varchar(50) DEFAULT NULL,
  `nomeDisciplina` varchar(50) DEFAULT NULL,
  `nomeProfessor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `marcarprova` (`idMarcarProva`, `nomeAluno`, `nomeDisciplina`, `nomeProfessor`) VALUES
(206, 'Gp', 'Introdução à Programação', 'Nafêis Sebastião'),
(227, 'Eugénio Cachiombo', 'Informática', 'António Da Costa'),
(264, 'Nanitela Pedro', 'Química', 'Nanitela Pedro');



CREATE TABLE `media` (
  `idMedia` int(11) NOT NULL,
  `nomeAluno` varchar(50) DEFAULT NULL,
  `mediaAluno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `media` (`idMedia`, `nomeAluno`, `mediaAluno`) VALUES
(1, 'Eugénio Cachiombo', '16.333333333333'),
(3, 'Márcio Lima', '14.5'),
(7, 'Gp', '14.8'),
(8, 'John Bapts', '15.666666666667'),
(9, 'Jesus ', '8.8333333333333'),
(11, 'João Baptista', '16'),
(12, 'Génio Pró', '13.833333333333'),
(13, 'Ade', '15'),
(14, 'Carlos', '9.1666666666667'),
(16, 'Joaquina Cachiombo', '12.666666666667'),
(17, 'Paulo Buety', '3.4'),
(18, 'Frederico Mario', '13.833333333333'),
(19, 'Isaac Ndembi', '13.8'),
(20, 'Nanitela Pedro', '17.666666666667'),
(21, 'Piter', '16.333333333333'),
(23, 'Capepe', '10.333333333333'),
(24, 'Simão Lutumba', '13'),
(25, 'Mariza', '8.8333333333333'),
(26, 'Angélica', '10.5'),
(27, 'Tete', '8.8333333333333'),
(28, 'Jane', '15.833333333333'),
(29, 'Frederico C. Livala', '15.666666666667'),
(30, 'Frederico Cachiombo Livala', '16.5');



CREATE TABLE `pauta` (
  `idPauta` int(11) NOT NULL,
  `nomeAluno` varchar(50) DEFAULT NULL,
  `disciplina` varchar(50) DEFAULT NULL,
  `nota` float DEFAULT NULL,
  `cont` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `pauta` (`idPauta`, `nomeAluno`, `disciplina`, `nota`, `cont`) VALUES
(107, 'John Bapts', 'Informática', 16, 1),
(108, 'John Bapts', 'Introdução à Programação', 14, 1),
(109, 'John Bapts', 'Física', 16, 1),
(110, 'John Bapts', 'Matemática', 14, 1),
(111, 'John Bapts', 'Pastelaria', 18, 1),
(240, 'Gp', 'Física', 18, 1),
(241, 'Gp', 'Informática', 17, 1),
(242, 'Gp', 'Introdução à Programação', 16, 1),
(243, 'Gp', 'Pastelaria', 11, 1),
(244, 'Gp', 'Matemática', 12, 1),
(245, 'Eugénio Cachiombo', 'Informática', 15, 1),
(246, 'Eugénio Cachiombo', 'Introdução à Programação', 15, 1),
(247, 'Eugénio Cachiombo', 'Física', 19, 1),
(248, 'Eugénio Cachiombo', 'Matemática', 15, 1),
(249, 'Eugénio Cachiombo', 'Pastelaria', 17, 1),
(250, 'Márcio Lima', 'Informática', 14, 1),
(251, 'Márcio Lima', 'Introdução à Programação', 15, 1),
(252, 'Joaquina Cachiombo', 'Matemática', 18, 1),
(253, 'Joaquina Cachiombo', 'Introdução à Programação', 11, 1),
(254, 'Joaquina Cachiombo', 'Informática', 10, 1),
(255, 'Joaquina Cachiombo', 'Física', 14, 1),
(256, 'Joaquina Cachiombo', 'Pastelaria', 9, 1),
(257, 'Márcio Lima', 'Física', 17, 1),
(258, 'Márcio Lima', 'Matemática', 13, 1),
(259, 'Márcio Lima', 'Pastelaria', 15, 1),
(260, 'Carlos', 'Informática', 15, 1),
(261, 'Carlos', 'Introdução à Programação', 14, 1),
(262, 'Carlos', 'Física', 14, 1),
(263, 'Carlos', 'Matemática', 6, 1),
(264, 'Carlos', 'Pastelaria', 1, 1),
(265, 'Ade', 'Informática', 10, 1),
(266, 'Ade', 'Introdução à Programação', 20, 1),
(267, 'Ade', 'Física', 16, 1),
(268, 'Ade', 'Matemática', 20, 1),
(269, 'Ade', 'Pastelaria', 14, 1),
(270, 'Paulo Buety', 'Informática', 1, 1),
(271, 'Paulo Buety', 'Introdução à Programação', 2, 1),
(272, 'Paulo Buety', 'Física', 14, 1),
(273, 'Paulo Buety', 'Matemática', 0, 1),
(274, 'Paulo Buety', 'Pastelaria', 0, 1),
(275, 'Frederico Mario', 'Informática', 11, 1),
(276, 'Frederico Mario', 'Introdução à Programação', 18, 1),
(277, 'Frederico Mario', 'Física', 14, 1),
(278, 'Frederico Mario', 'Matemática', 15, 1),
(279, 'Frederico Mario', 'Pastelaria', 12, 1),
(280, 'Isaac Ndembi', 'Informática', 13, 1),
(281, 'Isaac Ndembi', 'Introdução à Programação', 12, 1),
(282, 'Isaac Ndembi', 'Física', 14, 1),
(283, 'Isaac Ndembi', 'Matemática', 13, 1),
(284, 'Isaac Ndembi', 'Pastelaria', 17, 1),
(285, 'Nanitela Pedro', 'Informática', 16, 1),
(286, 'Nanitela Pedro', 'Física', 15, 1),
(287, 'Nanitela Pedro', 'Introdução à Programação', 20, 1),
(288, NULL, 'Matemática', 15, 1),
(289, NULL, 'Pastelaria', 17, 1),
(290, 'Piter', 'Matemática', 19, 1),
(291, NULL, 'Física', 3, 1),
(292, 'Piter', 'Pastelaria', 15, 1),
(293, 'Piter', 'Informática', 17, 1),
(294, 'Piter', 'Introdução à Programação', 15, 1),
(295, 'Génio Pró', 'Introdução à Programação', 17, 1),
(296, 'Génio Pró', 'Informática', 14, 1),
(297, 'Génio Pró', 'Física', 18, 1),
(298, 'Génio Pró', 'Matemática', 10, 1),
(299, 'Génio Pró', 'Pastelaria', 13, 1),
(300, 'Nanitela Pedro', 'Química', 18, 1),
(301, 'Eugénio Cachiombo', 'Química', 17, 1),
(302, 'Génio Pró', 'Química', 11, 1),
(303, 'Piter', 'Química', 13, 1),
(304, 'John Bapts', 'Química', 16, 1),
(305, 'Joaquina Cachiombo', 'Química', 20, 1),
(306, 'Frederico Mario', 'Química', 13, 1),
(307, 'Ade', 'Química', 10, 1),
(308, 'Carlos', 'Química', 5, 1),
(309, 'Capepe', 'Matemática', 4, 1),
(310, 'Capepe', 'Física', 8, 1),
(311, 'Capepe', 'Química', 4, 1),
(312, 'Capepe', 'Informática', 17, 1),
(313, 'Capepe', 'Pastelaria', 9, 1),
(314, 'Capepe', 'Introdução à Programação', 20, 1),
(315, 'Nanitela Pedro', 'Pastelaria', 17, 1),
(316, NULL, 'Matemática', 4, 1),
(317, 'Nanitela Pedro', 'Matemática', 20, 1),
(318, 'Piter', 'Física', 19, 1),
(319, 'Márcio Lima', 'Química', 13, 1),
(320, 'João Baptista', 'Informática', 15, 1),
(321, 'João Baptista', 'Introdução à Programação', 18, 1),
(322, 'João Baptista', 'Física', 18, 1),
(323, 'João Baptista', 'Matemática', 16, 1),
(324, 'João Baptista', 'Pastelaria', 14, 1),
(325, 'João Baptista', 'Química', 15, 1),
(326, 'Simão Lutumba', 'Matemática', 19, 1),
(327, 'Simão Lutumba', 'Introdução à Programação', 6, 1),
(328, 'Simão Lutumba', 'Informática', 18, 1),
(329, 'Simão Lutumba', 'Pastelaria', 10, 1),
(330, 'Simão Lutumba', 'Química', 6, 1),
(331, 'Simão Lutumba', 'Física', 19, 1),
(332, 'Mariza', 'Informática', 2, 1),
(333, 'Mariza', 'Introdução à Programação', 19, 1),
(334, 'Mariza', 'Física', 9, 1),
(335, 'Mariza', 'Matemática', 10, 1),
(336, 'Mariza', 'Pastelaria', 11, 1),
(337, 'Mariza', 'Química', 2, 1),
(338, 'Jesus ', 'Informática', 8, 1),
(339, 'Jesus ', 'Introdução à Programação', 18, 1),
(340, 'Jesus ', 'Física', 0, 1),
(341, 'Jesus ', 'Matemática', 7, 1),
(342, 'Jesus ', 'Pastelaria', 19, 1),
(343, 'Jesus ', 'Química', 1, 1),
(344, 'Angélica', 'Informática', 2, 1),
(345, 'Angélica', 'Introdução à Programação', 20, 1),
(346, 'Angélica', 'Física', 20, 1),
(347, 'Angélica', 'Matemática', 2, 1),
(348, 'Angélica', 'Pastelaria', 8, 1),
(349, 'Angélica', 'Química', 11, 1),
(350, 'Tete', 'Informática', 9, 1),
(351, 'Tete', 'Introdução à Programação', 2, 1),
(352, 'Tete', 'Física', 2, 1),
(353, 'Tete', 'Matemática', 20, 1),
(354, 'Tete', 'Pastelaria', 9, 1),
(355, 'Tete', 'Química', 11, 1),
(356, 'Jane', 'Informática', 13, 1),
(357, 'Jane', 'Introdução à Programação', 17, 1),
(358, 'Jane', 'Física', 16, 1),
(359, 'Jane', 'Matemática', 17, 1),
(360, 'Jane', 'Pastelaria', 13, 1),
(361, 'Jane', 'Química', 19, 1),
(362, 'Frederico C. Livala', 'Informática', 18, 1),
(363, 'Frederico C. Livala', 'Introdução à Programação', 16, 1),
(364, 'Frederico C. Livala', 'Física', 14, 1),
(365, 'Frederico C. Livala', 'Matemática', 14, 1),
(366, 'Frederico C. Livala', 'Pastelaria', 14, 1),
(367, 'Frederico C. Livala', 'Química', 18, 1),
(368, 'Frederico Cachiombo Livala', 'Química', 20, 1),
(369, 'Frederico Cachiombo Livala', 'Informática', 18, 1),
(370, 'Frederico Cachiombo Livala', 'Física', 18, 1),
(371, 'Frederico Cachiombo Livala', 'Matemática', 14, 1),
(372, 'Frederico Cachiombo Livala', 'Introdução à Programação', 14, 1),
(373, 'Frederico Cachiombo Livala', 'Pastelaria', 15, 1);



CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `morada` varchar(50) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `professor` (`id`, `nome`, `senha`, `idade`, `morada`, `genero`) VALUES
(1, 'António Da Costa', 'aa', 24, 'a', 'Masculino'),
(2, 'Nafêis Sebastião', '12', 18, 'Cazenga', 'Masculino'),
(3, 'Jésar Domingos', 'as', 52, 'Rangel', 'Masculino'),
(4, 'Yemey', '12', 47, 'Samba', 'Masculino'),
(5, 'João Baptista', '212121', 20, 'Cazenga', 'Masculino'),
(6, 'Nanitela Pedro', '12', 29, 'Cazenga', 'Masculino');


ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disc`),
  ADD KEY `fk_disc_prof` (`codprof`);

ALTER TABLE `marcarprova`
  ADD PRIMARY KEY (`idMarcarProva`);

ALTER TABLE `media`
  ADD PRIMARY KEY (`idMedia`);

ALTER TABLE `pauta`
  ADD PRIMARY KEY (`idPauta`);

ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

ALTER TABLE `disciplina`
  MODIFY `id_disc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `marcarprova`
  MODIFY `idMarcarProva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

ALTER TABLE `pauta`
  MODIFY `idPauta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;

ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `disciplina`
  ADD CONSTRAINT `fk_disc_prof` FOREIGN KEY (`codprof`) REFERENCES `professor` (`id`);

ALTER TABLE `media`
  ADD CONSTRAINT `fk_media_aluno` FOREIGN KEY (`idMedia`) REFERENCES `aluno` (`id`);
COMMIT;

