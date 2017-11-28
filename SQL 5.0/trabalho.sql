-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 28-Nov-2017 às 14:05
-- Versão do servidor: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trabalho`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao`
--

DROP TABLE IF EXISTS `cartao`;
CREATE TABLE IF NOT EXISTS `cartao` (
  `idcliente` int(11) NOT NULL,
  `numerocc` varchar(100) NOT NULL,
  `validade` varchar(10) NOT NULL,
  `codseguranca` varchar(100) NOT NULL,
  PRIMARY KEY (`numerocc`),
  KEY `idcliente_cartao` (`idcliente`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Aqui é o cartão do cliente';

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `pontuacao` float NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `numerocc` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nome`, `email`, `cpf`, `foto`, `pontuacao`, `telefone`, `numerocc`, `senha`) VALUES
(17, 'Henrique', 'hiquepenna@hotmail.com', '08348988610', 'a704f2f7256602521567172c603b668e.jpg', 0, '37991214090', '', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `idendereco` int(11) NOT NULL AUTO_INCREMENT,
  `nomeEnd` varchar(100) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `cep` int(11) NOT NULL,
  PRIMARY KEY (`idendereco`),
  KEY `idcliente_endereco` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='Aqui é um endereço dos cliente';

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`idendereco`, `nomeEnd`, `idcliente`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `cep`) VALUES
(9, 'Minha Cassa', 17, 'Joaquim TeÃ³filo', 34, 'Casa verde', 'SÃ£o francisco', 'Vicosa', 36570000),
(10, 'Casa do meu pai', 17, 'Rua Jacinto', 31, 'Esquina da rua 4', 'Sao Jose', 'Belo Horizonte', 34567898);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prestador`
--

DROP TABLE IF EXISTS `prestador`;
CREATE TABLE IF NOT EXISTS `prestador` (
  `idprestador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `pontuacao` float NOT NULL,
  `senha` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`idprestador`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `prestador`
--

INSERT INTO `prestador` (`idprestador`, `nome`, `email`, `cpf`, `telefone`, `pontuacao`, `senha`, `foto`) VALUES
(0, 'FANTASMA', 'FANTASMA', 'FANTASMA', 'FANTASMA', 0, 'FANTASMA', ''),
(4, 'Alexia Penna Barbosa Diniz', 'alexia@prestador', '08348988611', '37991214091', 0, '123', 'd10f02f9eaadddc00014da36f0dc6eae.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

DROP TABLE IF EXISTS `servico`;
CREATE TABLE IF NOT EXISTS `servico` (
  `nomeservico` varchar(100) NOT NULL,
  `valormercado` float NOT NULL,
  `tipo` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  PRIMARY KEY (`nomeservico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`nomeservico`, `valormercado`, `tipo`, `status`, `descricao`) VALUES
('AÃ§ougueiro', 150, 1, 0, 'Vai fazer cortar carne'),
('Barman', 175, 1, 1, 'Serve bebida pra galera'),
('Faxineira', 350, 1, 1, 'Deixa sua casa brilhando'),
('Jardineiro', 80, 1, 1, 'Cuida do seu jardim muito bem'),
('Pintor', 150, 1, 1, 'Pinta o muro da sua casa'),
('Professor paticular', 55, 1, 1, 'Vai dar aula pras criancas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao`
--

DROP TABLE IF EXISTS `solicitacao`;
CREATE TABLE IF NOT EXISTS `solicitacao` (
  `idsolicitacao` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `nomeservico` varchar(100) NOT NULL,
  `idprestador` int(11) NOT NULL,
  `endereco` int(11) NOT NULL,
  `valor` float NOT NULL,
  `notaprocliente` int(11) NOT NULL,
  `notaproprestador` int(11) NOT NULL,
  `comcliente` varchar(100) NOT NULL,
  `comprestador` varchar(100) NOT NULL,
  `efetuado` tinyint(1) NOT NULL,
  `dataAMD` date NOT NULL,
  PRIMARY KEY (`idsolicitacao`),
  KEY `idcliente_solicitacao` (`idcliente`),
  KEY `nomeservico_solicitacao` (`nomeservico`),
  KEY `idprestador_solicitacao` (`idprestador`),
  KEY `endereco_solicitacao` (`endereco`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `solicitacao`
--

INSERT INTO `solicitacao` (`idsolicitacao`, `idcliente`, `nomeservico`, `idprestador`, `endereco`, `valor`, `notaprocliente`, `notaproprestador`, `comcliente`, `comprestador`, `efetuado`, `dataAMD`) VALUES
(29, 17, 'Professor paticular', 4, 9, 55, 4, 5, 'Foi legal', 'Eu gostei hein', 1, '2017-11-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sugerec`
--

DROP TABLE IF EXISTS `sugerec`;
CREATE TABLE IF NOT EXISTS `sugerec` (
  `idcliente` int(1) NOT NULL,
  `nomeservico` varchar(100) NOT NULL,
  `aprovado` tinyint(4) NOT NULL,
  KEY `idcliente_sugere` (`idcliente`),
  KEY `nomeservico_sugere` (`nomeservico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Aqui os clientes irao sugerir servicos';

--
-- Extraindo dados da tabela `sugerec`
--

INSERT INTO `sugerec` (`idcliente`, `nomeservico`, `aprovado`) VALUES
(17, 'Professor paticular', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sugerep`
--

DROP TABLE IF EXISTS `sugerep`;
CREATE TABLE IF NOT EXISTS `sugerep` (
  `idprestador` int(11) NOT NULL,
  `nomeservico` varchar(100) NOT NULL,
  `aprovado` tinyint(11) NOT NULL,
  KEY `idprestador_sugere` (`idprestador`),
  KEY `nomeservico_sugere2` (`nomeservico`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cartao`
--
ALTER TABLE `cartao`
  ADD CONSTRAINT `idcliente_cartao` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `idcliente_endereco` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD CONSTRAINT `endereco_solicitacao` FOREIGN KEY (`endereco`) REFERENCES `endereco` (`idendereco`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idcliente_solicitacao` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idprestador_solicitacao` FOREIGN KEY (`idprestador`) REFERENCES `prestador` (`idprestador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nomeservico_solicitacao	` FOREIGN KEY (`nomeservico`) REFERENCES `servico` (`nomeservico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `sugerec`
--
ALTER TABLE `sugerec`
  ADD CONSTRAINT `idcliente_sugere` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `nomeservico_sugere` FOREIGN KEY (`nomeservico`) REFERENCES `servico` (`nomeservico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sugerep`
--
ALTER TABLE `sugerep`
  ADD CONSTRAINT `idprestador_sugere` FOREIGN KEY (`idprestador`) REFERENCES `prestador` (`idprestador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `nomeservico_sugere2` FOREIGN KEY (`nomeservico`) REFERENCES `servico` (`nomeservico`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
