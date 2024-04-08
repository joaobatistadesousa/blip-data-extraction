-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/04/2024 às 21:17
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
-- Banco de dados: `extracao_dados`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `event_details`
--

CREATE TABLE `event_details` (
  `id` int(11) NOT NULL,
  `botKey` varchar(100) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `storageDate` datetime DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `received_messages`
--

CREATE TABLE `received_messages` (
  `id` int(11) NOT NULL,
  `botKey` varchar(100) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `received_messages`
--

INSERT INTO `received_messages` (`id`, `botKey`, `start_date`, `end_date`, `count`) VALUES
(1, 'Key dHVyYm9uZXRtaW5hc3JvdXRlcjpsTFRSeXoxNTllYklGVmVueHk3Ug==', '2024-04-04 02:00:00', '2024-04-05 02:00:00', 976),
(2, 'Key dHVyYm9uZXRtaW5hc3JvdXRlcjpsTFRSeXoxNTllYklGVmVueHk3Ug==', '2024-04-05 02:00:00', '2024-04-06 02:00:00', 1072),
(3, 'Key dHVyYm9uZXRtaW5hc3JvdXRlcjpsTFRSeXoxNTllYklGVmVueHk3Ug==', '2024-04-06 02:00:00', '2024-04-07 02:00:00', 618),
(4, 'Key dHVyYm9uZXRtaW5hc3JvdXRlcjpsTFRSeXoxNTllYklGVmVueHk3Ug==', '2024-04-07 02:00:00', '2024-04-08 02:00:00', 340),
(5, 'Key dHVyYm9uZXRtaW5hc3JvdXRlcjpsTFRSeXoxNTllYklGVmVueHk3Ug==', '2024-04-08 02:00:00', '2024-04-09 02:00:00', 323);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sentmessage`
--

CREATE TABLE `sentmessage` (
  `id` int(11) NOT NULL,
  `botKey` varchar(100) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sentmessage`
--

INSERT INTO `sentmessage` (`id`, `botKey`, `start_date`, `end_date`, `count`) VALUES
(1, 'Key dHVyYm9uZXRtaW5hc3JvdXRlcjpsTFRSeXoxNTllYklGVmVueHk3Ug==', '2024-04-04 02:00:00', '2024-04-05 02:00:00', 1396),
(2, 'Key dHVyYm9uZXRtaW5hc3JvdXRlcjpsTFRSeXoxNTllYklGVmVueHk3Ug==', '2024-04-05 02:00:00', '2024-04-06 02:00:00', 1643),
(3, 'Key dHVyYm9uZXRtaW5hc3JvdXRlcjpsTFRSeXoxNTllYklGVmVueHk3Ug==', '2024-04-06 02:00:00', '2024-04-07 02:00:00', 832),
(4, 'Key dHVyYm9uZXRtaW5hc3JvdXRlcjpsTFRSeXoxNTllYklGVmVueHk3Ug==', '2024-04-07 02:00:00', '2024-04-08 02:00:00', 432),
(5, 'Key dHVyYm9uZXRtaW5hc3JvdXRlcjpsTFRSeXoxNTllYklGVmVueHk3Ug==', '2024-04-08 02:00:00', '2024-04-09 02:00:00', 394);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `event_details`
--
ALTER TABLE `event_details`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `received_messages`
--
ALTER TABLE `received_messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sentmessage`
--
ALTER TABLE `sentmessage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `event_details`
--
ALTER TABLE `event_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `received_messages`
--
ALTER TABLE `received_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `sentmessage`
--
ALTER TABLE `sentmessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
