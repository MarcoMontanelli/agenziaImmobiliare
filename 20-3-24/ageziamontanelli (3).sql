-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 20, 2024 alle 23:07
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

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
-- Struttura della tabella `admin`
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
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`idAdmin`, `nome`, `località`, `tipo`, `id_agenzia`, `email`, `pass`, `verificato`) VALUES
(3, 'admin supremo', 'milano', 'supercapo', NULL, 'montanelli.5marco.studente@itispaleocapa.it', '$2y$10$VFUzjpmuYQid9YLvl042Q.xIko5Co2NbzlLZ2WUwTPCtlt3hR5dQ2', 0),
(5, 'lorenzo ', 'Cassano d\'Adda', 'amministratore ', NULL, 'lorenzo@daniello.com', '$2y$10$Hq7htqPNdxTgUanPkrEFz.hP5KrKWl1VaWcXIwKWvE5G201vUn5wW', 0),
(6, 'mirko', 'bergamo', 'imbianchino', NULL, 'vdsvgdsgvsed@com.cmdd', '$2y$10$6hJSATN5dZLtHFgo3J/7w.4e3RPw1RxSwV6NBwRtEeAaI.K9nds1S', 0),
(7, 'mirkog', 'bergamog', 'imbianchinog', NULL, 'vdsvgdsgvsed@com.cmddg', '$2y$10$Nqspv8g3X0fuVextkzOumOECb9kqDZxgIVuLEwKFa8vspR/x31LNq', 0),
(8, 'mirkogg', 'bergamogg', 'imbianchinogg', NULL, 'vdsvgdsgvsed@com.cmddgg', '$2y$10$wIT2DJzgDFnroaBgMVo6gO5bG6p7R4d7W5nA47nx0ZoD1wXGYlPka', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `agenziaprovvisoria`
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
-- Dump dei dati per la tabella `agenziaprovvisoria`
--

INSERT INTO `agenziaprovvisoria` (`idAgenziap`, `nome`, `partitaIva`, `indirizzo`, `numeroTelefono`, `email`, `nomeProprietario`, `località`, `emailAg`, `passAg`, `pass`) VALUES
(17, 'marco', '1234567895', 'via montanelli 32', '12345432325', 'yoxihog912@vip4e.coml', 'marinello', 'Bergamo ', NULL, NULL, '$2y$10$E8PZmwwrA5E9LXJW.JbNr.Lr0otiyiXUSHBnYWnwLufBVsIdxTN0e');

-- --------------------------------------------------------

--
-- Struttura della tabella `agenzia_immobiliare`
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
  `verificato` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `agenzia_immobiliare`
--

INSERT INTO `agenzia_immobiliare` (`idAgenzia`, `nome`, `partitaIva`, `indirizzo`, `numeroTelefono`, `email`, `nomeProprietario`, `località`, `pass`, `verificato`) VALUES
(6, 'asad', '4324324', 'fdasdfvdsvv', '342356357', 'gsadgsdg@cmcm.c', 'erqwrw', 'erwqerqw', '$2y$10$7jg/N.3HjP8CkH88oRyqSeAak90.tZA1EhORm7xRgDEFTq7GxXB02', 0),
(7, 'asadscds', '432432432', 'fdasdfvdsvvddc', '34235635754', 'gsadgsdg@cmcm.cdfd', 'erqwrwff', 'erwqerqwff', '$2y$10$phwcFbqiZlBmGFUXbJNhpuSH9Df/1UT7JuhZ0fG7npBZULnd4UV/y', 0),
(8, 'asadscdsdd', '43243243244', 'fdasdfvdsvvddcsd', '342356357545', 'gsadgsdg@cmcm.cdfdedsd', 'erqwrwffdsf', 'erwqerqwffsf', '$2y$10$rXPp6aleumDYEbJZoLKth.O965n2xgorextzh5nlIEzT3VkumUTU6', 0),
(9, 'wwww', '5555666', 'dfgfsgdf', '88888888888', 'gs55555@cm.cm', 'ernesto', 'beergamo', '$2y$10$z.FXb8OZYzvymalo9shSOeIxk.mbSTP8pxA2ef7lr4.kCl7kTs9kO', 0),
(11, 'dgrhj', '5754754', 'dfsjgfash', '46437485545', 'marcommmm.o@gmail.com', 'marinellogp', 'Bergamopj', '$2y$10$Y.8LXgANvdBUl8XFCTjBS.Ty16JuwM2SAzj7bSs5/RLLWLOqUT13a', 0),
(12, 'pinotto', '765767444443', 'dsbgb', '299564536345', 'montanelli.marco.studente@itispaleocapa.itl', 'nicolo', 'minalio', '$2y$10$sy7ouClLay4IL7G693TjXu4AkdUjaL/gVi30W3Aw5ng4sa/xIiFYG', 0),
(13, 'dacfsdfadf', '43243425234', 'fdsfsdwfdsaw', '4423444444', 'fgfsdgfsgs@cock.com', 'fdfadsfda', 'dswffgsdg', '$2y$10$/JMpLWdPH03qqOM.E.A/LexLMy6jMRc6G5zcPTjk30II3TPsi8hLW', 0),
(14, 'copcococococ', '6536346436', 'fdsfsdwfdsawfdafsd', '578467356346', 'vdsvgdsgvsed@com.cm', 'fdfadsfdaddsa', 'bergamino', '$2y$10$fSmR3waVibWU8VaJUyF8WObfQ7x5qnPQbCCqxBDj1G4Ji2jvVjtRm', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `annuncio`
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
-- Dump dei dati per la tabella `annuncio`
--

INSERT INTO `annuncio` (`idAnnuncio`, `descrizione`, `immagine`, `titolo`, `immagini`, `proprietà_id`) VALUES
(46, 'volpi', 'uploads/IMG-20230801-WA0051.jpg', 'stefano', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `annuncioir`
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
-- Dump dei dati per la tabella `annuncioir`
--

INSERT INTO `annuncioir` (`idAnnuncioIr`, `titolo`, `tagsRicerca`, `descrizione`, `ImmobileR_id`, `dataCreazione`, `dataUltimaModifica`) VALUES
(1, 'VILLA CAMPINETTEpE', 'VILLA BELLAPP', 'BARCELLINO', '1234566998', '2024-02-28 20:51:18', '2024-02-28 20:51:18'),
(2, 'VILLA CAMPINETTEpEg', 'VILLA BELLAPPg', 'BARCELLINOooo', '1234566991', '2024-02-28 22:43:50', '2024-02-28 22:43:50'),
(3, 'VILLA CAMPINETTEpEgyt', 'VILLA BELLAPPgg', 'BARCELLINOoooj', '12345669919', '2024-02-28 22:50:50', '2024-02-28 22:50:50'),
(4, 'VILLA CAMPINETTE32', 'VILLA BELLAdddd', 'bambiono', '123231234', '2024-02-28 22:58:13', '2024-02-28 22:58:13'),
(5, 'VILLA CAMPINETTE325', 'VILLA BELLAddddg', 'bambionop', '1232312343', '2024-02-28 23:00:53', '2024-02-28 23:00:53'),
(6, 'VILLA CAMPINETTE', 'VILLA BELLA', 'ccccccock', '123456699866', '2024-03-17 10:04:21', '2024-03-17 10:04:21'),
(7, 'VILLA CAMPINETTEe', 'VILLA BELLAg', 'ccccccockl', '1234566998667', '2024-03-17 10:18:10', '2024-03-17 10:18:10'),
(8, 'VILLA CAMPINETTEe7', 'VILLA BELLAgfg', 'ccccccockl', '12345669986677', '2024-03-17 10:25:52', '2024-03-17 10:25:52'),
(9, 'VILLA CAMPINEfffTTE', 'VILLA BELLAfff', 'fdafdfedf', '1223124444', '2024-03-17 10:38:31', '2024-03-17 10:38:31');

-- --------------------------------------------------------

--
-- Struttura della tabella `cantina`
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
-- Struttura della tabella `cliente`
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
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nome`, `ragioneSociale`, `numeroTelefono`, `email`, `preferiti`, `pass`, `verificato`) VALUES
(5, 'montanelli', 'montanelli immobiliare', '2323435121', 'montanelli.marco.studente@itispaleocapa.iti', NULL, '$2y$10$NmNxICRWMP9el9kAHasf4uWZe5ZdE/oW7vdfV9uZs4JwwUqi/QUKS', 0),
(6, 'adriano ', 'adriano', '674783560', 'adriano68@gmail.com', NULL, '$2y$10$kaPHe4FfpmkYAJVbzNcGYekRXQO..neNO1txISVfFC.4bcZh0oQCi', 0),
(8, 'Marco Montanellif', 'marco22', '432635424', 'teresa.casari@icloud.cum', NULL, '$2y$10$8aKY4t5wcT3wJAyETEdT1.Gsq9pwcB8YUxatQX9midq3sraUbMC5G', 0),
(9, 'Marco Montanellimm', 'fgsdgdfg', '45432452341345', 'gfdgsdg@com.cock', NULL, '$2y$10$HkWahf4IyTD/ct5JNsbxYOzQzxBC4TCKmzj5ZQ/WS77IZenwpV90.', 0),
(10, 'Marco Montanellill', 'andrea22', '123456765', 'teresa.casari@icloud.comll', NULL, '$2y$10$FN4kSelPbjqscrJOiOeLS.s46WM1dwheX8tXXBAcS5jEFF7jWf/lu', 0),
(11, 'Marco Montanellikkk', '432rfdsasdf', '53416423132214', 'vdsvgdsgvsed@com.cmgsfg', NULL, '$2y$10$DJ0mK7GOCiLfKwKjOXREFOIbe7D/ddrCO9GRG4ALUT4oy5jZupTc6', 0),
(12, 'sfdgdsfds', 'ggsdfgsedg', '433144431', 'fgfsdgfsgs@cock.comcvzxc', NULL, '$2y$10$fbF7B9mX9kQinRulIM91NuEY0TEbx1hexRr8ywcku5Wy1l.4mIhpG', 0),
(13, 'fsafsafs', 'dsgfdsfhg', '232324325', 'vdsvgdsgvsed@com.cmh', NULL, '$2y$10$jR.5A1Hrwum0rBFUwHaAae5pFQ8Ek./EBTxKLgeRBsmU7gaU0XyN6', 0),
(14, 'fsafsafsd', 'dsgfdsfhgff', '2323243257', 'vdsvgdsgvsed@com.cmhgg', NULL, '$2y$10$/V0cG5KG1HmgjJxYHsUM7Ouly/C4oefc20hqtA7d4lrWNfPXWywL6', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `garageproprieta`
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
-- Struttura della tabella `immagine`
--

CREATE TABLE `immagine` (
  `idImmagine` int(11) NOT NULL,
  `pathImmagine` varchar(255) DEFAULT NULL,
  `annuncio_id` int(11) DEFAULT NULL,
  `idAnnuncio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `immaginiannuncio`
--

CREATE TABLE `immaginiannuncio` (
  `idImmagine` int(11) NOT NULL,
  `pathImmagine` text NOT NULL,
  `AnnuncioIr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `immobiliresidenziali`
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
-- Dump dei dati per la tabella `immobiliresidenziali`
--

INSERT INTO `immobiliresidenziali` (`codiceCatastale`, `tipologia`, `comune`, `indirizzo`, `numeroLocali`, `numeroBagni`, `prezzo`, `dimensioni`, `numeroPostiAuto`, `annoCostruzione`, `pianiTotali`, `classeEnergetica`, `giardino`, `ascensore`, `balcone`, `allarme`, `inferriate`, `portoncinoBlindato`, `ariaCondizionata`, `internet`, `latitudine`, `longitudine`) VALUES
('1223124444', 'Villa Singola', 'fffff', 'Via campinette 32', 5, 5, 507774, 555, 555, 55555, 5555, 'D', 1, 1, 1, 1, 1, 1, 1, 1, 51.501084865647535, -0.0982475350610912),
('123231234', 'Villa Singola', 'Bergamod', 'Via campinette 32d', 1, 1, 507774, 40, 2, 2004, 2, 'B', 1, 1, 1, 1, 1, 1, 1, 0, 51.486941636341456, -0.13961794786155227),
('1232312343', 'Appartamento', 'Bergamod5', 'Via campinette 32dg', 1, 1, 507774, 40, 2, 2004, 2, 'B', 1, 1, 1, 1, 1, 1, 1, 0, 51.499660050014434, -0.1191616093274206),
('123456698', 'Villa Singola', 'Bergamo', 'Via campinette 32', 3, 2, 8000000, 234, 4, 2009, 2, 'A', 1, 0, 0, 1, 0, 1, 1, 1, 51.50283019659229, -0.09515763027593493),
('123456699', 'Villa Bifamiliare', 'Bergamop', 'Via campinette 324', 2, 4, 80000050, 239, 3, 2008, 3, 'A', 1, 1, 1, 1, 1, 1, 1, 1, 51.50051494213075, -0.09721756679937245),
('1234566991', 'Appartamento', 'BergamopOg', 'Via campinette 32456', 9, 9, 50777, 236, 9, 2024, 9, 'B', 1, 1, 1, 1, 1, 1, 1, 1, 51.5042549065934, -0.10219574673101307),
('12345669919', 'Villa Singola', 'BergamopOggg', 'Via campinette 32456g', 9, 9, 50777, 236, 9, 2024, 9, 'B', 1, 1, 1, 1, 1, 1, 1, 1, 51.58474991408093, -0.11032110080122949),
('1234566998', 'Villa Singola', 'BergamopO', 'Via campinette 3245', 7, 4, 8000507, 232, 8, 2022, 6, 'B', 1, 1, 1, 1, 1, 1, 1, 1, 51.50201096474784, -0.09738922817632557),
('123456699866', 'Appartamento', 'Bergamo', 'Via campinette 32', 3, 3, 507774, 8000, 4, 2002, 7, 'A', 1, 1, 1, 1, 1, 1, 1, 1, 51.51835715389317, -0.10957718593999745),
('1234566998667', 'Villa Singola', 'Bergamog', 'Via campinette 32g', 8, 8, 50777488, 80008, 48, 20026, 79, 'C', 1, 1, 1, 1, 1, 1, 1, 1, 51.50660558430045, -0.09326935512945056),
('12345669986677', 'Villa Bifamiliare', 'Bergamog5', 'Via campinette 32g7', 8, 8, 50777488, 80008, 48, 20026, 79, 'C', 1, 1, 1, 1, 1, 1, 1, 1, 51.51750259650432, -0.08554459316655993);

-- --------------------------------------------------------

--
-- Struttura della tabella `interagiscecon`
--

CREATE TABLE `interagiscecon` (
  `id_cliente` int(11) DEFAULT NULL,
  `id_annuncio` int(11) DEFAULT NULL,
  `dataM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `inviaa`
--

CREATE TABLE `inviaa` (
  `id_Agenzia` int(11) DEFAULT NULL,
  `id_messaggio` int(11) DEFAULT NULL,
  `dataM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `inviac`
--

CREATE TABLE `inviac` (
  `id_cliente` int(11) DEFAULT NULL,
  `id_messaggio` int(11) DEFAULT NULL,
  `dataM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `inviap`
--

CREATE TABLE `inviap` (
  `id_proprietario` int(11) DEFAULT NULL,
  `id_messaggio` int(11) DEFAULT NULL,
  `dataM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `legge`
--

CREATE TABLE `legge` (
  `id_Agenzia` int(11) DEFAULT NULL,
  `id_messaggio` int(11) DEFAULT NULL,
  `dataM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
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
-- Struttura della tabella `possiede`
--

CREATE TABLE `possiede` (
  `proprietà_cc` int(11) DEFAULT NULL,
  `proprietario_cf` int(11) DEFAULT NULL,
  `percentualeProprieta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `proprieta`
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
-- Dump dei dati per la tabella `proprieta`
--

INSERT INTO `proprieta` (`codiceCatastale`, `indirizzo`, `comune`, `prezzo`, `descrizione`, `tipo`, `dimensioni`, `note`) VALUES
(12346521, 'via mauro gavazzeni 29', 'Bergamo', 14000000, 'itis paleocapa', 'scuola', 269, 'in vendita dal 21-1-24'),
(439804076, 'via montanelli 324', 'Milano', 700000, 'quadrilocale in centro ', 'appartamento', 200, 'di nuova realizzazione');

-- --------------------------------------------------------

--
-- Struttura della tabella `proprietario`
--

CREATE TABLE `proprietario` (
  `codiceFiscale` int(11) NOT NULL,
  `nome` text DEFAULT NULL,
  `numeroTelefono` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `proprietario`
--

INSERT INTO `proprietario` (`codiceFiscale`, `nome`, `numeroTelefono`, `email`, `note`) VALUES
(16, 'marcello', '234546734', 'montanelli.marco.studente@itispaleocapa.itl', 'non disponibile'),
(18, 'zini filippo', '3453245323245', 'zini.filippo24@gmail.com', 'reperibile h 24');

-- --------------------------------------------------------

--
-- Struttura della tabella `pubblica`
--

CREATE TABLE `pubblica` (
  `id_Agenzia` int(11) DEFAULT NULL,
  `id_Annuncio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `verificaad`
--

CREATE TABLE `verificaad` (
  `id_admin` int(11) NOT NULL,
  `codiceVerifica` varchar(10) DEFAULT NULL,
  `verificato` tinyint(1) DEFAULT 0,
  `scadenza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `verificaag`
--

CREATE TABLE `verificaag` (
  `id_agenzia` int(11) NOT NULL,
  `codiceVerifica` varchar(10) DEFAULT NULL,
  `verificato` tinyint(1) DEFAULT 0,
  `scadenza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `verificaag`
--

INSERT INTO `verificaag` (`id_agenzia`, `codiceVerifica`, `verificato`, `scadenza`) VALUES
(8, '0e0c1e', 0, '2024-02-27 12:57:30'),
(13, '486b10', 0, '2024-02-27 17:53:51'),
(17, 'f1cbeb', 0, '2024-01-25 10:08:08');

-- --------------------------------------------------------

--
-- Struttura della tabella `verificacl`
--

CREATE TABLE `verificacl` (
  `id_cliente` int(11) NOT NULL,
  `codiceVerifica` varchar(10) DEFAULT NULL,
  `verificato` tinyint(1) DEFAULT 0,
  `scadenza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `verificacl`
--

INSERT INTO `verificacl` (`id_cliente`, `codiceVerifica`, `verificato`, `scadenza`) VALUES
(10, '49531a', 0, '2024-02-27 18:46:42'),
(11, 'e80f08', 0, '2024-02-27 18:57:44'),
(12, '95dc84', 0, '2024-02-27 18:58:05'),
(13, 'aa1f09', 0, '2024-02-27 19:01:58');

-- --------------------------------------------------------

--
-- Struttura della tabella `visita`
--

CREATE TABLE `visita` (
  `id_cliente` int(11) DEFAULT NULL,
  `idVisita` int(11) NOT NULL,
  `dataM` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD UNIQUE KEY `id_agenzia` (`id_agenzia`);

--
-- Indici per le tabelle `agenziaprovvisoria`
--
ALTER TABLE `agenziaprovvisoria`
  ADD PRIMARY KEY (`idAgenziap`),
  ADD UNIQUE KEY `numeroTelefono` (`numeroTelefono`) USING HASH,
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD UNIQUE KEY `emailAg` (`emailAg`) USING HASH,
  ADD UNIQUE KEY `passAg` (`passAg`) USING HASH,
  ADD UNIQUE KEY `pass` (`pass`) USING HASH;

--
-- Indici per le tabelle `agenzia_immobiliare`
--
ALTER TABLE `agenzia_immobiliare`
  ADD PRIMARY KEY (`idAgenzia`),
  ADD UNIQUE KEY `numeroTelefono` (`numeroTelefono`) USING HASH,
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD UNIQUE KEY `unique_pass` (`pass`) USING HASH;

--
-- Indici per le tabelle `annuncio`
--
ALTER TABLE `annuncio`
  ADD PRIMARY KEY (`idAnnuncio`),
  ADD KEY `fk_annuncio_proprieta` (`proprietà_id`);

--
-- Indici per le tabelle `annuncioir`
--
ALTER TABLE `annuncioir`
  ADD PRIMARY KEY (`idAnnuncioIr`),
  ADD KEY `ImmobileR_id` (`ImmobileR_id`);

--
-- Indici per le tabelle `cantina`
--
ALTER TABLE `cantina`
  ADD PRIMARY KEY (`idcantina`),
  ADD UNIQUE KEY `proprieta_id` (`proprieta_id`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `numeroTelefono` (`numeroTelefono`) USING HASH;

--
-- Indici per le tabelle `garageproprieta`
--
ALTER TABLE `garageproprieta`
  ADD PRIMARY KEY (`idGarage`),
  ADD UNIQUE KEY `proprieta_id` (`proprieta_id`);

--
-- Indici per le tabelle `immagine`
--
ALTER TABLE `immagine`
  ADD PRIMARY KEY (`idImmagine`),
  ADD KEY `annuncio_id` (`annuncio_id`),
  ADD KEY `idAnnuncio` (`idAnnuncio`);

--
-- Indici per le tabelle `immaginiannuncio`
--
ALTER TABLE `immaginiannuncio`
  ADD PRIMARY KEY (`idImmagine`),
  ADD KEY `AnnuncioIr_id` (`AnnuncioIr_id`);

--
-- Indici per le tabelle `immobiliresidenziali`
--
ALTER TABLE `immobiliresidenziali`
  ADD PRIMARY KEY (`codiceCatastale`);

--
-- Indici per le tabelle `interagiscecon`
--
ALTER TABLE `interagiscecon`
  ADD UNIQUE KEY `id_cliente` (`id_cliente`),
  ADD UNIQUE KEY `id_annuncio` (`id_annuncio`);

--
-- Indici per le tabelle `inviaa`
--
ALTER TABLE `inviaa`
  ADD UNIQUE KEY `id_Agenzia` (`id_Agenzia`),
  ADD UNIQUE KEY `id_messaggio` (`id_messaggio`);

--
-- Indici per le tabelle `inviac`
--
ALTER TABLE `inviac`
  ADD UNIQUE KEY `id_cliente` (`id_cliente`),
  ADD UNIQUE KEY `id_messaggio` (`id_messaggio`);

--
-- Indici per le tabelle `inviap`
--
ALTER TABLE `inviap`
  ADD UNIQUE KEY `id_proprietario` (`id_proprietario`),
  ADD UNIQUE KEY `id_messaggio` (`id_messaggio`);

--
-- Indici per le tabelle `legge`
--
ALTER TABLE `legge`
  ADD UNIQUE KEY `id_Agenzia` (`id_Agenzia`),
  ADD UNIQUE KEY `id_messaggio` (`id_messaggio`);

--
-- Indici per le tabelle `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`idMessaggio`),
  ADD UNIQUE KEY `admin_id` (`admin_id`);

--
-- Indici per le tabelle `possiede`
--
ALTER TABLE `possiede`
  ADD UNIQUE KEY `proprietà_cc` (`proprietà_cc`),
  ADD UNIQUE KEY `proprietario_cf` (`proprietario_cf`);

--
-- Indici per le tabelle `proprieta`
--
ALTER TABLE `proprieta`
  ADD PRIMARY KEY (`codiceCatastale`);

--
-- Indici per le tabelle `proprietario`
--
ALTER TABLE `proprietario`
  ADD PRIMARY KEY (`codiceFiscale`),
  ADD UNIQUE KEY `numeroTelefono` (`numeroTelefono`) USING HASH,
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indici per le tabelle `pubblica`
--
ALTER TABLE `pubblica`
  ADD UNIQUE KEY `id_Agenzia` (`id_Agenzia`),
  ADD UNIQUE KEY `id_Annuncio` (`id_Annuncio`);

--
-- Indici per le tabelle `verificaad`
--
ALTER TABLE `verificaad`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `id_admin` (`id_admin`) USING BTREE,
  ADD UNIQUE KEY `codiceVerifica` (`codiceVerifica`);

--
-- Indici per le tabelle `verificaag`
--
ALTER TABLE `verificaag`
  ADD PRIMARY KEY (`id_agenzia`),
  ADD UNIQUE KEY `id_agenzia` (`id_agenzia`) USING BTREE,
  ADD UNIQUE KEY `codiceVerifica` (`codiceVerifica`);

--
-- Indici per le tabelle `verificacl`
--
ALTER TABLE `verificacl`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `id_cliente` (`id_cliente`) USING BTREE,
  ADD UNIQUE KEY `codiceVerifica` (`codiceVerifica`);

--
-- Indici per le tabelle `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`idVisita`),
  ADD UNIQUE KEY `idVisita` (`idVisita`),
  ADD UNIQUE KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `agenziaprovvisoria`
--
ALTER TABLE `agenziaprovvisoria`
  MODIFY `idAgenziap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `agenzia_immobiliare`
--
ALTER TABLE `agenzia_immobiliare`
  MODIFY `idAgenzia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `annuncio`
--
ALTER TABLE `annuncio`
  MODIFY `idAnnuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT per la tabella `annuncioir`
--
ALTER TABLE `annuncioir`
  MODIFY `idAnnuncioIr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `cantina`
--
ALTER TABLE `cantina`
  MODIFY `idcantina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `garageproprieta`
--
ALTER TABLE `garageproprieta`
  MODIFY `idGarage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `idImmagine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `immaginiannuncio`
--
ALTER TABLE `immaginiannuncio`
  MODIFY `idImmagine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `idMessaggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `proprieta`
--
ALTER TABLE `proprieta`
  MODIFY `codiceCatastale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT per la tabella `proprietario`
--
ALTER TABLE `proprietario`
  MODIFY `codiceFiscale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_agenzia`) REFERENCES `agenzia_immobiliare` (`idAgenzia`);

--
-- Limiti per la tabella `annuncio`
--
ALTER TABLE `annuncio`
  ADD CONSTRAINT `annuncio_ibfk_1` FOREIGN KEY (`proprietà_id`) REFERENCES `proprieta` (`codiceCatastale`),
  ADD CONSTRAINT `fk_annuncio_proprieta` FOREIGN KEY (`proprietà_id`) REFERENCES `proprieta` (`codiceCatastale`);

--
-- Limiti per la tabella `annuncioir`
--
ALTER TABLE `annuncioir`
  ADD CONSTRAINT `annuncioir_ibfk_1` FOREIGN KEY (`ImmobileR_id`) REFERENCES `immobiliresidenziali` (`codiceCatastale`);

--
-- Limiti per la tabella `cantina`
--
ALTER TABLE `cantina`
  ADD CONSTRAINT `cantina_ibfk_1` FOREIGN KEY (`proprieta_id`) REFERENCES `proprieta` (`codiceCatastale`);

--
-- Limiti per la tabella `garageproprieta`
--
ALTER TABLE `garageproprieta`
  ADD CONSTRAINT `garageproprieta_ibfk_1` FOREIGN KEY (`proprieta_id`) REFERENCES `proprieta` (`codiceCatastale`);

--
-- Limiti per la tabella `immagine`
--
ALTER TABLE `immagine`
  ADD CONSTRAINT `immagine_ibfk_1` FOREIGN KEY (`annuncio_id`) REFERENCES `annuncio` (`idAnnuncio`),
  ADD CONSTRAINT `immagine_ibfk_2` FOREIGN KEY (`idAnnuncio`) REFERENCES `annuncio` (`idAnnuncio`);

--
-- Limiti per la tabella `immaginiannuncio`
--
ALTER TABLE `immaginiannuncio`
  ADD CONSTRAINT `immaginiannuncio_ibfk_1` FOREIGN KEY (`AnnuncioIr_id`) REFERENCES `annuncioir` (`idAnnuncioIr`);

--
-- Limiti per la tabella `interagiscecon`
--
ALTER TABLE `interagiscecon`
  ADD CONSTRAINT `interagiscecon_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `interagiscecon_ibfk_2` FOREIGN KEY (`id_annuncio`) REFERENCES `annuncio` (`idAnnuncio`);

--
-- Limiti per la tabella `inviaa`
--
ALTER TABLE `inviaa`
  ADD CONSTRAINT `inviaa_ibfk_1` FOREIGN KEY (`id_Agenzia`) REFERENCES `agenzia_immobiliare` (`idAgenzia`),
  ADD CONSTRAINT `inviaa_ibfk_2` FOREIGN KEY (`id_messaggio`) REFERENCES `messaggio` (`idMessaggio`);

--
-- Limiti per la tabella `inviac`
--
ALTER TABLE `inviac`
  ADD CONSTRAINT `inviac_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `inviac_ibfk_2` FOREIGN KEY (`id_messaggio`) REFERENCES `messaggio` (`idMessaggio`);

--
-- Limiti per la tabella `inviap`
--
ALTER TABLE `inviap`
  ADD CONSTRAINT `inviap_ibfk_1` FOREIGN KEY (`id_proprietario`) REFERENCES `proprietario` (`codiceFiscale`),
  ADD CONSTRAINT `inviap_ibfk_2` FOREIGN KEY (`id_messaggio`) REFERENCES `messaggio` (`idMessaggio`);

--
-- Limiti per la tabella `legge`
--
ALTER TABLE `legge`
  ADD CONSTRAINT `legge_ibfk_1` FOREIGN KEY (`id_Agenzia`) REFERENCES `agenzia_immobiliare` (`idAgenzia`),
  ADD CONSTRAINT `legge_ibfk_2` FOREIGN KEY (`id_messaggio`) REFERENCES `messaggio` (`idMessaggio`);

--
-- Limiti per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  ADD CONSTRAINT `messaggio_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`idAdmin`);

--
-- Limiti per la tabella `possiede`
--
ALTER TABLE `possiede`
  ADD CONSTRAINT `possiede_ibfk_1` FOREIGN KEY (`proprietà_cc`) REFERENCES `proprieta` (`codiceCatastale`),
  ADD CONSTRAINT `possiede_ibfk_2` FOREIGN KEY (`proprietario_cf`) REFERENCES `proprietario` (`codiceFiscale`);

--
-- Limiti per la tabella `pubblica`
--
ALTER TABLE `pubblica`
  ADD CONSTRAINT `pubblica_ibfk_1` FOREIGN KEY (`id_Agenzia`) REFERENCES `agenzia_immobiliare` (`idAgenzia`),
  ADD CONSTRAINT `pubblica_ibfk_2` FOREIGN KEY (`id_Annuncio`) REFERENCES `annuncio` (`idAnnuncio`);

--
-- Limiti per la tabella `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idCliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
