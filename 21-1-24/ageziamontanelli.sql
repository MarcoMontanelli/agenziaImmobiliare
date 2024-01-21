-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 21, 2024 alle 23:32
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
  `emailA` text DEFAULT NULL,
  `passA` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `emailAg` text DEFAULT NULL,
  `passAg` text DEFAULT NULL,
  `pass` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(36, 'prova', 'uploads/DSC00593 - Copia.JPG', 'marco', NULL, NULL),
(38, 'prova', 'uploads/logo 256 256.png', 'marco', NULL, NULL);

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
  `emailC` text DEFAULT NULL,
  `passC` text DEFAULT NULL,
  `pass` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(111111111, '29 Via Mauro Gavazzeni', 'Bergamo', 10000000, 'itis paleocapa bergamo', 'scuola', 500, 'in vendita dal 15-1-24');

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
-- Struttura della tabella `verificaag`
--

CREATE TABLE `verificaag` (
  `id_agenzia` int(11) NOT NULL,
  `codiceVerifica` varchar(10) DEFAULT NULL,
  `verificato` tinyint(1) DEFAULT 0,
  `scadenza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD UNIQUE KEY `id_agenzia` (`id_agenzia`),
  ADD UNIQUE KEY `emailA` (`emailA`) USING HASH,
  ADD UNIQUE KEY `passA` (`passA`) USING HASH;

--
-- Indici per le tabelle `agenzia_immobiliare`
--
ALTER TABLE `agenzia_immobiliare`
  ADD PRIMARY KEY (`idAgenzia`),
  ADD UNIQUE KEY `numeroTelefono` (`numeroTelefono`) USING HASH,
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD UNIQUE KEY `emailAg` (`emailAg`) USING HASH,
  ADD UNIQUE KEY `passAg` (`passAg`) USING HASH,
  ADD UNIQUE KEY `unique_pass` (`pass`) USING HASH;

--
-- Indici per le tabelle `annuncio`
--
ALTER TABLE `annuncio`
  ADD PRIMARY KEY (`idAnnuncio`),
  ADD KEY `fk_annuncio_proprieta` (`proprietà_id`);

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
  ADD UNIQUE KEY `numeroTelefono` (`numeroTelefono`) USING HASH,
  ADD UNIQUE KEY `emailC` (`emailC`) USING HASH,
  ADD UNIQUE KEY `passC` (`passC`) USING HASH;

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
-- Indici per le tabelle `verificaag`
--
ALTER TABLE `verificaag`
  ADD PRIMARY KEY (`id_agenzia`),
  ADD UNIQUE KEY `id_agenzia` (`id_agenzia`),
  ADD UNIQUE KEY `codiceVerifica` (`codiceVerifica`);

--
-- Indici per le tabelle `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`idVisita`),
  ADD UNIQUE KEY `id_cliente` (`id_cliente`),
  ADD UNIQUE KEY `idVisita` (`idVisita`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `agenzia_immobiliare`
--
ALTER TABLE `agenzia_immobiliare`
  MODIFY `idAgenzia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `annuncio`
--
ALTER TABLE `annuncio`
  MODIFY `idAnnuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT per la tabella `cantina`
--
ALTER TABLE `cantina`
  MODIFY `idcantina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `codiceFiscale` int(11) NOT NULL AUTO_INCREMENT;

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
-- Limiti per la tabella `verificaag`
--
ALTER TABLE `verificaag`
  ADD CONSTRAINT `verificaag_ibfk_1` FOREIGN KEY (`id_agenzia`) REFERENCES `agenzia_immobiliare` (`idAgenzia`);

--
-- Limiti per la tabella `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idCliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
