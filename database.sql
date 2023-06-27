-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           10.4.27-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para pontocivil
CREATE DATABASE IF NOT EXISTS `pontocivil` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `pontocivil`;

-- Copiando estrutura para tabela pontocivil.colaboradores
CREATE TABLE IF NOT EXISTS `colaboradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `diaria` int(11) DEFAULT NULL COMMENT 'em centavos',
  `funcao` varchar(100) DEFAULT NULL,
  `observacoes` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela pontocivil.colaboradores_obras
CREATE TABLE IF NOT EXISTS `colaboradores_obras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_colaborador` int(11) NOT NULL DEFAULT 0,
  `id_obra` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK__colaboradores` (`id_colaborador`),
  KEY `FK__obras` (`id_obra`),
  CONSTRAINT `FK__colaboradores` FOREIGN KEY (`id_colaborador`) REFERENCES `colaboradores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__obras` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela pontocivil.obras
CREATE TABLE IF NOT EXISTS `obras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `descricao` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela pontocivil.pontos
CREATE TABLE IF NOT EXISTS `pontos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_colaborador` int(11) NOT NULL,
  `id_obra` int(11) NOT NULL,
  `data` date NOT NULL,
  `matutino` tinyint(1) NOT NULL,
  `vespertino` tinyint(1) NOT NULL,
  `valor_diaria` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_pontos_colaboradores` (`id_colaborador`),
  KEY `FK_pontos_obras` (`id_obra`),
  CONSTRAINT `FK_pontos_colaboradores` FOREIGN KEY (`id_colaborador`) REFERENCES `colaboradores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pontos_obras` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
