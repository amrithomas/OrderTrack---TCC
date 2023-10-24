-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/10/2023 às 21:50
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `order_tech`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE `administrador` (
  `ID_ADM` int(5) NOT NULL,
  `NOME_ADM` varchar(100) DEFAULT NULL,
  `SOBRENOME_ADM` varchar(150) DEFAULT NULL,
  `USUARIO_ADM` varchar(200) DEFAULT NULL,
  `SENHA_ADM` varchar(200) DEFAULT NULL,
  `IMAGEM_ADM` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alteracao_ordem`
--

CREATE TABLE `alteracao_ordem` (
  `ID_AO` int(5) NOT NULL,
  `DATA_ALTERACAO` datetime DEFAULT NULL,
  `CAMPO_ALTERACAO` enum('SERVICO','ITEM','LOCALIZACAO','PRAZO','PRIORIDADE','STATUS','NUMERO_OS','FOTO') DEFAULT NULL,
  `ALTERACAO` varchar(300) DEFAULT NULL,
  `FK_ORDEM` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `ID_FUNCIONARIO` int(5) NOT NULL,
  `NOME_FUNCIONARIO` varchar(100) DEFAULT NULL,
  `SOBRENOME_FUNCIONARIO` varchar(200) DEFAULT NULL,
  `USUARIO_FUNCIONARIO` varchar(200) DEFAULT NULL,
  `SENHA_FUNCIONARIO` varchar(250) DEFAULT NULL,
  `IMAGEM_FUNCIONARIO` varchar(400) DEFAULT NULL,
  `STATUS_FUNCIONARIO` enum('ATIVO','INATIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`ID_FUNCIONARIO`, `NOME_FUNCIONARIO`, `SOBRENOME_FUNCIONARIO`, `USUARIO_FUNCIONARIO`, `SENHA_FUNCIONARIO`, `IMAGEM_FUNCIONARIO`, `STATUS_FUNCIONARIO`) VALUES
(1, 'biel', '', 'biel', '$2y$10$/z8v8nrx/IrUlG/wndOuWOvj/zmmA75p.vdlr9hrXfmMTLjNgLp5a', 'img/64de817c66a81.png', 'ATIVO'),
(2, 'teu pai', '', '', '$2y$10$k.fDd0V0DoIIpsoodUG8yeLZo/4nQuV0Cp0QuLNevn1FNE.0I/0/S', '', 'ATIVO'),
(3, 'ed', '', '', '$2y$10$GTVl9MN774wDWyNJFXK.QuqAKDmo1j9sWii6XsVk3t.l2OkfUeQGK', '', 'ATIVO'),
(4, 'ad', '', '', '$2y$10$J.cMebfYtAs2DDlnkB/U9O.g3qF4ddhb4rUap06MoKf3wV/xGE2Km', '../../../assets/images/test.php', 'ATIVO'),
(5, 'add', '', '', '$2y$10$WZBTnlnQOJeFbktCzj0NnuOGknY1WIyCbWLEZaavHCEYai/wqkzJe', '../assets/images/test.png', 'ATIVO'),
(6, 'adddd', '', '', '$2y$10$VBBsmxhXYpExAqrQciBCruCiK72zI0y.QJ2Vl82EH.KXbdZosGMC.', '../../../assets/images/foto_cadastro/6504a67dbddd6.jpg', 'ATIVO'),
(7, 'addddd', '', '', '$2y$10$mw2Kp1s0p3WAEQAkjk65/.P8Cl2ZHCMbQ9rYSBlUVQ.LbwIWrwSKy', '../../assets/images/foto_cadastro/6504a69735da9.jpg', 'ATIVO'),
(8, 'Ronaldo', '', '', '$2y$10$06QETN8yORjaIbpKUBIl1eJlj8QlKkS6rwChq1P58jh3JNO9kslXm', '../../assets/images/foto_cadastro/6504ace1c829b.jpg', 'ATIVO'),
(9, 'Carlin', '', '', '$2y$10$bSy/UThLC5lW/r85aI9fPeSqepHU5fe/72rlExyj7dVpfNC98Hnza', '../../assets/images/foto_cadastro/6504ad350c741.jpg', 'ATIVO'),
(10, 'KAKA', '', '', '$2y$10$CoH6rC9xj8hiY5K6hX0vSuEKXivpQFUVJWzcRBqJ5.5whiVD7IChy', '../../assets/images/foto_cadastro/6504ad62b1d81.jpg', 'ATIVO'),
(11, 'TESTE', '', '', '$2y$10$7pAE3c2IEbPGMLx1Fd9Hke/OGHAMzveOjTCifCn2dOgeWIlJeOXwu', '../../assets/images/foto_cadastro/6504b7aaa296e.jpg', 'ATIVO'),
(12, 'admin', '', NULL, '$2y$10$.qZe9jSmZ.CfCu9vOq9h7.7cxL.lRyUeJygckLoaUg6UHzkKh9XWK', '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0t\0\0R\0\0\0????\0\0\0gAMA\0\0???a\0\0\0sRGB\0???\0\0\0PLTEGpL\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0?\0\0\0\0\0\0\0\0\0', 'ATIVO'),
(13, 'admin', '', NULL, '$2y$10$BaIZJuc3mHdnaUS0gkXRoO0Z3gR/k21ZHMRgdgTpMz5bR.qh6JsqS', '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0h\0\0h\0\0\0??I\0\0 \0IDATx???i?$Yv????FD??o??^9ӳp??9??` d\Z??\0?\n?i[?e\"P???!????	??i?MY2\r?i??????3??^o?5\"?=?????x?^U?t???:?Ftf??Q@???EQn???????????6NOo?ݻG????χ(?I??&{ߡW^~????Cϱ????A>???w?EQ?7ɮ@Q??w??O??zȋ1?<9??o??w?pz2F^8?iī????#?G?t|????ө??\0~@$??-??(?h???(tvJ0?!ˆ(???????????[?????uŹ?d?@??&??z?.?????PEy??@S?F???0?R?l??8????_', 'ATIVO'),
(14, NULL, '', 'admin', '$2y$10$B6PVIPoxG1TwLAR9FESQlu.4yVhytKvzjUhTZwkdXzLzqO1YkIux2', '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0h\0\0h\0\0\0??I\0\0 \0IDATx???i?$Yv????FD??o??^9ӳp??9??` d\Z??\0?\n?i[?e\"P???!????	??i?MY2\r?i??????3??^o?5\"?=?????x?^U?t???:?Ftf??Q@???EQn???????????6NOo?ݻG????χ(?I??&{ߡW^~????Cϱ????A>???w?EQ?7ɮ@Q??w??O??zȋ1?<9??o??w?pz2F^8?iī????#?G?t|????ө??\0~@$??-??(?h???(tvJ0?!ˆ(???????????[?????uŹ?d?@??&??z?.?????PEy??@S?F???0?R?l??8????_', 'ATIVO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_ordem`
--

CREATE TABLE `historico_ordem` (
  `ID_HISTORICO` int(5) NOT NULL,
  `DATA_FINALIZACAO` datetime DEFAULT NULL,
  `TEMPO_ATENDIMENTO` datetime DEFAULT NULL,
  `NOTAS` varchar(500) DEFAULT NULL,
  `DATA_EXECUCAO` datetime DEFAULT NULL,
  `FK_ORDEM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `historico_ordem`
--

INSERT INTO `historico_ordem` (`ID_HISTORICO`, `DATA_FINALIZACAO`, `TEMPO_ATENDIMENTO`, `NOTAS`, `DATA_EXECUCAO`, `FK_ORDEM`) VALUES
(6, NULL, NULL, NULL, '2023-08-18 14:21:28', 6),
(7, '2023-08-18 14:23:53', NULL, NULL, '2023-08-18 14:23:03', 4),
(8, NULL, NULL, NULL, '2023-08-18 14:22:23', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ordem`
--

CREATE TABLE `ordem` (
  `ID_ORDEM` int(5) NOT NULL,
  `SERVICO` varchar(200) DEFAULT NULL,
  `ITEM` varchar(200) DEFAULT NULL,
  `LOCALIZACAO` varchar(200) DEFAULT NULL,
  `PRAZO` datetime DEFAULT NULL,
  `PRIORIDADE` varchar(200) DEFAULT NULL,
  `STATUS` enum('PENDENTE','EM ANDAMENTO','CONCLUIDO','CANCELADO') DEFAULT NULL,
  `NUMERO_OS` varchar(10) DEFAULT NULL,
  `FOTO` varchar(400) DEFAULT NULL,
  `CRIADO` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ordem`
--

INSERT INTO `ordem` (`ID_ORDEM`, `SERVICO`, `ITEM`, `LOCALIZACAO`, `PRAZO`, `PRIORIDADE`, `STATUS`, `NUMERO_OS`, `FOTO`, `CRIADO`) VALUES
(4, 'BIEL', 'BIEL', 'BIEL', '2023-08-17 00:00:00', 'BAIXA', 'CONCLUIDO', NULL, 'img/64de829a5246b.png', NULL),
(5, '213213', '23213', '2321', '2023-08-19 00:00:00', 'BAIXA', 'EM ANDAMENTO', NULL, 'img/64de82d5127d8.png', NULL),
(6, 'carro', 'carro', 'veio', '2023-08-19 00:00:00', 'BAIXA', 'EM ANDAMENTO', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rel`
--

CREATE TABLE `rel` (
  `ID_REL` int(5) NOT NULL,
  `FK_FUNCIONARIO` int(5) DEFAULT NULL,
  `FK_ORDEM` int(5) DEFAULT NULL,
  `FK_HISTORICO` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `rel`
--

INSERT INTO `rel` (`ID_REL`, `FK_FUNCIONARIO`, `FK_ORDEM`, `FK_HISTORICO`) VALUES
(4, 1, 4, NULL),
(5, 1, 5, NULL),
(6, 1, 6, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatorio_funcionarios`
--

CREATE TABLE `relatorio_funcionarios` (
  `ID_RELATORIO` int(5) NOT NULL,
  `FK_FUNCIONARIO` int(5) DEFAULT NULL,
  `DATA_ATUALIZACAO` datetime DEFAULT NULL,
  `ORDENS_ATENDIDAS` int(5) DEFAULT NULL,
  `ORDENS_ABERTAS` int(5) DEFAULT NULL,
  `ORDENS_CONCLUIDA` varchar(10) DEFAULT NULL,
  `ORDENS_CANCELADAS` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ID_ADM`);

--
-- Índices de tabela `alteracao_ordem`
--
ALTER TABLE `alteracao_ordem`
  ADD PRIMARY KEY (`ID_AO`),
  ADD KEY `FK_ORDEM` (`FK_ORDEM`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`ID_FUNCIONARIO`);

--
-- Índices de tabela `historico_ordem`
--
ALTER TABLE `historico_ordem`
  ADD PRIMARY KEY (`ID_HISTORICO`);

--
-- Índices de tabela `ordem`
--
ALTER TABLE `ordem`
  ADD PRIMARY KEY (`ID_ORDEM`);

--
-- Índices de tabela `rel`
--
ALTER TABLE `rel`
  ADD PRIMARY KEY (`ID_REL`),
  ADD KEY `FK_FUNCIONARIO` (`FK_FUNCIONARIO`),
  ADD KEY `FK_ORDEM` (`FK_ORDEM`),
  ADD KEY `FK_HISTORICO` (`FK_HISTORICO`);

--
-- Índices de tabela `relatorio_funcionarios`
--
ALTER TABLE `relatorio_funcionarios`
  ADD PRIMARY KEY (`ID_RELATORIO`),
  ADD KEY `FK_FUNCIONARIO` (`FK_FUNCIONARIO`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `ID_ADM` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `alteracao_ordem`
--
ALTER TABLE `alteracao_ordem`
  MODIFY `ID_AO` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `ID_FUNCIONARIO` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `historico_ordem`
--
ALTER TABLE `historico_ordem`
  MODIFY `ID_HISTORICO` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `ordem`
--
ALTER TABLE `ordem`
  MODIFY `ID_ORDEM` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `rel`
--
ALTER TABLE `rel`
  MODIFY `ID_REL` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `relatorio_funcionarios`
--
ALTER TABLE `relatorio_funcionarios`
  MODIFY `ID_RELATORIO` int(5) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `alteracao_ordem`
--
ALTER TABLE `alteracao_ordem`
  ADD CONSTRAINT `alteracao_ordem_ibfk_1` FOREIGN KEY (`FK_ORDEM`) REFERENCES `ordem` (`ID_ORDEM`);

--
-- Restrições para tabelas `rel`
--
ALTER TABLE `rel`
  ADD CONSTRAINT `rel_ibfk_1` FOREIGN KEY (`FK_FUNCIONARIO`) REFERENCES `funcionarios` (`ID_FUNCIONARIO`),
  ADD CONSTRAINT `rel_ibfk_2` FOREIGN KEY (`FK_ORDEM`) REFERENCES `ordem` (`ID_ORDEM`),
  ADD CONSTRAINT `rel_ibfk_3` FOREIGN KEY (`FK_HISTORICO`) REFERENCES `historico_ordem` (`ID_HISTORICO`);

--
-- Restrições para tabelas `relatorio_funcionarios`
--
ALTER TABLE `relatorio_funcionarios`
  ADD CONSTRAINT `relatorio_funcionarios_ibfk_1` FOREIGN KEY (`FK_FUNCIONARIO`) REFERENCES `funcionarios` (`ID_FUNCIONARIO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
