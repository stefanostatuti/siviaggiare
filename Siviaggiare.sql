-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: 15 nov, 2013 at 03:03 PM
-- Versione MySQL: 5.1.44
-- Versione PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `siviaggiare`
--
CREATE DATABASE `siviaggiare` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `siviaggiare`;

-- --------------------------------------------------------

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
  `costoalloggio` int(6) DEFAULT NULL,
  `valuta` varchar(20) DEFAULT NULL,
  `voto` int(2) DEFAULT NULL,
  `feedback` int(4) DEFAULT NULL,
  `utentifeedback` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`idviaggio`,`nome`,`stato`),
  KEY `viaggio` (`idviaggio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `citta`
--

INSERT INTO `citta` (`idviaggio`, `nome`, `stato`, `datainizio`, `datafine`, `tipoalloggio`, `costoalloggio`, `valuta`, `voto`, `feedback`, `utentifeedback`) VALUES
(6, 'firenze', 'italia', '2013-10-05', '2013-10-07', 'casa di amici', 0, 'Euro', 9, 3, 'pippo riccio dario '),
(6, 'roma', 'italia', '2013-10-04', '2013-10-05', 'hotel', 30, 'Euro', 10, 3, 'pippo riccio dario '),
(7, 'Chicago', 'USA', '2013-11-12', '2013-11-15', 'hotel', 45, 'Dollaro US', 7, 0, ''),
(7, 'Las Vegas', 'USA', '2013-11-15', '2013-11-18', 'hotel', 52, 'Dollaro US', 9, 0, ''),
(7, 'New York', 'USA', '2013-11-10', '2013-11-12', 'hotel', 30, 'Euro', 10, 0, ''),
(7, 'Washington', 'USA', '2013-11-15', '2013-11-19', 'hotel', 36, 'Euro', 5, 0, ''),
(8, 'Milano', 'Italia', '2013-09-05', '2013-09-09', 'hotel', 20, 'Euro', 8, 0, ''),
(8, 'Torino', 'italia', '2013-09-17', '2013-09-25', 'casa', 15, 'Euro', 4, 0, ''),
(8, 'Venezia', 'italia', '2013-09-11', '2013-09-15', 'hotel', 60, 'Euro', 10, 0, ''),
(9, 'Pechino', 'Cina', '2013-11-06', '2013-11-10', 'hotel', 30, 'Euro', 9, 0, ''),
(10, 'Barcellona', 'Spagna', '2013-11-02', '2013-11-04', 'hotel', 30, 'Dollaro AU', 9, 4, 'kekko pippo rocco2 paolo1 '),
(10, 'Lisbona', 'Portogallo', '2013-11-08', '2013-11-20', 'hotel', 35, 'Euro', 8, 3, 'pippo rocco2 paolo1 '),
(10, 'Madrid', 'Spagna', '2013-11-08', '2013-11-20', 'hotel', 34, 'Euro', 6, 3, 'pippo rocco2 paolo1 '),
(11, 'Bologna', 'italia', '2013-11-14', '2013-11-21', 'casa di amici', 0, 'Euro', 8, 1, 'dario '),
(11, 'Parma', 'italia', '2013-11-13', '2013-11-16', 'hotel', 12, 'Euro', 6, 1, 'dario '),
(12, 'Dubai', 'EAU', '2013-11-09', '2013-11-11', 'hotel', 100, 'Euro', 8, 0, ''),
(12, 'Tokyo', 'Giappone', '2013-11-02', '2013-11-05', 'hotel', 35, 'Euro', 6, 0, ''),
(13, 'Berlino', 'Germania', '2013-10-06', '2013-10-08', 'hotel', 35, 'Euro', 8, 0, ''),
(13, 'Monaco', 'Germania', '2013-10-10', '2013-10-15', 'hotel', 28, 'Euro', 6, 0, ''),
(14, 'Boston', 'USA', '2013-11-15', '2013-11-17', 'hotel', 25, 'Dollaro US', 7, 0, ''),
(14, 'New Orleans', 'USA', '2013-11-15', '2013-11-17', 'hotel', 30, 'Dollaro US', 8, 0, ''),
(15, 'Atene', 'Grecia', '2013-11-15', '2013-11-17', 'casa', 18, 'Euro', 7, 0, ''),
(16, 'firenze', 'italia', '2013-11-16', '2013-11-18', 'hotel', 25, 'Euro', 8, 6, 'kekko pippo riccio rocco2 paolo1 dario '),
(16, 'Milano', 'italia', '2013-11-15', '2013-11-18', 'hotel', 37, 'Euro', 7, 6, 'kekko pippo riccio rocco2 paolo1 dario '),
(16, 'Roma', 'Italia', '2013-11-16', '2013-11-19', 'hotel', 35, 'Euro', 9, 5, 'kekko riccio rocco2 paolo1 dario '),
(17, 'Parma', 'italia', '2013-11-11', '2013-11-13', 'hotel', 25, 'Euro', 8, 5, 'pippo riccio rocco2 paolo1 dario '),
(17, 'Venezia', 'Italia', '2013-11-10', '2013-11-12', 'hotel', 45, 'Euro', 10, 4, 'pippo riccio paolo1 dario ');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE IF NOT EXISTS `commento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idviaggio` varchar(13) NOT NULL,
  `nomeluogo` varchar(40) NOT NULL,
  `nomecitta` varchar(30) NOT NULL,
  `autore` varchar(20) NOT NULL,
  `testo` varchar(1024) DEFAULT NULL,
  `voto` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `luogo` (`idviaggio`,`nomeluogo`,`nomecitta`),
  KEY `utente` (`autore`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`id`, `idviaggio`, `nomeluogo`, `nomecitta`, `autore`, `testo`, `voto`) VALUES
(3, '10', 'Camp Nou', 'Barcellona', 'kekko', 'Che bella foto....Forza Barcellona', 8),
(4, '10', 'Sagrada Familia', 'Barcellona', 'kekko', 'bella la salita sulle torri lato natività e la visita con le audioguide consiglio di prendere il biglietto via web', 9),
(5, '10', 'casa Batllo', 'Barcellona', 'kekko', 'Che belle le opere di gaudi', 6),
(6, '16', 'Duomo', 'Milano', 'kekko', 'Bellissimo....anche io consiglio a tutti di andarlo a vedere', 6),
(7, '17', 'Piazza San Marco', 'Venezia', 'kekko', 'La citta piu bella di tutte', 9),
(8, '6', 'fontana di Trevi', 'roma', 'pippo', 'Il mio desiderio si è realizzato', 8),
(9, '17', 'Palazzo della Pilotta', 'Parma', 'pippo', 'Ciao....', 9),
(10, '10', 'Puerta del Angel', 'Madrid', 'pippo', 'La storia di questa porta è veramente bella.....consiglio a tutti di andarsela a leggere', 8),
(11, '14', 'JFK Library', 'Boston', 'pippo', 'La John F. Kennedy Library è una biblioteca presidenziale dedicata a John Fitzgerald Kennedy, 35° Presidente degli Stati Uniti. Ospita numerosi documenti relativi alla presidenza Kennedy ed effetti personali appartenuti al Presidente.', 9),
(12, '14', 'JFK Library', 'Boston', 'pippo', 'Veramente interessante', 8),
(13, '16', 'uffizi', 'firenze', 'pippo', 'Il museo piu bello del mondo', 10),
(14, '16', 'colosseo', 'Roma', 'riccio', 'Foto veramente bella', 6),
(15, '17', 'Palazzo Ducale', 'Venezia', 'riccio', 'Ciao a tutti....', 1),
(16, '6', 'Duomo', 'firenze', 'riccio', 'ma dove hai scattato la foto da un aereo??\nComunque è molto bella sia la foto che la citta', 6),
(17, '6', 'Duomo', 'firenze', 'rocco2', 'Be penso proprio di si riccio....', 8),
(18, '6', 'fontana di Trevi', 'roma', 'rocco2', 'Roma citta eterna', 6),
(19, '10', 'palazzo di cristallo', 'Madrid', 'rocco2', 'Anche io ci sono stata e ne sono rimasta affascinata.....pero la foto è veramente orrenda!!!ciao', 8),
(20, '16', 'colosseo', 'Roma', 'paolo1', 'Il colosseo è il simbolo di roma e di tutta la sua storia.....impossibile non averlo mai visto almeno una volta nella vita', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `luogo`
--

CREATE TABLE IF NOT EXISTS `luogo` (
  `idviaggio` int(20) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `nomecitta` varchar(30) NOT NULL,
  `sitoweb` varchar(50) DEFAULT NULL,
  `percorso` varchar(1024) DEFAULT NULL,
  `costobiglietto` int(6) DEFAULT NULL,
  `valuta` varchar(20) DEFAULT NULL,
  `guida` varchar(20) DEFAULT NULL,
  `coda` enum('minima','media','alta') DEFAULT NULL,
  `durata` int(3) DEFAULT NULL,
  `commentolibero` varchar(2048) DEFAULT NULL,
  `feedback` int(4) DEFAULT NULL,
  `immagini` varchar(1000) DEFAULT NULL,
  `utentifeedback` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`idviaggio`,`nome`,`nomecitta`),
  KEY `viaggio` (`idviaggio`),
  KEY `citta` (`nomecitta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `luogo`
--

INSERT INTO `luogo` (`idviaggio`, `nome`, `nomecitta`, `sitoweb`, `percorso`, `costobiglietto`, `valuta`, `guida`, `coda`, `durata`, `commentolibero`, `feedback`, `immagini`, `utentifeedback`) VALUES
(6, 'colosseo', 'roma', 'www.colosseo.it', 'metro', 1, 'Euro', 'non utilizzata', 'alta', 60, 'Un posto bellissimo!\r\nDa vedere assolutamente!!!!', 1, 'kekkocolosseo.jpeg', 'rocco2 '),
(6, 'Duomo', 'firenze', 'www.duomofirenze.it', '', 10, 'Euro', 'utile', 'media', 100, '', 3, 'kekkoduomofir.jpeg', 'riccio rocco2 dario '),
(6, 'fontana di Trevi', 'roma', 'www.fontanaditrevi.it', 'metro', 0, 'Euro', '', 'minima', 10, 'che emozione lanciare una moneta.......speriamo che il desidero si realizzi', 4, 'kekkofontanatrevi.jpg', 'pippo rocco2 paolo1 dario '),
(6, 'San Pietro', 'roma', 'www.vaticano.it', 'metro', 5, 'Euro', 'non usata', 'media', 120, 'Un posto veramente spirituale', 1, 'kekkosanpietro.jpeg', 'dario '),
(6, 'uffizi', 'firenze', 'www.uffizi.it', 'a piedi', 15, 'Euro', 'utilissima', 'alta', 150, 'il piu bel museo del mondo', 1, 'kekkouffizi.jpg', 'dario '),
(7, 'Caesar''s Palace', 'Las Vegas', 'www.caesarpalace.us', '', 40, 'Dollaro US', 'no', 'media', 150, 'Il luogo dell''eccesso e del divertimento......consigliato soprattutto a chi piace giocare con la fortuna!!!!', 0, 'kekkocesarpalace.jpeg', ''),
(7, 'Casa Bianca', 'Washington', 'ww.whitehouse.us', 'metro', 0, 'Euro', '', 'minima', 0, '', 0, 'kekkoCasaBianca.jpg', ''),
(7, 'Ground Zero', 'New York', '', 'tram', 0, 'Euro', 'non usata', 'minima', 30, 'il simbolo della rinascita di New York e del ricordo......consigliato', 0, 'kekkoground_zero.jpg', ''),
(7, 'Monument Valley', 'Las Vegas', 'www.monumentlasvegas.us', 'auto', 0, 'Euro', 'non utilizzata', 'minima', 200, '', 0, '', ''),
(7, 'Square Park', 'Washington', '', 'metro', 0, 'Euro', 'non utilizzata', 'minima', 54, '', 0, 'kekkosquarepark.jpeg', ''),
(7, 'Statua della Liberta', 'New York', 'www.statualiberta.us', 'metro', 20, 'Dollaro US', 'utile', 'media', 40, '', 0, 'kekkostatualiberta.jpg', ''),
(7, 'Willis Tower', 'Chicago', 'www.willistower.us', '', 15, 'Euro', 'utile', 'media', 100, 'consigliato\r\nMi raccomando andatelo a visitare', 0, 'kekkowillistower.jpeg', ''),
(8, 'Castello Sforzesco', 'Milano', 'www.castellosforzesco.it', '', 22, 'Euro', 'utilissima', 'media', 45, '', 0, 'pippocastsforz.jpeg', ''),
(8, 'Duomo', 'Milano', 'www.duomomilano.com', 'metro', 15, 'Euro', 'utile', 'media', 60, '', 0, 'pippoduomomi.jpeg', ''),
(8, 'Mole Antonelliana', 'Torino', 'www.moletorino.it', '', 15, 'Euro', 'utile', 'media', 30, '', 0, 'pippoPanoramaMole.jpg', ''),
(8, 'Piazza San Marco', 'Venezia', '', '', 0, 'Euro', '', 'minima', 0, 'semplicemente la piazza piu bella del mondo.....almeno per me', 0, 'pippopiazzasanmarco.jpeg', ''),
(8, 'Ponte dei Sospiri', 'Venezia', '', 'a piedi', 0, 'Euro', 'utilizzata', 'minima', 15, '', 0, 'pippopontesospiri.jpg', ''),
(8, 'San Siro', 'Milano', 'www.sansiro.it', 'metro', 35, 'Euro', '', 'minima', 0, 'trovandomi a milano non potevo non andare a vedere una partita della mia squadra del cuore (Inter)\r\nComunque consiglio anche a chi non interessa il calcio di andarlo a visitare perche è meraviglioso', 0, 'pipposansiro.jpeg', ''),
(8, 'Teatro alla Scala', 'Milano', 'www.scalamilano.it', '', 40, 'Euro', '', 'media', 40, 'l''acustica è ottima e gli spettacoli indimenticabili......', 0, 'pipposcalamilano.jpeg', ''),
(9, 'Mura Cinese', 'Pechino', 'www.muragliacinese.com', 'a piedi', 20, 'Yen Giapponese', '', 'minima', 400, 'imperiosa.....la fatica ha ripagato completamente le attese......andateci mi raccomando', 0, '', ''),
(10, 'Ascensore di Santa Justa', 'Lisbona', '', '', 0, 'Euro', 'non serve', 'minima', 10, 'Progettato da un apprendista di Gustav Eiffel, l’ascensore di Santa Justa vi permetterà di ammirare in pochi minuti uno dei panorami più affascinanti di Lisbona. Divenuto il simbolo della capitale portoghese, l’ascensore è anche un comodo mezzo per i disabili in visita alla città, permettendo di raggiungere il Bairro Alto direttamente dal centro di Lisbona.', 0, 'riccioascsanta.jpg', ''),
(10, 'Camp Nou', 'Barcellona', 'www.fcbarcelona.es', 'dvdsa', 25, 'Euro', '', 'media', 120, 'Semplicemente uno stadio fantastico', 1, 'ricciocampnou.jpg', 'kekko '),
(10, 'casa Batllo', 'Barcellona', 'www.batlo.es', '', 23, 'Euro', 'utilizzata', 'minima', 90, '', 1, 'ricciobatlo.jpg', 'kekko '),
(10, 'Castello San Giorgio', 'Lisbona', '', 'tram', 15, 'Euro', 'utilissima', 'minima', 150, 'Iniziate il vostro tour di Lisbona con il piede giusto e raggiungete lo splendido castello di San Giorgio, eretto su una collina nel quartiere di Alfama. Nel viaggio verso la collina potrete osservare l’intera valle, attraversare il famoso Bairro Alto e ammirare dall’alto il fiume Tago. Giunti in vetta, il panorama è mozzafiato, come le affascinanti rovine del castello. Assistendo ad una proiezione sulla storia del castello potete scoprire il ruolo fondamentale che ha ricoperto nel corso dei secoli per lo sviluppo della città.', 0, 'ricciocastellosangiorgio.jpg', ''),
(10, 'palazzo di cristallo', 'Madrid', '', 'metro', 15, 'Euro', 'utile', 'media', 100, 'Bella ma niente di emozionante, non so sicuramente sarà un fatto di gusti. Personalmente non mi ha entusiasmato. La cosa bella che ha è che si trova in un bellissimo parco! ', 2, 'ricciomad35.jpg', 'rocco2 paolo1 '),
(10, 'Palazzo Reale', 'Madrid', '', 'metro', 18, 'Euro', 'utile', 'minima', 60, 'Luoghi suggestivi che riportano tutta la magia della corte reale. Di gran pregio soprattutto la sala del trono, l''armeria e la collezione Stradivari. Ottima la possibilità di poter entrare gratuitamente dopo le 16:00', 1, 'ricciopalreale.jpg', 'paolo1 '),
(10, 'Parc Guell', 'Barcellona', '', 'metro e auto', 14, 'Euro', 'utile', 'alta', 240, '', 0, 'ricciogaudi.jpg', ''),
(10, 'Puerta del Angel', 'Madrid', 'www.puertadelangel.es', 'metro', 0, 'Euro', '', 'media', 20, 'Questo è sicuramente uno dei posti piu belli della stupenda Madrid.', 2, 'ricciopuertalca.jpeg', 'pippo paolo1 '),
(10, 'Sagrada Familia', 'Barcellona', 'www.sagradafamilia.es', 'metro', 12, 'Euro', 'non utilizzata', 'media', 100, 'consiglio vivamente di andarlaa visitare', 1, 'ricciosagradafam.jpeg', 'kekko '),
(11, 'Auditorium Niccolo Paganini', 'Parma', 'www.auditoriumpaganini.it', 'autobus', 14, 'Euro', '', 'media', 0, 'Questo auditorium è stato progettato da Renzo Piano nella zona dello zuccherificio Eridania e inaugurato nel 2001. L''architetto ha voluto mantenere tracce della memoria storica, così come molti architetti fanno, riutilizzando le mura e quindi la forma dello stabilimento. L''interno però è stato riprogettato e adibito ad Auditorium. L''ingresso è delimitato da una grande parete vetrata, e un''altra parete vetrata la si trova anche alle spalle del palcoscenico permettendo allo spettatore di godere contemporaneamente della musica e della vista della natura circostante il teatro. L''acustica è molto buona e curata nei minimi dettagli; le poltroncine rosse sono comode.\r\n', 1, 'ricciopaganini.jpeg', 'dario '),
(11, 'Torri degli Asinelli', 'Bologna', '', '', 0, 'Euro', 'utile', 'alta', 100, 'In un mondo di modernità e di tecnologie avanzate ci rendiamo conto, visitandole, di come sia stato ancor più mirabile la costruzione di queste tipologie di torri. 498 scalini, anche un po’ angusti, per percorrere i circa 97 metri di altezza e rendersi conto di questa struttura tanto semplice nella sua tipologia architettonica quanto bella ed ammirevole. Il costo del...', 0, 'ricciotorreasinelli.jpeg', ''),
(12, 'Acquarium', 'Dubai', 'www.dubaiacquarium.com', 'automobile', 15, 'Euro', 'non serve', 'minima', 160, '', 0, '', ''),
(12, 'Miracle Garden', 'Dubai', '', '', 10, 'Dollaro US', '', 'minima', 200, 'Uno tra i giardini piu grandi del mondo.....veramente emozionante', 0, 'paolo1miraclegarden.jpeg', ''),
(12, 'Sky Tree', 'Tokyo', 'www.skytree.com', 'metro', 0, 'Euro', '', 'minima', 45, 'Inaugurata nel 2012, con un''altezza di 634 metri, la Tokyo Tower è la torre più alta del mondo. Dal primo piano, a 350 metri di altezza, si ha una vista panoramica di Tokyo. Al secondo piano, a 450 metri, lo sky walkway, un percorso con pareti trasparenti, consente una vera e propria passeggiata sospesa da cui ammirare tutto i distretto...', 0, 'paolo1skytree.jpeg', ''),
(12, 'Tower Sakura', 'Tokyo', '', 'auto', 15, 'Euro', '', 'minima', 40, 'Struttura molto bella ed elegante con giardino interno bellissimo. La camera era molto spaziosa, accogliente e pulitissima. Il personale sempre attento e gentilissimo. Posizione davvero comoda a 5 minuti a piedi dalla stazione Tokyo Shinagawa. Prezzo davvero conveniente. Ci ritornerò con piacere.', 0, 'paolo1towersakura.jpeg', ''),
(13, ' Asam''s Church', 'Monaco', 'www.asamchurch.com', 'metro', 12, 'Euro', 'utile', 'minima', 50, 'Questa chiesa è sicuramente la più bella di Monaco. È molto piccola, si tratta quasi di una cappella privata, fu finanziata dai due fratelli Asam (è nota infatti anche come Asamkirche) che vivevano nel palazzo a sinistra adiacente la chiesa, in questa casa bella e sontuosa, come ringraziamento a San Giovanni Nepomuceno, protettore dei ponti e delle acque, per averli...', 0, 'paolo1asamchurch.jpg', ''),
(13, 'Memoriale Olocausto', 'Berlino', '', 'metro', 0, 'Euro', 'utilissima', 'minima', 180, 'Tappa importantissima per un turista di passaggio a Berlino. Un''opera d''arte semplicemente fantastica dal sapore amaro. Da vedere ', 0, 'paolo1piazzaolocausto.jpeg', ''),
(13, 'Porta di Brandeburgo', 'Berlino', '', 'metro', 0, 'Euro', 'utile', 'minima', 30, 'Abbiamo visitato la porta di Brandeburgo dopo nemmeno un paio d''ore dal nostro arrivo a Berlino. E'' un monumento eccezionale che ti lascia senza fiato. Un pezzo di storia moderna. ', 0, 'paolo1brander.jpg', ''),
(13, 'Stadio Olimpico', 'Berlino', '', 'tram', 25, 'Euro', '', 'minima', 120, '', 0, 'paolo1stdioberlino.jpg', ''),
(13, 'Vecchia Pinacoteca ', 'Monaco', '', 'metro', 0, 'Euro', 'utilissima', 'alta', 140, 'Dell''Alte Pinakoteke mi sono piaciuti moltissimo i quadri di Rubens nella sala riservata ai pittori fiamminghi ma ci sono anche numerosi quadri di pittori italiani in particolare Canaletto. Essendo tantissimi i quadri ho puntato maggiormente l''attenzione sulle scuole che più mi interessavano artisticamente, ma devo dire che vi sono bellissimi quadri sia della scuola tedesca che di quella francese.', 0, 'paolo1vecchiapinacoteca.jpg', ''),
(14, 'Jackson Square', 'New Orleans', '', 'a piedi', 0, 'Euro', 'non utilizzata', 'minima', 40, '', 0, 'rocco2jacksonsquare.jpeg', ''),
(14, 'JFK Library', 'Boston', 'www.jfklibrary.us', 'metro', 16, 'Dollaro US', 'utile', 'media', 90, '', 1, 'rocco2jfklibrary.jpeg', 'pippo '),
(14, 'Museum of Fine Arts', 'Boston', 'www.bostonmuseum.us', 'tram', 15, 'Dollaro US', '', 'media', 150, '', 0, 'rocco2bostonmuseum.jpeg', ''),
(15, 'Partenone', 'Atene', 'www.partenone.gr', 'a piedi', 10, 'Euro', 'utilissima', 'minima', 100, 'Eccolo finalmente l''oggetto del desiderio! Vederlo da vicino è qualcosa di emozionante. Ci si sofferma a pensare quanta storia sia passata per questa imponente struttura. Nei libri non rende come vederla dal vivo. Alcune considerazioni: parecchia fila per poter fare i biglietti; percorso obbligato non privo di difficoltà e privo di recinzioni', 0, 'darioparthenonatene.jpg', ''),
(16, 'colosseo', 'Roma', 'www.colosseo.it', 'metro', 15, 'Euro', 'consigliata', 'minima', 50, 'Come ho sempre immaginato una struttura storica meravigliosa. .. entrare li dentro è favoloso nn puoi andare a roma e nn entrare li!!consiglio a tutti d andare a visitare', 4, 'andrea7colosseo.jpg', 'kekko pippo riccio paolo1 '),
(16, 'Duomo', 'Milano', '', 'metro', 15, 'Euro', 'utilizzata', 'media', 40, 'Girando tra le mura del duomo non si può non notare la meraviglia del tempo...come sia stato possibile creare il tutto con attrezzature rudimentali dell''epoca. Si rimane sbalordi!!', 1, 'andrea7Duomomi.jpg', 'paolo1 '),
(16, 'Teatro alla Scala', 'Milano', 'www.scalamilano.it', 'metro', 28, 'Euro', '', 'alta', 150, 'Che sia un balletto o che sia l''opera vale sempre la pena di andarci per vivere un''atmosfera magica. E se ci si accontenta dei palchetti è anche a portata di tutte le tasche. ', 2, 'andrea7scalat.jpg', 'pippo paolo1 '),
(16, 'uffizi', 'firenze', 'www.uffizi.it', 'tram', 22, 'Euro', 'utile', 'alta', 150, 'Sono stata questa domenica con il mio ragazzo. Da storica dell''arte ritengo un po'' assurdo recensire la Galleria degli Uffizi che è risaputo essere uno dei musei più belli e ricchi del mondo. Ho visitato molte volte la galleria per motivi di studio.', 2, 'andrea7uffizi-gallery.jpg', 'pippo rocco2 '),
(17, 'Palazzo della Pilotta', 'Parma', 'www.palazzopillotta.it', 'auto', 15, 'Euro', 'utile', 'media', 60, '', 5, 'antonypalpill.jpeg', 'kekko pippo riccio rocco2 dario '),
(17, 'Palazzo Ducale', 'Venezia', 'www.palazzoducale.it', 'a piedi', 20, 'Euro', 'utilissima', 'alta', 100, 'bellissima visita guidata attraverso gli itinerari segreti di palazzo ducale. dalle prigioni sotterranee chiamate i pozzi su su a salire fino ai piombi . ottima la nostra guida Stefania che ci ha spiegato con grande competenza sia l''itinerario che i particolari della storia veneziana. Dopo la visita guidata accesso libero a tutto il palazzo ducale con passaggio anche dal ponte!!!', 3, 'antonypalazzoducale.jpeg', 'riccio paolo1 dario '),
(17, 'Piazza San Marco', 'Venezia', '', 'a piedi', 0, 'Euro', 'non serve', 'minima', 40, 'San Marco la piazza più importante della bella Venezia. Ubicata dalla parte opposta della Stazione Ferroviaria o di Piazzale Roma, appena uno si addentra al centro della piazza si rende subito conto di quanto è bella. Guardandola da Canal Grande vedi subito la sua maestosità. Passaggio d''obbligo!!', 4, 'antonypiazzasanm.jpeg', 'kekko pippo paolo1 dario ');

-- --------------------------------------------------------

--
-- Struttura della tabella `segnalazioni`
--

CREATE TABLE IF NOT EXISTS `segnalazioni` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `autore` varchar(20) NOT NULL,
  `segnalato` varchar(40) DEFAULT NULL,
  `idviaggio` int(20) DEFAULT NULL,
  `citta` varchar(30) DEFAULT NULL,
  `luogo` varchar(30) DEFAULT NULL,
  `idcommento` int(20) DEFAULT NULL,
  `motivo` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dump dei dati per la tabella `segnalazioni`
--

INSERT INTO `segnalazioni` (`id`, `autore`, `segnalato`, `idviaggio`, `citta`, `luogo`, `idcommento`, `motivo`) VALUES
(1, 'kekko', 'riccio', 10, 'Barcellona', 'Sagrada Familia', 0, 'Commento non appropriato'),
(2, 'kekko', 'antony', 17, 'Parma', 'Palazzo della Pilotta', 0, 'Foto non appropriata'),
(3, 'kekko', 'andrea7', 16, 'Milano', 'Duomo', 0, 'Commento non appropriato'),
(4, 'kekko', 'antony', 17, 'Venezia', 'Piazza San Marco', 0, 'Attenzione foto non appropriata'),
(5, 'kekko', 'andrea7', 16, 'Roma', 'colosseo', 0, 'commento volgare'),
(6, 'pippo', 'riccio', 10, '', '', 0, 'Costo della vacanza 0 mi sembra strano'),
(7, 'pippo', 'kekko', 6, 'firenze', '', 0, 'Informazioni errate'),
(8, 'pippo', 'kekko', 6, 'roma', '', 0, 'Informazioni errate'),
(9, 'pippo', 'antony', 17, 'Parma', 'Palazzo della Pilotta', 0, 'foto non veritiera'),
(10, 'pippo', 'rocco2', 14, 'Boston', 'JFK Library', 0, 'sito web errato'),
(11, 'pippo', 'kekko', 6, 'roma', '', 0, 'informazioni errate'),
(12, 'riccio', 'andrea7', 16, '', '', 0, 'viaggio inappropriato'),
(13, 'riccio', 'pippo', 0, '', '', 9, 'Commento inutile'),
(14, 'rocco2', 'pippo', 0, '', '', 9, 'commento inutile'),
(15, 'paolo1', 'andrea7', 16, '', '', 0, 'informazioni errate'),
(16, 'paolo1', 'andrea7', 16, 'Milano', '', 0, 'informazioni errate'),
(17, 'paolo1', 'riccio', 0, '', '', 14, 'commento inutile');

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
  `lavoro` varchar(30) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `sesso` varchar(10) DEFAULT NULL,
  `datanascita` varchar(100) DEFAULT NULL,
  `foto` varchar(1000) DEFAULT NULL,
  `galleria` varchar(1000) DEFAULT NULL,
  `cod_attivazione` varchar(10) DEFAULT NULL,
  `stato` enum('non_attivo','attivo','admin') DEFAULT 'non_attivo',
  `avvertimenti` int(1) DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`username`, `nome`, `cognome`, `residenza`, `nazione`, `mail`, `password`, `lavoro`, `telefono`, `sesso`, `datanascita`, `foto`, `galleria`, `cod_attivazione`, `stato`, `avvertimenti`) VALUES
