-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Data de geração: 25/06/2025
-- Servidor: 10.4.32-MariaDB
-- PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

-- Banco de dados: `banco`
CREATE DATABASE IF NOT EXISTS `banco` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `banco`;

-- Estrutura da tabela `brinquedos`
DROP TABLE IF EXISTS `brinquedos`;
CREATE TABLE `brinquedos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `marca` varchar(40) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `faixaetaria` int(11) NOT NULL,
  `datacad` datetime NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dados da tabela `brinquedos`
INSERT INTO `brinquedos` (`id`, `codigo`, `modelo`, `marca`, `descricao`, `valor`, `faixaetaria`, `datacad`, `foto`) VALUES
(8, 1, 'buzz lightyear', 'Estrela', '.', 0.00, 3, '2025-06-17 00:00:00', '6855e2d2a9528_Imagem_do_WhatsApp_de_2025_06_20____s__18.02.08_3b758eb1.jpg'),
(9, 2, 'optimus prime', 'Estrela', NULL, 0.00, 12, '2025-06-18 00:00:00', '6855e75b56aa7_Imagem_do_WhatsApp_de_2025_06_20____s__18.03.03_140ee7d8.jpg'),
(10, 3, 'dinossauro rex', 'Estrela', 'nada', 0.00, 3, '2025-06-20 19:59:00', '6855e7dc2ebfe_Imagem_do_WhatsApp_de_2025_06_20____s__18.04.54_17b78f2b.jpg'),
(11, 4, 'hot wheels batman', 'Estrela', '2', 0.00, 3, '2025-06-20 20:00:00', '6855e7f2aed7d_Imagem_do_WhatsApp_de_2025_06_20____s__18.07.28_33663dab.jpg'),
(13, 5, 'Sonic', 'Estrela', NULL, 0.00, 3, '2025-06-20 20:04:26', '6855e8fa8840a_Imagem_do_WhatsApp_de_2025_06_20____s__18.08.37_682b55a2.jpg'),
(14, 6, 'Tails', 'Estrela', NULL, 0.00, 3, '2025-06-20 20:04:46', '6855e90e42c30_Imagem_do_WhatsApp_de_2025_06_20____s__18.09.38_b1641118.jpg'),
(15, 7, 'Yoshi', 'Estrela', '.', 0.00, 3, '2025-06-20 20:05:00', 'Imagem do WhatsApp de 2025-06-20 à(s) 18.13.23_256cca71.jpg');

COMMIT;