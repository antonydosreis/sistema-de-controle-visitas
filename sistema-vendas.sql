-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Mar-2021 às 21:25
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema-vendas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clients`
--

INSERT INTO `clients` (`id`, `name`, `city`, `address`, `phone`, `contact`) VALUES
(2, 'Mercado Vitoria', 'Estancia Velha', '', '(51) 35711611', 'Elemar'),
(4, 'Peixaria Varisa', 'Ivoti', '', '', 'Nilso'),
(5, 'Auto Eletrica Isidoro', 'Ivoti', '', '(51) 35631819', 'Gabriel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pages`
--

INSERT INTO `pages` (`id`, `name`) VALUES
(2, 'Normal'),
(3, 'Politica / Eleições'),
(4, 'Guia Santa Maria do Herval');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `seller_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `seller_number`) VALUES
(1, 'Giovane Kohls', '861'),
(3, 'Jaqueline Nunes', '213'),
(4, 'Eliseu', '238'),
(5, 'Geraldo Heymann', '6');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `user`, `password`, `level`) VALUES
(1, 'Marcelo Anschau', 'marcelo', '$2y$10$ASVCd0dXhiHlgetI9pYTgOGQBIp.631ZVC0HcH5d3YMDLAB9Qtccu', 3),
(2, 'Antony dos Reis', 'antony', '$2y$10$u9QOaeI4HLHfZQnHAhps/ucOb7oGVeo9bPjHH3zXR3kLqY9bbNNdC', 3),
(4, 'Lucas dos Reis', 'lucas', '$2y$10$/Im9HnHSBYUtLfSTzhF6GuEcFSTpUmADRTg0yI1hghlMT.cr2iYnm', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `client` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `page` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `result` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `visits`
--

INSERT INTO `visits` (`id`, `date`, `seller`, `client`, `contact`, `page`, `type`, `phone`, `result`) VALUES
(6, '2021-03-24', 'Giovane Kohls', 'Mercado Vitoria', 'Elemar', 'Normal', 'Telefone', '(51) 35711611', 'Sim'),
(7, '2021-03-23', 'Jaqueline Nunes', 'Peixaria Varisa', 'Nilso', 'Politica / Eleições', 'Pessoalmente', '', 'Não'),
(8, '2021-03-21', 'Eliseu', 'Auto Eletrica Isidoro', 'Gabriel', 'Guia Santa Maria do Herval', 'Pessoalmente', '(51) 35631819', 'Nova visita'),
(9, '2021-03-20', 'Jaqueline Nunes', 'Mercado Vitoria', 'Elemar', 'Guia Santa Maria do Herval', 'Pessoalmente', '(51) 35711611', 'Nova visita');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
