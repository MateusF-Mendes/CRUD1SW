-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/06/2025 às 05:36
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `brinquedos`
--

CREATE TABLE `brinquedos` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `marca` varchar(40) NOT NULL,
  `faixaetaria` int(11) NOT NULL,
  `datacad` datetime NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `brinquedos`
--

INSERT INTO `brinquedos` (`id`, `codigo`, `modelo`, `marca`, `faixaetaria`, `datacad`, `foto`, `descricao`) VALUES
(8, 1, 'buzz lightyear', 'Estrela', 3, '2025-06-17 00:00:00', '6855e2d2a9528_Imagem_do_WhatsApp_de_2025_06_20____s__18.02.08_3b758eb1.jpg', '.'),
(9, 2, 'optimus prime', 'Estrela', 12, '2025-06-18 00:00:00', '6855e75b56aa7_Imagem_do_WhatsApp_de_2025_06_20____s__18.03.03_140ee7d8.jpg', NULL),
(10, 3, 'dinossauro rex', 'Estrela', 3, '2025-06-20 19:59:00', '6855e7dc2ebfe_Imagem_do_WhatsApp_de_2025_06_20____s__18.04.54_17b78f2b.jpg', 'nada'),
(11, 4, 'hot wheels batman', 'Estrela', 3, '2025-06-20 20:00:00', '6855e7f2aed7d_Imagem_do_WhatsApp_de_2025_06_20____s__18.07.28_33663dab.jpg', '2'),
(13, 5, 'Sonic', 'Estrela', 3, '2025-06-20 20:04:26', '6855e8fa8840a_Imagem_do_WhatsApp_de_2025_06_20____s__18.08.37_682b55a2.jpg', NULL),
(14, 6, 'Tails', 'Estrela', 3, '2025-06-20 20:04:46', '6855e90e42c30_Imagem_do_WhatsApp_de_2025_06_20____s__18.09.38_b1641118.jpg', NULL),
(15, 7, 'Yoshi', 'Estrela', 3, '2025-06-20 20:05:00', 'Imagem do WhatsApp de 2025-06-20 à(s) 18.13.23_256cca71.jpg', '.');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `brinquedos`
--
ALTER TABLE `brinquedos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `brinquedos`
--
ALTER TABLE `brinquedos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
