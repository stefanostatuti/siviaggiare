-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2013 at 11:03 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `siviaggiare`
--
CREATE DATABASE IF NOT EXISTS `siviaggiare` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `siviaggiare`;

-- --------------------------------------------------------

--
-- Table structure for table `citta`
--

CREATE TABLE IF NOT EXISTS `citta` (
  `idviaggio` int(20) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `stato` varchar(30) NOT NULL,
  `datainizio` date DEFAULT NULL,
  `datafine` date DEFAULT NULL,
  `tipoalloggio` varchar(20) DEFAULT NULL,
  `costoalloggio` float DEFAULT NULL,
  `voto` int(2) DEFAULT NULL,
  PRIMARY KEY (`idviaggio`,`nome`,`stato`),
  KEY `viaggio` (`idviaggio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `citta`
--

INSERT INTO `citta` (`idviaggio`, `nome`, `stato`, `datainizio`, `datafine`, `tipoalloggio`, `costoalloggio`, `voto`) VALUES
(1, 'parigi', 'francia', '2013-08-08', '2013-08-08', 'b&b', 4, 6),
(1, 'roma', 'italia', '2003-08-08', '2013-08-09', 'hotel', 1, 9),
(2, 'borgo', 'italia', '2003-08-08', '2013-08-10', 'in strada', 5000, 1),
(7, 'Casa del diablo', 'EIRE', '2013-08-07', '2013-08-17', 'ponte', 300, 3),
(7, 'Rieti', 'Italia', '2013-08-06', '2013-08-08', 'Casa', 20, 2),
(8, 'Roma', 'Italia', '2013-08-04', '2013-08-10', 'Casa', 500, 8),
(9, 'Casa del diablo', 'EIRE', '2013-08-07', '2013-08-17', 'ponte', 300, 3);

-- --------------------------------------------------------

--
-- Table structure for table `commento`
--

CREATE TABLE IF NOT EXISTS `commento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idviaggioc` varchar(13) NOT NULL,
  `nomec` varchar(40) NOT NULL,
  `cittac` varchar(30) NOT NULL,
  `autore` varchar(20) NOT NULL,
  `testo` varchar(1024) DEFAULT NULL,
  `voto` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `luogo` (`idviaggioc`,`nomec`,`cittac`),
  KEY `utente` (`autore`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `commento`
--

INSERT INTO `commento` (`id`, `idviaggioc`, `nomec`, `cittac`, `autore`, `testo`, `voto`) VALUES
(1, '1', 'colosseo', 'roma', 'stef', 'Bella recensione', 9),
(2, '1', 'torre eiffel', 'parigi', 'riccio', 'Buono recensione', 6),
(3, '2', 'casa brunetto', 'borgo', 'kekko', 'Brutta recensione', 3);

-- --------------------------------------------------------

--
-- Table structure for table `luogo`
--

CREATE TABLE IF NOT EXISTS `luogo` (
  `idviaggio` int(20) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `nomecitta` varchar(30) NOT NULL,
  `sitoweb` varchar(50) DEFAULT NULL,
  `percorso` varchar(1024) DEFAULT NULL,
  `costobiglietto` float DEFAULT NULL,
  `guida` varchar(20) DEFAULT NULL,
  `coda` enum('minima','media','alta') DEFAULT NULL,
  `durata` time DEFAULT NULL,
  `commentolibero` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`idviaggio`,`nome`,`nomecitta`),
  KEY `viaggio` (`idviaggio`),
  KEY `citta` (`nomecitta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `luogo`
--

INSERT INTO `luogo` (`idviaggio`, `nome`, `nomecitta`, `sitoweb`, `percorso`, `costobiglietto`, `guida`, `coda`, `durata`, `commentolibero`) VALUES
(1, 'colosseo', 'roma', 'www.colosseo.it', 'metro+auto', 5, 'utile', 'alta', '03:00:00', 'kjwqkl fkjf'),
(1, 'torre eiffel', 'parigi', 'www.torreeiffel.it', 'metro', 2, 'non utile', 'minima', '02:00:00', 'uedfòk fwlfhl fwwelhwe'),
(2, 'casa brunetto', 'borgo', 'www.brunetto.it', 'metro+auto', 5, 'utile', 'alta', '23:40:00', 'hjgsdfklsdfh kfgdsg'),
(7, 'casa', 'htredjhrh', 'tdrjhdhrdsh', NULL, 456, 'si', 'media', '03:00:00', 'rhsjhdrj');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `username` varchar(20) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `cognome` varchar(40) DEFAULT NULL,
  `residenza` varchar(40) DEFAULT NULL,
  `nazione` varchar(20) DEFAULT NULL,
  `mail` varchar(80) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `cod_attivazione` varchar(10) DEFAULT NULL,
  `stato` enum('non_attivo','attivo') DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`username`, `nome`, `cognome`, `residenza`, `nazione`, `mail`, `password`, `cod_attivazione`, `stato`) VALUES
('Emanuela', 'eghsg', 'egagew', 'Rieti', 'eagas', 'agewg', 'emanuela', '2122454021', 'non_attivo'),
('kekko', 'francesco', 'verzicco', 'casabianca', 'stato proprieta', 'kekko@libero.it', '1234', '1234', 'attivo'),
('pippo', 'Pippo', 'Cognome', 'Rieti', 'EmanuelaLand', 'pippo@pippo.it', 'pippo', '1476023205', 'attivo'),
('riccio', 'ric', 'verzicco', 'non pervenuta', 'rifugiato politico', 'riccio@libero.it', '1234', '1234', 'attivo'),
('stef', 'ste', 'verzicco', 'los burgos', 'italia', 'kekko@libero.it', '1234', '1234', 'attivo');

-- --------------------------------------------------------

--
-- Table structure for table `viaggio`
--

CREATE TABLE IF NOT EXISTS `viaggio` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `utenteusername` varchar(40) DEFAULT NULL,
  `datainizio` date DEFAULT NULL,
  `datafine` date DEFAULT NULL,
  `mezzotrasporto` varchar(80) DEFAULT NULL,
  `costotrasporto` varchar(20) DEFAULT NULL,
  `budget` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utente` (`utenteusername`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `viaggio`
--

INSERT INTO `viaggio` (`id`, `utenteusername`, `datainizio`, `datafine`, `mezzotrasporto`, `costotrasporto`, `budget`) VALUES
(1, 'kekko', '2003-08-08', '2013-08-09', 'aero', '1', 0),
(2, 'riccio', '2003-08-08', '2013-08-10', 'sampateinculo', '5000', 5000000),
(3, 'kekko', '2013-08-08', '2013-08-08', 'yacht', '4', 500),
(4, 'pippo', '2029-03-03', '2543-05-03', 'Traghetto', '3456', 524352),
(5, 'pippo', '2013-04-04', '2013-04-05', 'Nave', '45654', 262),
(6, 'pippo', '0000-00-00', '0000-00-00', 'Aereo', '474533', 436346000),
(7, 'pippo', '2013-12-23', '2013-12-23', 'Nave', '2435', 352365000),
(8, 'pippo', '2014-03-05', '2015-03-04', 'Astronave', '456', 23456),
(9, 'pippo', '2013-02-03', '2013-05-06', 'Moto', '234', 1232),
(10, 'pippo', '2013-02-09', '2013-02-01', 'Autobus', '236', 13242),
(11, 'pippo', '2013-02-03', '2013-05-06', 'Moto', '234', 1232),
(12, 'pippo', '2013-12-02', '2013-03-02', 'Nave', '254235', 32423);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
