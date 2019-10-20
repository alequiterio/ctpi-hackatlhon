-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Jul-2019 às 05:35
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_stp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `caminhao`
--

CREATE TABLE `caminhao` (
  `id_caminhao` int(11) NOT NULL,
  `placa` varchar(8) NOT NULL,
  `motorista` varchar(30) NOT NULL,
  `empresa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `container`
--

CREATE TABLE `container` (
  `id_container` int(11) NOT NULL,
  `matricula_container` varchar(10) NOT NULL,
  `localizacao` varchar(3) NOT NULL,
  `origem` varchar(30) NOT NULL,
  `destino` varchar(30) NOT NULL,
  `dth_entrada` datetime NOT NULL,
  `dth_saida` datetime DEFAULT NULL,
  `status_container` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `container`
--

INSERT INTO `container` (`id_container`, `matricula_container`, `localizacao`, `origem`, `destino`, `dth_entrada`, `dth_saida`, `status_container`) VALUES
(20, 'lucas123', 'a12', 'abc1234', 'abc1243', '2019-07-01 14:17:03', '2019-07-01 14:18:33', 'Carregado'),
(21, 'axx', 'a13', 'abc1234', 'abc1234', '2019-07-01 14:17:45', '2019-07-01 14:19:00', 'Carregado'),
(22, 'aaa1234567', 'a11', 'abc1235', 'abc1234', '2019-07-01 22:42:26', '0000-00-00 00:00:00', 'Armazenado'),
(23, 'abc', 'acc', 'abc1235', 'abc', '2019-07-01 22:44:23', '0000-00-00 00:00:00', 'Armazenado'),
(24, 'ABC741852', 'A12', 'acb1547', 'acb1547', '2019-07-01 23:18:48', '0000-00-00 00:00:00', 'Armazenado'),
(25, 'ABC1324567', 'G33', 'IUF9596', 'IUF9596', '2019-07-01 23:26:59', '2019-07-01 23:27:14', 'Carregado'),
(26, 'ABC454545', 'G33', 'IUF9596', 'ABC132456', '2019-07-01 23:28:12', '0000-00-00 00:00:00', 'Armazenado'),
(27, 'abc1548789', 'A12', 'III1234', 'III1234', '2019-07-02 00:28:29', '2019-07-02 00:29:02', 'Carregado'),
(28, 'abc1234', 'ab3', '', 'ABC1234567', '2019-07-02 00:29:40', '2019-07-02 00:29:52', 'Carregado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `navio`
--

CREATE TABLE `navio` (
  `id_navio` int(11) NOT NULL,
  `matricula` varchar(15) NOT NULL,
  `capitao` varchar(30) NOT NULL,
  `empresa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_user`
--

CREATE TABLE `tipo_user` (
  `id_tipo` tinyint(1) NOT NULL,
  `nome_tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_user`
--

INSERT INTO `tipo_user` (`id_tipo`, `nome_tipo`) VALUES
(1, 'Transportadora'),
(2, 'Operador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `tipo_user` tinyint(1) DEFAULT NULL,
  `empresa` varchar(30) NOT NULL,
  `telefone` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `senha`, `tipo_user`, `empresa`, `telefone`) VALUES
(1, 'operador@seaport.com', '123', 2, 'Santos Brasil Connect', 51999887766),
(2, 'abc@abc.com', '123', 1, 'ABC', 51999776655),
(3, 'teste@teste.com', '123', 1, 'ismael', 51988765421),
(6, 'bruno@bianchini.com', '123456', 1, 'Bianchini Ltda', 123456789),
(7, 'moser@moser.com', 'moser', 1, 'Moser LTDA', 51999999999);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caminhao`
--
ALTER TABLE `caminhao`
  ADD PRIMARY KEY (`id_caminhao`);

--
-- Indexes for table `container`
--
ALTER TABLE `container`
  ADD PRIMARY KEY (`id_container`);

--
-- Indexes for table `navio`
--
ALTER TABLE `navio`
  ADD PRIMARY KEY (`id_navio`);

--
-- Indexes for table `tipo_user`
--
ALTER TABLE `tipo_user`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `tipo_user` (`tipo_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caminhao`
--
ALTER TABLE `caminhao`
  MODIFY `id_caminhao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `container`
--
ALTER TABLE `container`
  MODIFY `id_container` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `navio`
--
ALTER TABLE `navio`
  MODIFY `id_navio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipo_user`) REFERENCES `tipo_user` (`id_tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
