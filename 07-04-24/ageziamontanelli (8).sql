-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 11:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ageziamontanelli`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `nome` text DEFAULT NULL,
  `località` text DEFAULT NULL,
  `tipo` text DEFAULT NULL,
  `id_agenzia` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `verificato` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idAdmin`, `nome`, `località`, `tipo`, `id_agenzia`, `email`, `pass`, `verificato`) VALUES
(3, 'admin supremo', 'milano', 'supercapo', NULL, 'montanelli.5marco.studente@itispaleocapa.it', '$2y$10$VFUzjpmuYQid9YLvl042Q.xIko5Co2NbzlLZ2WUwTPCtlt3hR5dQ2', 0),
(5, 'lorenzo ', 'Cassano d\'Adda', 'amministratore ', NULL, 'lorenzo@daniello.com', '$2y$10$Hq7htqPNdxTgUanPkrEFz.hP5KrKWl1VaWcXIwKWvE5G201vUn5wW', 0),
(6, 'mirko', 'bergamo', 'imbianchino', NULL, 'vdsvgdsgvsed@com.cmdd', '$2y$10$6hJSATN5dZLtHFgo3J/7w.4e3RPw1RxSwV6NBwRtEeAaI.K9nds1S', 0),
(7, 'mirkog', 'bergamog', 'imbianchinog', NULL, 'vdsvgdsgvsed@com.cmddg', '$2y$10$Nqspv8g3X0fuVextkzOumOECb9kqDZxgIVuLEwKFa8vspR/x31LNq', 0),
(8, 'mirkogg', 'bergamogg', 'imbianchinogg', NULL, 'vdsvgdsgvsed@com.cmddgg', '$2y$10$wIT2DJzgDFnroaBgMVo6gO5bG6p7R4d7W5nA47nx0ZoD1wXGYlPka', 1),
(9, 'marcello', 'Gromlongo', 'camion', NULL, 'marcello@gmail.com', '$2y$10$vZcLwJtGstAG/fi7Q6pu9OdJ3YU0RycfBykxUm7alCR31wFN9TIoW', 1),
(10, 'cockino', 'via campinette 325', 'capanna', NULL, 'teresa.mantanelli@icloud.com', '$2y$10$8Y.oPaHyjuyLnBkRkf3YZuLsiSUF/ayFGs1YYL2PtLZl6Vac3cO7q', 1),
(13, 'dsdddd', NULL, 'dfddfdf', NULL, 'dffdfdf@lol.vom', '$2y$10$YwTX4GRLkHOPKsC7p4yd9e2iATcdrUj4ojTBF36.7ISBlg8EVsJ.G', NULL),
(14, 'fffffddf', NULL, 'gfdfgfgd', NULL, 'teresa.casari@icloud.comlhg', '$2y$10$TmmhD8BGwm258xI8qX3JqeFH.Eswhl2C9vYt1TXtHX5v8UtMnIOqK', NULL),
(16, 'dddsdssd', 'dsdsdsds', 'sddsdsdsds', NULL, 'marco.montanelli05@gmail.compo', '$2y$10$GdCnSfIUFGEk.gVH.QAdPe0FduKhOG25/d4n/5eZMERNWjc1bxGAW', 1);

-- --------------------------------------------------------

--
-- Table structure for table `agenziaprovvisoria`
--

