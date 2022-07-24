-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Tempo de geração: 24/07/2022 às 04:28
-- Versão do servidor: 8.0.29
-- Versão do PHP: 8.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trabfinal`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `candidates`
--

CREATE TABLE `candidates` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `party` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `vice` json NOT NULL,
  `stage_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `party`, `image`, `vice`, `stage_id`) VALUES
(12, 'Chiquinho do Adbon', 'PDT', 'cp3.jpg', '{\"foto\": \"v3.jpg\", \"nome\": \"Arão\", \"partido\": \"PRP\"}', 1),
(15, 'Malrinete Gralhada', 'MDB', 'cp2.jpg', '{\"foto\": \"v2.jpg\", \"nome\": \"Biga\", \"partido\": \"MDB\"}', 1),
(45, 'Dr. Francisco', 'PSC', 'cp1.jpg', '{\"foto\": \"v1.jpg\", \"nome\": \"João Rodrigues\", \"partido\": \"PV\"}', 1),
(54, 'Zé Lopes', 'PPL', 'cp4.jpg', '{\"foto\": \"v4.jpg\", \"nome\": \"Francisca Ferreira Ramos\", \"partido\": \"PPL\"}', 1),
(65, 'Lindomar Pescador', 'PC do B', 'cp5.jpg', '{\"foto\": \"v5.jpg\", \"nome\": \"Malú\", \"partido\": \"PC do B\"}', 1),
(15123, 'Filho', 'MDB', 'cv4.jpg', 'null', 0),
(27222, 'Joel Varão', 'PSDC', 'cv5.jpg', 'null', 0),
(43333, 'Dandor', 'PV', 'cv3.jpg', 'null', 0),
(45000, 'Professor Clebson Almeida', 'PSDB', 'cv6.jpg', 'null', 0),
(51222, 'Christianne Varão', 'PEN', 'cv1.jpg', 'null', 0),
(55555, 'Homero do Zé Filho', 'PSL', 'cv2.jpg', 'null', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `stages`
--

CREATE TABLE `stages` (
  `id` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `numbers_length` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `stages`
--

INSERT INTO `stages` (`id`, `title`, `numbers_length`) VALUES
(0, 'vereador', 5),
(1, 'prefeito', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stage` (`stage_id`);

--
-- Índices de tabela `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `stage` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