('andrea7', 'Andrea', 'Bianchetti', 'Padova', 'italia', 'andrea7@gmail.com', '12345678', 'meccanico', '0746 494835', '', '', 'andrea7Arizona2.jpg', 'andrea7CasaBianca1.jpg/andrea7Cascata2.jpg', '1948919469', 'attivo', 0),
('antony', 'Antonio', 'Bennato', 'Napoli', 'italia', 'antony@libero.it', '12345678', 'infermiere', '', '', '', 'antonyCaraibi.jpg', 'antonyForesta.jpg/antonyCitta4.jpg', '1797197755', 'attivo', 0),
('dario', 'Dario', 'Foscolo', 'Udine', 'Italia', 'dario@libero.it', '12345678', 'autista', '', '', '', 'darioCanyon.jpg', 'darioMontagnalago2.jpg/darioCasa.jpg', '562613726', 'attivo', 0),
('kekko', 'Francesco', 'Antonini', 'Rieti', 'italia', 'kekko.a@libero.it', '12345678', 'netturbino', '', '', '12 giugno 1968', 'kekkoFrancia.jpg', 'kekkoHongkong.jpg/kekkoCascata6.jpg', '312863853', 'attivo', 0),
('paolo1', 'Paolo', 'Verdi', 'firenze', 'italia', 'paolo1@hotmail.it', '12345678', 'operaio', '', '', '', 'paolo1Mare1.jpg', 'paolo1Tramonto4.jpg/paolo1Scozia5.jpg', '1961841194', 'attivo', 0),
('pippo', 'filippo', 'rossi', 'milano', 'italia', 'pippo@libero.it', '12345678', 'marinaio', '', '', '', 'pippoUtah.jpg', 'pippoStoneMontainGeorgia.jpg/pippoMaldive.jpg', '1087431978', 'attivo', 0),
('riccio', 'Riccardo', 'Poscente', 'Rieti', 'Italia', 'riccio@libero.it', '12345678', 'imprenditore', '', '', '', 'riccioConnecticut.jpg', 'riccioNevada.jpg/riccioFiumeMaine.jpg', '1613102084', 'attivo', 0),
('rocco2', 'Rocco', 'Di natale', 'Parma', 'italia', 'rocco2@gmail.com', '12345678', 'orafo', '', '', '', 'rocco2Tunisia.jpg', 'rocco2Sidney.jpg/rocco2Tramonto2.jpg', '1769134457', 'attivo', 0),
('root', 'admin', 'admin', 'admin', 'admin', 'admin.egrweg@domain.it', 'administrator', NULL, NULL, NULL, NULL, NULL, NULL, '423940770', 'admin', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `viaggio`
--

CREATE TABLE IF NOT EXISTS `viaggio` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `utenteusername` varchar(40) DEFAULT NULL,
  `datainizio` date DEFAULT NULL,
  `datafine` date DEFAULT NULL,
  `mezzotrasporto` varchar(80) DEFAULT NULL,
  `costotrasporto` int(6) DEFAULT NULL,
  `valutatrasporto` varchar(20) DEFAULT NULL,
  `budget` int(6) DEFAULT NULL,
  `valutabudget` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utente` (`utenteusername`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dump dei dati per la tabella `viaggio`
--

INSERT INTO `viaggio` (`id`, `utenteusername`, `datainizio`, `datafine`, `mezzotrasporto`, `costotrasporto`, `valutatrasporto`, `budget`, `valutabudget`) VALUES
(6, 'kekko', '2013-10-03', '2013-11-10', 'Aereo', 50, 'Euro', 500, 'Euro'),
(7, 'kekko', '2013-11-08', '2013-11-23', 'Nave', 156, 'Euro', 1600, 'Dollaro US'),
(8, 'pippo', '2013-09-04', '2013-09-19', 'Camper', 30, 'Euro', 400, 'Euro'),
(9, 'pippo', '2013-11-06', '2013-11-10', 'Autobus', 30, 'Euro', 150, 'Euro'),
(10, 'riccio', '2013-11-01', '2013-11-13', 'Macchina', 0, 'Dollaro AU', 500, 'Dollaro AU'),
(11, 'riccio', '2013-11-14', '2013-11-21', 'Autobus', 15, 'Euro', 150, 'Euro'),
(12, 'paolo1', '2013-11-01', '2013-11-15', 'Moto', 150, 'Yen Giapponese', 1500, 'Yen Giapponese'),
(13, 'paolo1', '2013-10-01', '2013-10-10', 'Macchina', 100, 'Euro', 300, 'Euro'),
(14, 'rocco2', '2013-11-15', '2013-11-18', 'Nave', 50, 'Dollaro US', 1230, 'Dollaro US'),
(15, 'dario', '2013-11-09', '2013-11-11', 'Traghetto', 50, 'Euro', 450, 'Euro'),
(16, 'andrea7', '2013-11-09', '2013-11-21', 'Macchina', 100, 'Euro', 900, 'Euro'),
(17, 'antony', '2013-11-01', '2013-11-10', 'Autobus', 80, 'Euro', 350, 'Euro');
