-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Ago 12, 2013 alle 12:25
-- Versione del server: 5.5.27
-- Versione PHP: 5.4.7

DROP DATABASE IF EXISTS siviaggiare;
CREATE DATABASE siviaggiare;
USE siviaggiare;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Siviaggiare`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
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

INSERT INTO `utente` (`username`, `nome`, `cognome`,`residenza`,`nazione`, `mail`, `password`, `cod_attivazione`, `stato`) VALUES
('kekko', 'francesco', 'verzicco','casabianca','stato proprieta','kekko@libero.it', '1234', '1234', 'attivo'),
('riccio', 'ric', 'verzicco', 'non pervenuta','rifugiato politico','riccio@libero.it', '1234', '1234', 'attivo'),
('stef', 'ste', 'verzicco', 'los burgos','italia','kekko@libero.it', '1234', '1234', 'attivo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Struttura della tabella `viaggio`
--

CREATE TABLE IF NOT EXISTS `viaggio` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `utenteusername` varchar(40) DEFAULT NULL,
  `datainizio` date DEFAULT NULL,
  `datafine` date DEFAULT NULL,
  `mezzotrasporto` varchar(80) DEFAULT NULL,
  `costotrasporto` varchar(20) DEFAULT NULL,
  `budget` float(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utente` (`utenteusername`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `viaggio` (`id`, `utenteusername`, `datainizio`, `datafine`, `mezzotrasporto`, `costotrasporto`, `budget`) VALUES
('1', 'kekko', '2003-08-08', '2013-08-09', 'aero', '1', '0,1'),
('2', 'riccio', '2003-08-08', '2013-08-10', 'sampateinculo', '5000', '5000000'),
('3', 'kekko', '2013-08-08', '2013-08-08', 'yacht', '4', '500');
--
-- Struttura della tabella `citta`
--

CREATE TABLE IF NOT EXISTS `citta` (
  `idviaggio` int(20) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `stato` varchar(30) NOT NULL,
  `datainizio` date DEFAULT NULL,
  `datafine` date DEFAULT NULL,
  `tipoalloggio` varchar(20) DEFAULT NULL,
  `costoalloggio` float(20) DEFAULT NULL,
  `voto` int(2) DEFAULT NULL,
  PRIMARY KEY (`idviaggio`,`nome`,`stato`),
  KEY `viaggio` (`idviaggio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `citta` (`idviaggio`, `nome`,`stato`, `datainizio`, `datafine`, `tipoalloggio`, `costoalloggio`, `voto`) VALUES
('1', 'roma','italia', '2003-08-08', '2013-08-09', 'hotel', '1', '9'),
('2', 'borgo','italia', '2003-08-08', '2013-08-10', 'in strada', '5000', '1'),
('1', 'parigi','francia', '2013-08-08', '2013-08-08', 'b&b', '4', '6');


CREATE TABLE IF NOT EXISTS `luogo` (
  `idviaggio` int(20) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `nomecitta` varchar(30) NOT NULL,
  `sitoweb` varchar(50) DEFAULT NULL,
  `percorso` varchar(1024) DEFAULT NULL,
  `costobiglietto` float(10) DEFAULT NULL,
  `guida` varchar(20) DEFAULT NULL,
  `coda` enum('minima','media','alta') DEFAULT NULL,
  `durata` time DEFAULT NULL,
  `commentolibero` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`idviaggio`,`nome`,`nomecitta`),
  KEY `viaggio` (`idviaggio`),
  KEY `citta` (`nomecitta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `luogo` (`idviaggio`, `nome`,`nomecitta`, `sitoweb`, `percorso`, `costobiglietto`, `guida`, `coda`, `durata`,`commentolibero`) VALUES
('2','casa brunetto','borgo','www.brunetto.it','metro+auto','5,50','utile','alta','23:40:0','hjgsdfklsdfh kfgdsg'),
('1','torre eiffel','parigi','www.torreeiffel.it','metro','2,50','non utile','minima','2:0:0','uedfòk fwlfhl fwwelhwe'),
('1','colosseo','roma','www.colosseo.it','metro+auto','5,50','utile','alta','3:0:0','kjwqkl fkjf');

CREATE TABLE `commento` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO `commento` (`id`, `idviaggioc`,`nomec`,`cittac`,`autore`,`testo`, `voto`) VALUES
('1','1','colosseo','roma','stef','Bella recensione','9'),
('2','1','torre eiffel','parigi','riccio','Buono recensione','6'),
('3','2','casa brunetto','borgo','kekko','Brutta recensione','3');
