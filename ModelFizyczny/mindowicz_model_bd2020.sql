
-- Struktura tabeli `samochod`
DROP TABLE IF EXISTS `samochod`;
CREATE TABLE `samochod` (
  `marka` varchar(20),
  `model` varchar(20),
  `vin` varchar(17),
  `forma_wlasnosci` varchar(20),
  `osob_dost` varchar(9),
  `rok_prod` int(4) unsigned,
  `gasnica` varchar(4) ,
  `apteczka_data` date,
  `karta_pojazdu` varchar(4),
  PRIMARY KEY (`vin`)
) DEFAULT CHARSET=utf8;

-- Dane dla tabeli `samochod`
LOCK TABLES `samochod` WRITE;
INSERT INTO `samochod` VALUES('Ford','Fiesta','WF0RXXGCDR8G10516','Leasing','Osobowy','2011','TAK','2022-04-03','TAK');
UNLOCK TABLES;

-- Struktura tabeli `wyposazenie`
DROP TABLE IF EXISTS `wyposazenie`;
CREATE TABLE `wyposazenie` (
  `rodzaj_wypos` varchar(20),
  `opis_wypos` varchar(20),
  `vin_auto` varchar(17),
  KEY `vin_dla_auta`(`vin_auto`),
  CONSTRAINT `wypos_auta_1` FOREIGN KEY (`vin_auto`) REFERENCES `samochod` (`vin`) ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

-- Dane dla tabeli `wyposazenie`
LOCK TABLES `wyposazenie` WRITE;
INSERT INTO `wyposazenie` VALUES('GPS','TAK','WF0RXXGCDR8G10516');
UNLOCK TABLES;

-- Struktura tabeli `dowod_rejestr`
DROP TABLE IF EXISTS `dowod_rejestr`;
CREATE TABLE `dowod_rejestr` (
  `przeglad_waznosc` date,
  `numer_rejestr` varchar(8),
  `auto_vin` varchar(17) NOT NULL,
  KEY `vin_do_auta`(`auto_vin`),
  CONSTRAINT `rejestr_auta_1` FOREIGN KEY (`auto_vin`) REFERENCES `samochod` (`vin`) ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

-- Dane dla tabeli `dowod_rejestr`
LOCK TABLES `dowod_rejestr` WRITE;
INSERT INTO `dowod_rejestr` VALUES('2020-05-21','DW213ZX','WF0RXXGCDR8G10516');
UNLOCK TABLES;

-- Struktura tabeli `polisa_oc`
DROP TABLE IF EXISTS `polisa_oc`;
CREATE TABLE `polisa_oc` (
  `polisa_waznosc` date,
  `firma_ubezp` varchar(20),
  `vin_aut` varchar(17) NOT NULL,
  KEY `vin_do_auta`(`vin_aut`),
  CONSTRAINT `polisa_auta_1` FOREIGN KEY (`vin_aut`) REFERENCES `samochod` (`vin`) ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

-- Dane dla tabeli `polisa_oc`
LOCK TABLES `polisa_oc` WRITE;
INSERT INTO `polisa_oc` VALUES('2020-05-21','AXA','WF0RXXGCDR8G10516');
UNLOCK TABLES;

-- Struktura tabeli `pracownik`
DROP TABLE IF EXISTS `pracownik`;
CREATE TABLE `pracownik` (
  `imie` varchar(20),
  `nazwisko` varchar(20),
  `numer_tel` varchar(9),
  `e_mail` varchar(40),
  `zatrudnienie` varchar(15),
  PRIMARY KEY (`e_mail`)
  ) DEFAULT CHARSET=utf8;
  
-- Dane dla tabeli `pracownik`
LOCK TABLES `pracownik` WRITE;
INSERT INTO `pracownik` VALUES('Jan','Kowalski','342932293','jan.kowalski@firma.pl','Umowa o Prace');
UNLOCK TABLES;
  
  -- Struktura tabeli `pobiera`
DROP TABLE IF EXISTS `pobiera`;
CREATE TABLE `pobiera` (
  `data_pobrania` date,
  `data_oddania` date,
  `vin_do_auta` varchar(17) NOT NULL,
  `email_pracownika` varchar(40) NOT NULL,
  KEY `vin_dla_auta`(`vin_do_auta`),
  KEY `email_do_pracownika`(`email_pracownika`),
  CONSTRAINT `pobor_auta_1` FOREIGN KEY (`vin_do_auta`) REFERENCES `samochod` (`vin`) ON UPDATE CASCADE,
  CONSTRAINT `pobor_auta_2` FOREIGN KEY (`email_pracownika`) REFERENCES `pracownik` (`e_mail`) ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

-- Dane dla tabeli `pobiera`
LOCK TABLES `pobiera` WRITE;
INSERT INTO `pobiera` VALUES('2020-04-28','2020-05-04','WF0RXXGCDR8G10516','jan.kowalski@firma.pl');
UNLOCK TABLES;
