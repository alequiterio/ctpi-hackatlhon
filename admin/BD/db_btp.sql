-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20-Abr-2019 às 18:16
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_btp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avisos`
--

CREATE TABLE `avisos` (
  `ID` int(11) NOT NULL,
  `AVISO` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DTAVISO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GRUPOAVISO` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `avisos`
--

INSERT INTO `avisos` (`ID`, `AVISO`, `DTAVISO`, `GRUPOAVISO`) VALUES
(1, 'MANUTENCAO HOJE', '07/04/2019', 'E'),
(2, 'interdicao do canal,sem Producao das 15:20', '08/04/2019', 'A'),
(3, 'ola', '10/10/10', 'E'),
(4, 'ola', '10/10/10', 'E'),
(5, 'ola', '10/10/10', 'E'),
(6, 'teste ', '2019-04-27', 'E'),
(7, 'ManutenÃ§Ã£o periÃ³dica no equipamento', '2019-04-19', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escala`
--

CREATE TABLE `escala` (
  `ID` int(11) NOT NULL,
  `grupo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `textColor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `escala`
--

INSERT INTO `escala` (`ID`, `grupo`, `title`, `description`, `color`, `textColor`, `start`, `end`) VALUES
(1, 'E', 'Pausado', '6X1', '#7f7f7f', '#FFFFFF', '2019-04-19 10:00:00', '2019-04-19 10:00:00'),
(2, 'E', 'Escala', '6X1', '#FF0000', '#FFFFFF', '2019-04-20 10:00:00', '2019-04-20 18:00:00'),
(3, 'E', 'Escala', '6X1', '#FF0000', '#FFFFFF', '2019-04-21 10:00:00', '2019-04-21 18:00:00'),
(4, 'E', 'Escala', '6X1', '#FF0000', '#FFFFFF', '2019-04-22 10:00:00', '2019-04-22 18:00:00'),
(5, 'E', 'Escala', '6X1', '#FF0000', '#FFFFFF', '2019-04-23 10:00:00', '2019-04-23 18:00:00'),
(6, 'E', 'Escala', '6X1', '#FF0000', '#FFFFFF', '2019-04-24 10:00:00', '2019-04-24 18:00:00'),
(7, 'A', 'Escala', '6X1', '#FF0000', '#FFFFFF', '2019-04-19 10:00:00', '2019-04-19 18:00:00'),
(8, 'A', 'Escala', '6X1', '#FF0000', '#FFFFFF', '2019-04-20 10:00:00', '2019-04-20 18:00:00'),
(9, 'A', 'Escala', '6X1', '#FF0000', '#FFFFFF', '2019-04-21 10:00:00', '2019-04-21 18:00:00'),
(10, 'A', 'Escala', '6X1', '#FF0000', '#FFFFFF', '2019-04-22 10:00:00', '2019-04-22 18:00:00'),
(11, 'A', 'Escala', '6X1', '#FF0000', '#FFFFFF', '2019-04-23 10:00:00', '2019-04-23 18:00:00'),
(12, 'A', 'Escala', '6X1', '#FF0000', '#FFFFFF', '2019-04-24 10:00:00', '2019-04-24 18:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exames`
--

CREATE TABLE `exames` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIPO_EXAME` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATA_RECICLA` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FUNCAO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `exames`
--

INSERT INTO `exames` (`ID`, `NOME`, `TIPO_EXAME`, `DATA_RECICLA`, `FUNCAO`) VALUES
(1, 'Audiometria', 'REGULARMENTE', '2 ANOS', 'TODOS'),
(2, 'Radiografias', 'REGULARMENTE', '2 ANOS', 'TODOS'),
(3, 'Espirometria', 'REGULARMENTE', '2 ANOS', 'TODOS'),
(4, 'Acuidade visual', 'REGULARMENTE', '2 ANOS', 'TODOS'),
(5, 'Eletrocardiograma', 'REGULARMENTE', '2 ANOS', 'TODOS'),
(6, 'Eletroencefalograma', 'REGULARMENTE', '2 ANOS', 'TODOS'),
(7, 'Exames laboratoriais', 'REGULARMENTE', '2 ANOS', 'TODOS'),
(8, 'psicotécnico', 'REGULARMENTE', '2 ANOS', 'TODOS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicoexame`
--

CREATE TABLE `historicoexame` (
  `ID` int(11) NOT NULL,
  `RG_FUNC` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NOME_EXAME` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATA_EXAME` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATA_RECICLA` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIPO_EXAME` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_exame` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `historicoexame`
--

INSERT INTO `historicoexame` (`ID`, `RG_FUNC`, `NOME_EXAME`, `DATA_EXAME`, `DATA_RECICLA`, `TIPO_EXAME`, `status_exame`) VALUES
(1, '344424807', 'Audiometria', '2019/04/23 15:50:00', '2 ANOS', 'RECICLAGEM', 'FEITO'),
(2, '344424807', 'Radiografias', '2017/04/23 15:50:00', '2 ANOS', 'RECICLAGEM', 'PENDENTE'),
(3, '352537516', 'Eletrocardiograma', '2019/04/23 15:50:00', '2 ANOS', 'RECICLAGEM', 'FEITO'),
(4, '352537516', 'psicotécnico', '2017/04/23 15:50:00', '2 ANOS', 'RECICLAGEM', 'PENDENTE'),
(5, '387676132', 'Exames laboratoriais', '2019/04/23 15:50:00', '2 ANOS', 'RECICLAGEM', 'FEITO'),
(6, '387676132', 'Espirometria', '2016/04/23 15:50:00', '2 ANOS', 'RECICLAGEM', 'PENDENTE'),
(7, '502284092', 'Acuidade visual', '2019/04/23 15:50:00', '2 ANOS', 'RECICLAGEM', 'FEITO'),
(8, '502284092', 'Audiometria', '2014/04/23 15:50:00', '2 ANOS', 'RECICLAGEM', 'PENDENTE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_treinamento`
--

CREATE TABLE `historico_treinamento` (
  `ID` int(11) NOT NULL,
  `RG_FUNC` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NOME_TRMT` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATA_TREINAMENTO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATA_VENCIMENTO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RECICLAGEM` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS_TREINAMENTO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `historico_treinamento`
--

INSERT INTO `historico_treinamento` (`ID`, `RG_FUNC`, `NOME_TRMT`, `DATA_TREINAMENTO`, `DATA_VENCIMENTO`, `RECICLAGEM`, `STATUS_TREINAMENTO`) VALUES
(1, '502284092', 'treinamento especifico de seguranca do trabalho', '2019/04/23 :15:00:00', '2021/04/23 :15:00:00', '2 ANOS', 'FEITO'),
(2, '502284092', 'PCA', '2019/04/23 :15:00:00', '2021/04/23 :15:00:00', '2 ANOS', 'PENDENTE'),
(3, '344424807', 'treinamento especifico de seguranca do trabalho', '2019/04/23 :15:00:00', '2021/04/23 :15:00:00', '2 ANOS', 'FEITO'),
(4, '344424807', 'PCA', '2019/04/23 :15:00:00', '2021/04/23 :15:00:00', '2 ANOS', 'PENDENTE'),
(5, '352537516', 'treinamento especifico de seguranca do trabalho', '2019/04/23 :15:00:00', '2021/04/23 :15:00:00', '2 ANOS', 'FEITO'),
(6, '352537516', 'PCA', '2019/04/23 :15:00:00', '2021/04/23 :15:00:00', '2 ANOS', 'PENDENTE'),
(7, '387676132', 'treinamento especifico de seguranca do trabalho', '2019/04/23 :15:00:00', '2021/04/23 :15:00:00', '2 ANOS', 'FEITO'),
(8, '387676132', 'PCA', '2019/04/23 :15:00:00', '2021/04/23 :15:00:00', '2 ANOS', 'PENDENTE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `navios`
--

CREATE TABLE `navios` (
  `ID` int(11) NOT NULL,
  `BERTH_WINDOW` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHEGADA_BARRA` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PREVISAO_ATRACACAO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ESCA_DTHR_ATRACACAO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `INICIO_OPERACAO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FIM_OPERCACAO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DESATRACACAO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NAVI_NOME` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HINA_QTDE_TOTAL_MOV` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HINA_CMPH` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SERVICO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LINER` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BERCO_ATRACACAO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `navios`
--

INSERT INTO `navios` (`ID`, `BERTH_WINDOW`, `CHEGADA_BARRA`, `PREVISAO_ATRACACAO`, `ESCA_DTHR_ATRACACAO`, `INICIO_OPERACAO`, `FIM_OPERCACAO`, `DESATRACACAO`, `NAVI_NOME`, `HINA_QTDE_TOTAL_MOV`, `HINA_CMPH`, `SERVICO`, `LINER`, `BERCO_ATRACACAO`) VALUES
(1, '2019/04/17 13:00:00', '2019/04/21 04:00:00', '2019/04/22 06:00:00', '2019/01/22 09:02:00', '2019/04/22 15:55:00', '2019/04/23 01:21:00', '2019/04/24 02:15', 'CATHERINE C', '864', '35.05', 'USA-STRING', 'MSC', 'BTP-3'),
(2, '2019/04/17 13:00:00', '2019/04/20 04:00:00', '2019/04/21 06:00:00', '2019/04/21 09:02:00', '2019/04/21 10:21:00', '2019/04/22 01:21:00', '2019/04/22 02:15', 'ALIANCA C', '864', '35.03', 'USA-STRING', 'MSC', 'BTP 2'),
(3, '2019/03/26 19:00:00', '2019/03/29 00:42:00', '2019/04/01 06:00:00', '2019/04/01 05:33:00', '2019/04/17 06:35:00', '2019/04/01 19:01:00', '2019/04/01 21:20', 'ALIANCA MANAUS', '362', '29.77', 'ALCT3', 'ALI', 'BTP 3'),
(4, '2019/02/15 13:00:00', '2019/02/13 10:30:00', '2019/02/14 22:00:00', '2019/02/14 22:10:00', '2019/02/15 12:03:00', '2019/02/16 19:38:00', '2019/02/17 03:20', 'CAPE ARTEMISIO', '2555', '28.13', 'IPANE-ASAS', 'HLC', 'BTP 2'),
(5, '2019/02/09 01:00:00', '2019/02/08 16:00:00', '2019/02/08 18:00:00', '2019/02/08 18:15:00', '2019/02/08 20:35:00', '2019/02/09 05:33:00', '2019/02/09 08:15', 'MAERSK LAMANAI', '767', '36.03', 'NEO BOSSA', 'MAE', 'BTP 3'),
(6, '2018/12/31 07:00:00', '2019/02/02 08:00:00', '2019/02/02 16:00:00', '2019/02/02 15:52:00', '2019/02/02 17:21:00', '2019/02/03 09:20:00', '2019/02/03 10:45', 'MAERSK LOTA', '948', '31.37', 'NEO BOSSA', 'MAE', 'BTP 2'),
(7, '2019/01/03 13:00:00', '2019/01/02 02:30:00', '2019/01/02 19:00:00', '2019/01/02 19:56:00', '2019/01/02 21:45:00', '2019/04/17 13:21:00', '2019/01/03 15:46', 'CROATIA', '1107', '27.02', 'IPANE-ASAS', 'ONE', 'BTP 2'),
(8, '2019/02/12 19:00:00', '2019/02/13 07:00:00', '2019/02/13 15:15:00', '2019/02/13 13:05:00', '2019/04/18 15:55:00', '2019/04/17 17:14:00', '2019/02/13 22:40', 'ALIANCA MANAUS', '94', '38.89', 'ALCT3', 'ALI', 'BTP 3'),
(9, '2018/05/18 07:00:00', '2018/11/06 18:20:00', '2018/11/07 21:30:00', '2018/11/07 21:30:00', '2018/11/07 23:22:00', '2018/11/08 08:59:00', '2018/11/08 10:16', 'MSC MARIANNA', '703', '32.69', 'USA-STRING', 'MSC', 'BTP 1'),
(10, '2019/04/20 01:00:00', '2019/04/20 23:00:00', '2019/04/20 01:00:00', '2019/04/20 02:48:00', '2019/04/23 04:28:00', '2019/04/23 20:02:00', '2019/04/24 23:55', 'MAERSK LONDRINA', '1883', '36.22', 'IPANE-ASAS', 'ONE', 'BTP 1'),
(11, '2018/12/18 19:00:00', '2018/12/19 18:00:00', '2018/12/19 20:00:00', '2018/12/19 20:12:00', '2019/06/17 15:55:00', '2018/12/20 09:25:00', '2018/12/20 11:22', 'UASC AL KHOR', '1425', '31.25', 'NWC1', 'HLC', 'BTP 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `provas`
--

CREATE TABLE `provas` (
  `ID` int(11) NOT NULL,
  `NOMEPROVA` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RG_FUNC` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NOTA` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `provas`
--

INSERT INTO `provas` (`ID`, `NOMEPROVA`, `RG_FUNC`, `NOTA`) VALUES
(1, 'INTEGRAÇÃO NR23 NR06 EPI', '344424807', '8'),
(2, 'treinamento especifico de segurança do trabalho', '352537516', '7');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_funcionario`
--

CREATE TABLE `tb_funcionario` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CURSO` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GRUPO` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CARGO` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ESCALA` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `USUARIO` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PASSWORD` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `COD_FUNC` int(2) NOT NULL,
  `RG` varchar(55) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_funcionario`
--

INSERT INTO `tb_funcionario` (`ID`, `NOME`, `CURSO`, `GRUPO`, `CARGO`, `ESCALA`, `USUARIO`, `PASSWORD`, `COD_FUNC`, `RG`) VALUES
(8, 'AUGUSTO', 'treinamento especifico de segurança do trabalho', 'E', 'Operador de equipamentos II', '224', 'AUGUSTO123', '123456789', 1, '502284092'),
(9, 'MATEUS', 'treinamento especifico de segurança do trabalho', 'E', 'Supervisor de gate', '240', 'MATEUS123', '123456987', 2, '344424807'),
(10, 'GUSTAVO', 'PCA', 'A', 'INSTRUTOR DE TREINAMENTO TECNICO', '240', 'GUSTAVO123', '987654321', 2, '352537516'),
(11, 'ANDERSON', 'STOP', 'A', 'ANALISTA DE SUPORTE JR', '240', 'ANDERSON123', '123654789', 1, '387676132');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_treinamento`
--

CREATE TABLE `tb_treinamento` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CRITICIDADE` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FREQUENCIA` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATACURSO` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIPO` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIPOEXAME` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_treinamento`
--

INSERT INTO `tb_treinamento` (`ID`, `NOME`, `CRITICIDADE`, `FREQUENCIA`, `DATACURSO`, `TIPO`, `TIPOEXAME`) VALUES
(1, 'INTEGRAÇÃO NR23 NR06 EPI', 'SIM', 'NÃO', '21/11/2019', 'PRESENCIAL', 'ADMISSÃO'),
(2, 'BRIGADA DE EMERGÊNCIA-PAE', 'SIM', 'NÃO', '21/11/2019', 'PRESENCIAL', 'ADMISSÃO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `escala`
--
ALTER TABLE `escala`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exames`
--
ALTER TABLE `exames`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `historicoexame`
--
ALTER TABLE `historicoexame`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `historico_treinamento`
--
ALTER TABLE `historico_treinamento`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `navios`
--
ALTER TABLE `navios`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `provas`
--
ALTER TABLE `provas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_treinamento`
--
ALTER TABLE `tb_treinamento`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avisos`
--
ALTER TABLE `avisos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `escala`
--
ALTER TABLE `escala`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exames`
--
ALTER TABLE `exames`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `historicoexame`
--
ALTER TABLE `historicoexame`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `historico_treinamento`
--
ALTER TABLE `historico_treinamento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `navios`
--
ALTER TABLE `navios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `provas`
--
ALTER TABLE `provas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_treinamento`
--
ALTER TABLE `tb_treinamento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
