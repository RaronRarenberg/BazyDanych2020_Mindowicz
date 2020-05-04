-- Bez tej linijki pokazywal sie blad powtarzania sie klucza przy uzyciu polecenia source na istniejacej juz bazie
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

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
/*!40000 ALTER TABLE `samochod` DISABLE KEYS */;
INSERT INTO `samochod` VALUES('Ford','Fiesta','WF0RXXGCDR8G10516','Leasing','Osobowy','2011','TAK','2022-04-03','NIE'),
('Seat','Leon','VSSZZZ5FZGR131860','Wlasnosc firmy','Osobowy','2015','TAK','2021-12-06','TAK'),
('Volkswagen','Transporter','WVWZZZ1KZCW256847','Leasing','Dostawczy','2013','TAK','2020-06-07','NIE'),
('Skoda','Octavia','TMBJJ7NE5G0164515','Leasing','Osobowy','2012','TAK','2022-07-03','NIE'),
('Ford','Transit','WF0FXXWPCFFY71839','Wlasnosc firmy','Dostawczy','2016','TAK','2023-11-10','TAK');
/*!40000 ALTER TABLE `samochod` ENABLE KEYS */;
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
/*!40000 ALTER TABLE `samochod` DISABLE KEYS */;
INSERT INTO `wyposazenie` VALUES('Nadajnik GPS','TAK','WF0RXXGCDR8G10516'),
('Nadajnik GPS','NIE','VSSZZZ5FZGR131860'),
('Nadajnik GPS','TAK','WVWZZZ1KZCW256847'),
('Nadajnik GPS','TAK','TMBJJ7NE5G0164515'),
('Nadajnik GPS','TAK','WF0FXXWPCFFY71839');
/*!40000 ALTER TABLE `samochod` ENABLE KEYS */;
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
/*!40000 ALTER TABLE `samochod` DISABLE KEYS */;
INSERT INTO `dowod_rejestr` VALUES('2020-05-21','DW213ZX','WF0RXXGCDR8G10516'),
('2021-03-17','DW246NJ','VSSZZZ5FZGR131860'),
('2022-02-01','GD65UWR','WVWZZZ1KZCW256847'),
('2020-08-12','GD420DQ','TMBJJ7NE5G0164515'),
('2023-09-09','DW912RV','WF0FXXWPCFFY71839');
/*!40000 ALTER TABLE `samochod` ENABLE KEYS */;
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
/*!40000 ALTER TABLE `samochod` DISABLE KEYS */;
INSERT INTO `polisa_oc` VALUES('2020-05-21','AXA','WF0RXXGCDR8G10516'),
('2021-03-17','Aviva','VSSZZZ5FZGR131860'),
('2022-02-01','UNIQA','WVWZZZ1KZCW256847'),
('2020-08-12','LINK4','TMBJJ7NE5G0164515'),
('2023-09-09','Allianz','WF0FXXWPCFFY71839');
/*!40000 ALTER TABLE `samochod` ENABLE KEYS */;
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
/*!40000 ALTER TABLE `samochod` DISABLE KEYS */;
INSERT INTO `pracownik` VALUES('Jan','Kowalski','342932293','jan.kowalski@firma.pl','Umowa o Prace'),
('Jan','Nowak','484619416','jan.nowak@firma.pl','Umowa o Prace'),
('Zdzisław','Duda','174285963','zdzislaw.duda@firma.pl','Umowa o Prace'),
('Sobiesław','Zasada','753951456','sobieslaw.zasada@firma.pl','B2B'),
('Wiesław','Wiertar','369258147','wieslaw.wiertar@firma.pl','B2B');
/*!40000 ALTER TABLE `samochod` ENABLE KEYS */;
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
INSERT INTO `pobiera` VALUES('2020-04-28','2020-05-04','WF0RXXGCDR8G10516','jan.kowalski@firma.pl'),
('2020-04-24','2020-05-05','VSSZZZ5FZGR131860','jan.nowak@firma.pl'),
('2020-02-14','2020-02-17','WVWZZZ1KZCW256847','zdzislaw.duda@firma.pl'),
('2020-02-20','2020-03-01','TMBJJ7NE5G0164515','sobieslaw.zasada@firma.pl'),
('2020-04-28',NULL,'WF0FXXWPCFFY71839','wieslaw.wiertar@firma.pl'); -- Tutaj NULL po prostu oznacza, ze samochod nie zostal oddany
UNLOCK TABLES;

-- Przywracamy sprawdzanie kluczy
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;