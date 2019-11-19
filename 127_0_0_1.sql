-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Nov-2019 às 01:14
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `senai`
--
DROP DATABASE IF EXISTS `senai`;
CREATE DATABASE IF NOT EXISTS `senai` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `senai`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(10) UNSIGNED NOT NULL,
  `nomeCompleto` varchar(100) NOT NULL,
  `nomeDoUsuario` varchar(45) NOT NULL,
  `emailUsuario` varchar(45) NOT NULL,
  `senhaDoUsuario` char(40) NOT NULL,
  `dataCriado` date NOT NULL,
  `foto` varchar(200) NOT NULL,
  `token` char(10) NOT NULL,
  `tempoDeVida` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nomeCompleto`, `nomeDoUsuario`, `emailUsuario`, `senhaDoUsuario`, `dataCriado`, `foto`, `token`, `tempoDeVida`) VALUES
(1, 'gabriele puhler', 'gabipuhler', 'gabipuhler@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-11-19', 'https://imagens.canaltech.com.br/236607.471195-Lua.jpg', '', '2019-11-19 03:07:56'),
(2, 'isa colorida', 'isabele', 'isabele@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-11-19', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTByZwodZF9MGD-ReoJVGAVOhk_8Bi6aZlHL8lWKoV8Y2YgCbbf&amp;s', '', '2019-11-19 03:07:56'),
(3, 'Gabriele Puhler', 'gabiip', 'gabiipuhler@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-11-19', 'https://i.pinimg.com/originals/5c/43/ef/5c43efca5236b15654e24f0666330d96.jpg', '', '2019-11-19 03:07:56'),
(4, 'alanaa', 'alana08', 'alana08@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-11-19', 'https://gartic.com.br/imgs/mural/if/ifinni_/lindinha-p-minha-lindinha.png', '', '2019-11-19 03:09:22');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `nomeDoUsuario` (`nomeDoUsuario`),
  ADD UNIQUE KEY `emailUsuario` (`emailUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