CREATE TABLE `agenziaprovvisoria` (
  `idAgenziap` int(11) NOT NULL,
  `nome` text DEFAULT 'NOMEIMPRESA',
  `partitaIva` text DEFAULT NULL,
  `indirizzo` text DEFAULT NULL,
  `numeroTelefono` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `nomeProprietario` text DEFAULT NULL,
  `località` text DEFAULT NULL,
  `emailAg` text DEFAULT NULL,
  `passAg` text DEFAULT NULL,
  `pass` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agenziaprovvisoria`
--

INSERT INTO `agenziaprovvisoria` (`idAgenziap`, `nome`, `partitaIva`, `indirizzo`, `numeroTelefono`, `email`, `nomeProprietario`, `località`, `emailAg`, `passAg`, `pass`) VALUES
(17, 'marco', '1234567895', 'via montanelli 32', '12345432325', 'yoxihog912@vip4e.coml', 'marinello', 'Bergamo ', NULL, NULL, '$2y$10$E8PZmwwrA5E9LXJW.JbNr.Lr0otiyiXUSHBnYWnwLufBVsIdxTN0e');

-- --------------------------------------------------------

--
-- Table structure for table `agenzia_immobiliare`
--

CREATE TABLE `agenzia_immobiliare` (
  `idAgenzia` int(11) NOT NULL,
  `nome` text DEFAULT 'NOMEIMPRESA',
  `partitaIva` text DEFAULT NULL,
  `indirizzo` text DEFAULT NULL,
  `numeroTelefono` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `nomeProprietario` text DEFAULT NULL,
  `località` text DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `verificato` tinyint(1) DEFAULT 0,
  `fotoProfilo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agenzia_immobiliare`
--

INSERT INTO `agenzia_immobiliare` (`idAgenzia`, `nome`, `partitaIva`, `indirizzo`, `numeroTelefono`, `email`, `nomeProprietario`, `località`, `pass`, `verificato`, `fotoProfilo`) VALUES
(6, 'asad', '4324324', 'fdasdfvdsvv', '342356357', 'gsadgsdg@cmcm.c', 'erqwrw', 'erwqerqw', '$2y$10$7jg/N.3HjP8CkH88oRyqSeAak90.tZA1EhORm7xRgDEFTq7GxXB02', 0, NULL),
(7, 'asadscds', '432432432', 'fdasdfvdsvvddc', '34235635754', 'gsadgsdg@cmcm.cdfd', 'erqwrwff', 'erwqerqwff', '$2y$10$phwcFbqiZlBmGFUXbJNhpuSH9Df/1UT7JuhZ0fG7npBZULnd4UV/y', 0, NULL),
(8, 'asadscdsdd', '43243243244', 'fdasdfvdsvvddcsd', '342356357545', 'gsadgsdg@cmcm.cdfdedsd', 'erqwrwffdsf', 'erwqerqwffsf', '$2y$10$rXPp6aleumDYEbJZoLKth.O965n2xgorextzh5nlIEzT3VkumUTU6', 0, NULL),
(9, 'wwww', '5555666', 'dfgfsgdf', '88888888888', 'gs55555@cm.cm', 'ernesto', 'beergamo', '$2y$10$z.FXb8OZYzvymalo9shSOeIxk.mbSTP8pxA2ef7lr4.kCl7kTs9kO', 0, NULL),
(11, 'dgrhj', '5754754', 'dfsjgfash', '46437485545', 'marcommmm.o@gmail.com', 'marinellogp', 'Bergamopj', '$2y$10$Y.8LXgANvdBUl8XFCTjBS.Ty16JuwM2SAzj7bSs5/RLLWLOqUT13a', 0, NULL),
(12, 'pinotto', '765767444443', 'dsbgb', '299564536345', 'montanelli.marco.studente@itispaleocapa.itl', 'nicolo', 'minalio', '$2y$10$sy7ouClLay4IL7G693TjXu4AkdUjaL/gVi30W3Aw5ng4sa/xIiFYG', 0, NULL),
(13, 'dacfsdfadf', '43243425234', 'fdsfsdwfdsaw', '4423444444', 'fgfsdgfsgs@cock.com', 'fdfadsfda', 'dswffgsdg', '$2y$10$/JMpLWdPH03qqOM.E.A/LexLMy6jMRc6G5zcPTjk30II3TPsi8hLW', 0, NULL),
(14, 'copcococococ', '6536346436', 'fdsfsdwfdsawfdafsd', '578467356346', 'vdsvgdsgvsed@com.cm', 'fdfadsfdaddsa', 'bergamino', '$2y$10$fSmR3waVibWU8VaJUyF8WObfQ7x5qnPQbCCqxBDj1G4Ji2jvVjtRm', 0, NULL),
(15, 'Marco Montanelli', '43243425244', 'Via Gusmini', '3203529081', 'marco.montanelli05@gmail.com', 'ernesto', 'Bergamo', '$2y$10$b0ZfiILt2k1JPqsF3ZB8VuSBCFg823tNfuHX4JeLnZIBO9jx7q8Aq', 0, '1711890361_casa3.jpg'),
(16, 'montanelli agenzia', '34234342344', 'via montanelli 1', '9867547324', 'marcoMontanelli@gmail.com', 'marco', 'Bergamo', '$2y$10$hUdQJG0cuUbfzVB2MK/H8um9HXZmTZyoLmW5U066yeILwsDUz60J.', 0, '1711890720_logo 256 256.png'),
(17, 'paleocapa real estate', '4552432352', 'Via Gavazzeni 2', '3204536666', 'marco.montanelli05@gmail.comnf', 'Marco', 'Bergamo', '$2y$10$PBpblXfV7CrYObrAq02eV.kfvI9jwv5yoyIie8vsgPWr5VA9vrra6', 0, '1711894514_casa2.jpg'),
(18, 'Paleoc', '3424234324', 'via Gavazzeni', '4553454534', 'ip@itispaleocapa.it', 'mirko', 'Bergamop', '$2y$10$HZYT7xGUjmE1goGGwtVKi.82kMvBQi9RlHqjRUHVrLfiqwRHHWaiq', 0, ''),
(19, 'andrea immobiliare', '43243242332', 'via corridoni 34', '2442343559', 'sanek87122@lanxi8.comm', 'montanellino', 'Bergamo', '$2y$10$bNKp8WhZugKP0lqNj5zpf.qeJDj2/Y.e38rHYRS6oEo4rTkq5Q5cC', 0, '1712226013_pollo.png');

-- --------------------------------------------------------

--
-- Table structure for table `annuncio`
--

CREATE TABLE `annuncio` (
  `idAnnuncio` int(11) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `immagine` text DEFAULT NULL,
  `titolo` text DEFAULT NULL,
  `immagini` text DEFAULT NULL,
  `proprietà_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `annuncio`
--

INSERT INTO `annuncio` (`idAnnuncio`, `descrizione`, `immagine`, `titolo`, `immagini`, `proprietà_id`) VALUES
(46, 'volpi', 'uploads/IMG-20230801-WA0051.jpg', 'stefano', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `annuncioir`
--

CREATE TABLE `annuncioir` (
  `idAnnuncioIr` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `tagsRicerca` text DEFAULT NULL,
  `descrizione` text NOT NULL,
  `ImmobileR_id` varchar(255) DEFAULT NULL,
  `dataCreazione` timestamp NOT NULL DEFAULT current_timestamp(),
  `dataUltimaModifica` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `annuncioir`
--

INSERT INTO `annuncioir` (`idAnnuncioIr`, `titolo`, `tagsRicerca`, `descrizione`, `ImmobileR_id`, `dataCreazione`, `dataUltimaModifica`) VALUES
(22, 'Prova annunci', 'casa bella', 'Villa bifamiliare con due appartamenti libera subito, la proprietà comprende balconi per dimensioni complessive di 80mq, un giardino con piscina di dimensioni 900mq e un garage da 4 posti', '123456789', '2024-03-25 16:02:45', '2024-03-25 16:02:45'),
(24, 'villa', 'raspberry', 'villa unifamiliare prova desrizione', '545454332222', '2024-03-26 19:02:27', '2024-03-26 19:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `cantina`
--

CREATE TABLE `cantina` (
  `idcantina` int(11) NOT NULL,
  `metratura` int(11) DEFAULT NULL,
  `piano` int(11) DEFAULT NULL,
  `finestra` tinyint(1) DEFAULT NULL,
  `proprieta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nome` text DEFAULT NULL,
  `ragioneSociale` text DEFAULT NULL,
  `numeroTelefono` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `preferiti` text DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `verificato` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nome`, `ragioneSociale`, `numeroTelefono`, `email`, `preferiti`, `pass`, `verificato`) VALUES
(17, 'dfddffddf', 'tertretertre', '3231233120', 'teresa.tasari@icloud.comff', NULL, '$2y$10$1FvUVVhIBaGAmtR.JG8t2OfqXv5HfdySE5Gkg0OMhLa.V5OqrPzky', 1),
(18, 'freddy', 'fazbear', '3203529089', 'marco.montanelli05@gmail.comto', NULL, '$2y$10$8.1dgvaH8wC2sJB2fWIlye0gs5Wp2ygEkYum8t.DcfCWY8iL3WhDu', 1),
(19, 'marcoi', 'adsdfasda', '1231321256', 'teresa.casari@icloud.comsfd', NULL, '$2y$10$rPzhqPiRF3.toOuqWBcT5.jnqzA3nPF82Zh2eo6Uu/nPHR0e2e8r.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `garageproprieta`
--

CREATE TABLE `garageproprieta` (
  `idGarage` int(11) NOT NULL,
  `tipologia` text DEFAULT NULL,
  `piano` int(11) DEFAULT NULL,
  `numeroPosti` int(11) DEFAULT NULL,
  `tipoSaracinesca` text DEFAULT NULL,
  `proprieta_id` int(11) DEFAULT NULL,
  `metratura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `immagine`
--

CREATE TABLE `immagine` (
  `idImmagine` int(11) NOT NULL,
  `pathImmagine` varchar(255) DEFAULT NULL,
  `annuncio_id` int(11) DEFAULT NULL,
  `idAnnuncio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `immaginiannuncio`
--

CREATE TABLE `immaginiannuncio` (
  `idImmagine` int(11) NOT NULL,
  `pathImmagine` text NOT NULL,
  `AnnuncioIr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immaginiannuncio`
--

INSERT INTO `immaginiannuncio` (`idImmagine`, `pathImmagine`, `AnnuncioIr_id`) VALUES
(41, 'uploads/casa1.jpeg', 22),
(42, 'uploads/casa2.jpg', 22),
(43, 'uploads/casa3.jpg', 22),
(47, 'uploads/casa1.jpeg', 24),
(48, 'uploads/DALL·E 2024-03-07 20.20.51 - A digital background featuring a pattern of dragon scales in midnight blue. The design should be minimalist yet detailed enough to suggest the texture.webp', 24),
(49, 'uploads/DALL·E 2024-03-20 21.02.47 - Create a detailed image of a 3D printer in action, showcasing its intricate machinery and the process of creating a 3-dimensional object. The printer .webp', 24),
(50, 'uploads/casa1.jpeg', 24);

-- --------------------------------------------------------

--
-- Table structure for table `immobiliresidenziali`
--

CREATE TABLE `immobiliresidenziali` (
  `codiceCatastale` varchar(255) NOT NULL,
  `tipologia` text NOT NULL,
  `comune` text NOT NULL,
  `indirizzo` text NOT NULL,
  `numeroLocali` int(11) NOT NULL,
  `numeroBagni` int(11) NOT NULL,
  `prezzo` int(11) NOT NULL,
  `dimensioni` int(11) NOT NULL,
  `numeroPostiAuto` int(11) NOT NULL,
  `annoCostruzione` int(11) NOT NULL,
  `pianiTotali` int(11) NOT NULL,
  `classeEnergetica` text NOT NULL,
  `giardino` tinyint(1) NOT NULL DEFAULT 0,
  `ascensore` tinyint(1) NOT NULL DEFAULT 0,
  `balcone` tinyint(1) NOT NULL DEFAULT 0,
  `allarme` tinyint(1) NOT NULL DEFAULT 0,
  `inferriate` tinyint(1) NOT NULL DEFAULT 0,
  `portoncinoBlindato` tinyint(1) NOT NULL DEFAULT 0,
  `ariaCondizionata` tinyint(1) NOT NULL DEFAULT 0,
  `internet` tinyint(1) NOT NULL DEFAULT 0,
  `latitudine` double DEFAULT NULL,
  `longitudine` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immobiliresidenziali`
--

INSERT INTO `immobiliresidenziali` (`codiceCatastale`, `tipologia`, `comune`, `indirizzo`, `numeroLocali`, `numeroBagni`, `prezzo`, `dimensioni`, `numeroPostiAuto`, `annoCostruzione`, `pianiTotali`, `classeEnergetica`, `giardino`, `ascensore`, `balcone`, `allarme`, `inferriate`, `portoncinoBlindato`, `ariaCondizionata`, `internet`, `latitudine`, `longitudine`) VALUES
('123456789', 'Villa Bifamiliare', 'Bergamo', 'via reich', 4, 2, 2000000, 380, 4, 2001, 3, 'A', 1, 1, 1, 1, 1, 1, 1, 1, 45.716637634317884, 9.704443215887297),
('545454332222', 'Villa Singola', 'Bergamo', 'Via corridoni ', 3, 3, 700000, 500, 4, 2001, 2, 'D', 1, 1, 1, 1, 1, 1, 1, 1, 45.705974493158735, 9.6869730927574);

-- --------------------------------------------------------

--
-- Table structure for table `interagiscecon`
--

CREATE TABLE `interagiscecon` (
  `id_cliente` int(11) DEFAULT NULL,
  `id_annuncio` int(11) DEFAULT NULL,
  `dataM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inviaa`
--

CREATE TABLE `inviaa` (
  `id_Agenzia` int(11) DEFAULT NULL,
  `id_messaggio` int(11) DEFAULT NULL,
  `dataM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inviac`
--

CREATE TABLE `inviac` (
  `id_cliente` int(11) DEFAULT NULL,
  `id_messaggio` int(11) DEFAULT NULL,
  `dataM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inviap`
--

CREATE TABLE `inviap` (
  `id_proprietario` int(11) DEFAULT NULL,
  `id_messaggio` int(11) DEFAULT NULL,
  `dataM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `legge`
--

CREATE TABLE `legge` (
  `id_Agenzia` int(11) DEFAULT NULL,
  `id_messaggio` int(11) DEFAULT NULL,
  `dataM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messaggio`
--

CREATE TABLE `messaggio` (
  `idMessaggio` int(11) NOT NULL,
  `dataM` date DEFAULT NULL,
  `contenuto` text DEFAULT NULL,
  `oggetto` text DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `possiede`
--

CREATE TABLE `possiede` (
  `proprietà_cc` int(11) DEFAULT NULL,
  `proprietario_cf` int(11) DEFAULT NULL,
  `percentualeProprieta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proprieta`
--

CREATE TABLE `proprieta` (
  `codiceCatastale` int(11) NOT NULL,
  `indirizzo` text DEFAULT NULL,
  `comune` text DEFAULT NULL,
  `prezzo` int(11) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `tipo` text DEFAULT NULL,
  `dimensioni` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proprieta`
--

INSERT INTO `proprieta` (`codiceCatastale`, `indirizzo`, `comune`, `prezzo`, `descrizione`, `tipo`, `dimensioni`, `note`) VALUES
(12346521, 'via mauro gavazzeni 29', 'Bergamo', 14000000, 'itis paleocapa', 'scuola', 269, 'in vendita dal 21-1-24'),
(439804076, 'via montanelli 324', 'Milano', 700000, 'quadrilocale in centro ', 'appartamento', 200, 'di nuova realizzazione');

-- --------------------------------------------------------

--
-- Table structure for table `proprietario`
--

CREATE TABLE `proprietario` (
  `codiceFiscale` int(11) NOT NULL,
  `nome` text DEFAULT NULL,
  `numeroTelefono` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proprietario`
--

INSERT INTO `proprietario` (`codiceFiscale`, `nome`, `numeroTelefono`, `email`, `note`) VALUES
(16, 'marcello', '234546734', 'montanelli.marco.studente@itispaleocapa.itl', 'non disponibile'),
(18, 'zini filippo', '3453245323245', 'zini.filippo24@gmail.com', 'reperibile h 24');

-- --------------------------------------------------------

--
-- Table structure for table `pubblica`
--

CREATE TABLE `pubblica` (
  `id_Agenzia` int(11) DEFAULT NULL,
  `id_Annuncio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verificaad`
--

CREATE TABLE `verificaad` (
  `id_admin` int(11) NOT NULL,
  `codiceVerifica` varchar(10) DEFAULT NULL,
  `verificato` tinyint(1) DEFAULT 0,
  `scadenza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verificaag`
--

CREATE TABLE `verificaag` (
  `id_agenzia` int(11) NOT NULL,
  `codiceVerifica` varchar(10) DEFAULT NULL,
  `verificato` tinyint(1) DEFAULT 0,
  `scadenza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verificaag`
--

INSERT INTO `verificaag` (`id_agenzia`, `codiceVerifica`, `verificato`, `scadenza`) VALUES
(8, '0e0c1e', 0, '2024-02-27 12:57:30'),
(13, '486b10', 0, '2024-02-27 17:53:51'),
(17, 'f1cbeb', 0, '2024-01-25 10:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `verificacl`
--

CREATE TABLE `verificacl` (
  `id_cliente` int(11) NOT NULL,
  `codiceVerifica` varchar(10) DEFAULT NULL,
  `verificato` tinyint(1) DEFAULT 0,
  `scadenza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verificacl`
--

INSERT INTO `verificacl` (`id_cliente`, `codiceVerifica`, `verificato`, `scadenza`) VALUES
(16, 'f31e74', 0, '2024-04-04 13:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `visita`
--

CREATE TABLE `visita` (
  `id_cliente` int(11) DEFAULT NULL,
  `idVisita` int(11) NOT NULL,
  `dataM` date DEFAULT NULL,
  `idAnnuncioIr_FK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visita`
--

INSERT INTO `visita` (`id_cliente`, `idVisita`, `dataM`, `idAnnuncioIr_FK`) VALUES
(18, 1, '2024-04-09', 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD UNIQUE KEY `id_agenzia` (`id_agenzia`);

--
-- Indexes for table `agenziaprovvisoria`
--
ALTER TABLE `agenziaprovvisoria`
  ADD PRIMARY KEY (`idAgenziap`),
  ADD UNIQUE KEY `numeroTelefono` (`numeroTelefono`) USING HASH,
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD UNIQUE KEY `emailAg` (`emailAg`) USING HASH,
  ADD UNIQUE KEY `passAg` (`passAg`) USING HASH,
  ADD UNIQUE KEY `pass` (`pass`) USING HASH;

--
-- Indexes for table `agenzia_immobiliare`
--
ALTER TABLE `agenzia_immobiliare`
  ADD PRIMARY KEY (`idAgenzia`),
  ADD UNIQUE KEY `numeroTelefono` (`numeroTelefono`) USING HASH,
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD UNIQUE KEY `unique_pass` (`pass`) USING HASH;

--
-- Indexes for table `annuncio`
--
ALTER TABLE `annuncio`
  ADD PRIMARY KEY (`idAnnuncio`),
  ADD KEY `fk_annuncio_proprieta` (`proprietà_id`);

--
-- Indexes for table `annuncioir`
--
ALTER TABLE `annuncioir`
  ADD PRIMARY KEY (`idAnnuncioIr`),
  ADD KEY `ImmobileR_id` (`ImmobileR_id`);

--
-- Indexes for table `cantina`
--
ALTER TABLE `cantina`
  ADD PRIMARY KEY (`idcantina`),
  ADD UNIQUE KEY `proprieta_id` (`proprieta_id`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `numeroTelefono` (`numeroTelefono`) USING HASH;

--
-- Indexes for table `garageproprieta`
--
ALTER TABLE `garageproprieta`
  ADD PRIMARY KEY (`idGarage`),
  ADD UNIQUE KEY `proprieta_id` (`proprieta_id`);

--
-- Indexes for table `immagine`
--
ALTER TABLE `immagine`
  ADD PRIMARY KEY (`idImmagine`),
  ADD KEY `annuncio_id` (`annuncio_id`),
  ADD KEY `idAnnuncio` (`idAnnuncio`);

--
-- Indexes for table `immaginiannuncio`
--
ALTER TABLE `immaginiannuncio`
  ADD PRIMARY KEY (`idImmagine`),
  ADD KEY `AnnuncioIr_id` (`AnnuncioIr_id`);

--
-- Indexes for table `immobiliresidenziali`
--
ALTER TABLE `immobiliresidenziali`
  ADD PRIMARY KEY (`codiceCatastale`);

--
-- Indexes for table `interagiscecon`
--
ALTER TABLE `interagiscecon`
  ADD UNIQUE KEY `id_cliente` (`id_cliente`),
  ADD UNIQUE KEY `id_annuncio` (`id_annuncio`);

--
-- Indexes for table `inviaa`
--
ALTER TABLE `inviaa`
  ADD UNIQUE KEY `id_Agenzia` (`id_Agenzia`),
  ADD UNIQUE KEY `id_messaggio` (`id_messaggio`);

--
-- Indexes for table `inviac`
--
ALTER TABLE `inviac`
  ADD UNIQUE KEY `id_cliente` (`id_cliente`),
  ADD UNIQUE KEY `id_messaggio` (`id_messaggio`);

--
-- Indexes for table `inviap`
--
ALTER TABLE `inviap`
  ADD UNIQUE KEY `id_proprietario` (`id_proprietario`),
  ADD UNIQUE KEY `id_messaggio` (`id_messaggio`);

--
-- Indexes for table `legge`
--
ALTER TABLE `legge`
  ADD UNIQUE KEY `id_Agenzia` (`id_Agenzia`),
  ADD UNIQUE KEY `id_messaggio` (`id_messaggio`);

--
-- Indexes for table `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`idMessaggio`),
  ADD UNIQUE KEY `admin_id` (`admin_id`);

--
-- Indexes for table `possiede`
--
ALTER TABLE `possiede`
  ADD UNIQUE KEY `proprietà_cc` (`proprietà_cc`),
  ADD UNIQUE KEY `proprietario_cf` (`proprietario_cf`);

--
-- Indexes for table `proprieta`
--
ALTER TABLE `proprieta`
  ADD PRIMARY KEY (`codiceCatastale`);

--
-- Indexes for table `proprietario`
--
ALTER TABLE `proprietario`
  ADD PRIMARY KEY (`codiceFiscale`),
  ADD UNIQUE KEY `numeroTelefono` (`numeroTelefono`) USING HASH,
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `pubblica`
--
ALTER TABLE `pubblica`
  ADD UNIQUE KEY `id_Agenzia` (`id_Agenzia`),
  ADD UNIQUE KEY `id_Annuncio` (`id_Annuncio`);

--
-- Indexes for table `verificaad`
--
ALTER TABLE `verificaad`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `id_admin` (`id_admin`) USING BTREE,
  ADD UNIQUE KEY `codiceVerifica` (`codiceVerifica`);

--
-- Indexes for table `verificaag`
--
ALTER TABLE `verificaag`
  ADD PRIMARY KEY (`id_agenzia`),
  ADD UNIQUE KEY `id_agenzia` (`id_agenzia`) USING BTREE,
  ADD UNIQUE KEY `codiceVerifica` (`codiceVerifica`);

--
-- Indexes for table `verificacl`
--
ALTER TABLE `verificacl`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `id_cliente` (`id_cliente`) USING BTREE,
  ADD UNIQUE KEY `codiceVerifica` (`codiceVerifica`);

--
-- Indexes for table `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`idVisita`),
  ADD UNIQUE KEY `idVisita` (`idVisita`),
  ADD UNIQUE KEY `id_cliente` (`id_cliente`),
  ADD KEY `fk_annuncioIr` (`idAnnuncioIr_FK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `agenziaprovvisoria`
--
ALTER TABLE `agenziaprovvisoria`
  MODIFY `idAgenziap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `agenzia_immobiliare`
--
ALTER TABLE `agenzia_immobiliare`
  MODIFY `idAgenzia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `annuncio`
--
ALTER TABLE `annuncio`
  MODIFY `idAnnuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `annuncioir`
--
ALTER TABLE `annuncioir`
  MODIFY `idAnnuncioIr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cantina`
--
ALTER TABLE `cantina`
  MODIFY `idcantina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `garageproprieta`
--
ALTER TABLE `garageproprieta`
  MODIFY `idGarage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `immagine`
--
ALTER TABLE `immagine`
  MODIFY `idImmagine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `immaginiannuncio`
--
ALTER TABLE `immaginiannuncio`
  MODIFY `idImmagine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `idMessaggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proprieta`
--
ALTER TABLE `proprieta`
  MODIFY `codiceCatastale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `proprietario`
--
ALTER TABLE `proprietario`
  MODIFY `codiceFiscale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `visita`
--
ALTER TABLE `visita`
  MODIFY `idVisita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_agenzia`) REFERENCES `agenzia_immobiliare` (`idAgenzia`);

--
-- Constraints for table `annuncio`
--
ALTER TABLE `annuncio`
  ADD CONSTRAINT `annuncio_ibfk_1` FOREIGN KEY (`proprietà_id`) REFERENCES `proprieta` (`codiceCatastale`),
  ADD CONSTRAINT `fk_annuncio_proprieta` FOREIGN KEY (`proprietà_id`) REFERENCES `proprieta` (`codiceCatastale`);

--
-- Constraints for table `annuncioir`
--
ALTER TABLE `annuncioir`
  ADD CONSTRAINT `annuncioir_ibfk_1` FOREIGN KEY (`ImmobileR_id`) REFERENCES `immobiliresidenziali` (`codiceCatastale`);

--
-- Constraints for table `cantina`
--
ALTER TABLE `cantina`
  ADD CONSTRAINT `cantina_ibfk_1` FOREIGN KEY (`proprieta_id`) REFERENCES `proprieta` (`codiceCatastale`);

--
-- Constraints for table `garageproprieta`
--
ALTER TABLE `garageproprieta`
  ADD CONSTRAINT `garageproprieta_ibfk_1` FOREIGN KEY (`proprieta_id`) REFERENCES `proprieta` (`codiceCatastale`);

--
-- Constraints for table `immagine`
--
ALTER TABLE `immagine`
  ADD CONSTRAINT `immagine_ibfk_1` FOREIGN KEY (`annuncio_id`) REFERENCES `annuncio` (`idAnnuncio`),
  ADD CONSTRAINT `immagine_ibfk_2` FOREIGN KEY (`idAnnuncio`) REFERENCES `annuncio` (`idAnnuncio`);

--
-- Constraints for table `immaginiannuncio`
--
ALTER TABLE `immaginiannuncio`
  ADD CONSTRAINT `immaginiannuncio_ibfk_1` FOREIGN KEY (`AnnuncioIr_id`) REFERENCES `annuncioir` (`idAnnuncioIr`);

--
-- Constraints for table `interagiscecon`
--
ALTER TABLE `interagiscecon`
  ADD CONSTRAINT `interagiscecon_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `interagiscecon_ibfk_2` FOREIGN KEY (`id_annuncio`) REFERENCES `annuncio` (`idAnnuncio`);

--
-- Constraints for table `inviaa`
--
ALTER TABLE `inviaa`
  ADD CONSTRAINT `inviaa_ibfk_1` FOREIGN KEY (`id_Agenzia`) REFERENCES `agenzia_immobiliare` (`idAgenzia`),
  ADD CONSTRAINT `inviaa_ibfk_2` FOREIGN KEY (`id_messaggio`) REFERENCES `messaggio` (`idMessaggio`);

--
-- Constraints for table `inviac`
--
ALTER TABLE `inviac`
  ADD CONSTRAINT `inviac_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `inviac_ibfk_2` FOREIGN KEY (`id_messaggio`) REFERENCES `messaggio` (`idMessaggio`);

--
-- Constraints for table `inviap`
--
ALTER TABLE `inviap`
  ADD CONSTRAINT `inviap_ibfk_1` FOREIGN KEY (`id_proprietario`) REFERENCES `proprietario` (`codiceFiscale`),
  ADD CONSTRAINT `inviap_ibfk_2` FOREIGN KEY (`id_messaggio`) REFERENCES `messaggio` (`idMessaggio`);

--
-- Constraints for table `legge`
--
ALTER TABLE `legge`
  ADD CONSTRAINT `legge_ibfk_1` FOREIGN KEY (`id_Agenzia`) REFERENCES `agenzia_immobiliare` (`idAgenzia`),
  ADD CONSTRAINT `legge_ibfk_2` FOREIGN KEY (`id_messaggio`) REFERENCES `messaggio` (`idMessaggio`);

--
-- Constraints for table `messaggio`
--
ALTER TABLE `messaggio`
  ADD CONSTRAINT `messaggio_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`idAdmin`);

--
-- Constraints for table `possiede`
--
ALTER TABLE `possiede`
  ADD CONSTRAINT `possiede_ibfk_1` FOREIGN KEY (`proprietà_cc`) REFERENCES `proprieta` (`codiceCatastale`),
  ADD CONSTRAINT `possiede_ibfk_2` FOREIGN KEY (`proprietario_cf`) REFERENCES `proprietario` (`codiceFiscale`);

--
-- Constraints for table `pubblica`
--
ALTER TABLE `pubblica`
  ADD CONSTRAINT `pubblica_ibfk_1` FOREIGN KEY (`id_Agenzia`) REFERENCES `agenzia_immobiliare` (`idAgenzia`),
  ADD CONSTRAINT `pubblica_ibfk_2` FOREIGN KEY (`id_Annuncio`) REFERENCES `annuncio` (`idAnnuncio`);

--
-- Constraints for table `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `fk_annuncioIr` FOREIGN KEY (`idAnnuncioIr_FK`) REFERENCES `annuncioir` (`idAnnuncioIr`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idCliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
