-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2015 at 07:58 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `museum`
--

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `autor_id` int(10) unsigned NOT NULL,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`autor_id`, `vorname`, `nachname`) VALUES
(1, 'Biography.com', 'Editors'),
(2, 'Sybille', 'Krämer'),
(3, 'Eberhard', 'Fennel'),
(4, 'Horst-Dieter', 'Brähmig'),
(5, 'Wilhelm', 'Mons'),
(6, 'Horst', 'Zuse'),
(7, 'Hermann', 'Flessner'),
(8, 'Jürgen', 'Alex'),
(9, 'Kurt', 'Pauli'),
(10, 'Klaus', 'Kemper'),
(11, 'Veronika', 'Oechtering'),
(12, 'Barry', 'Cooper'),
(13, 'Jan', 'van Leeuwen'),
(14, 'Michael-Thomas', 'Liske'),
(15, 'Anne', 'Kunze');

-- --------------------------------------------------------

--
-- Table structure for table `benutzer`
--

CREATE TABLE IF NOT EXISTS `benutzer` (
  `benutzer_id` smallint(5) unsigned NOT NULL,
  `benutzername` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `passwort` varchar(100) DEFAULT NULL,
  `rolle_id` int(11) NOT NULL,
  `erstellt_am` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `letzter_besuch` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bilder`
--

CREATE TABLE IF NOT EXISTS `bilder` (
  `bild_id` int(10) unsigned NOT NULL,
  `bild_link` varchar(100) NOT NULL,
  `beschreibung` text,
  `person_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `informatiker`
--

CREATE TABLE IF NOT EXISTS `informatiker` (
  `informatiker_id` int(10) unsigned NOT NULL,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `geburtsdatum` date DEFAULT NULL,
  `geburtsort` varchar(50) DEFAULT NULL,
  `todesdatum` date DEFAULT NULL,
  `todesort` varchar(50) DEFAULT NULL,
  `zitat` varchar(1000) DEFAULT NULL,
  `k_beschreibung` varchar(50) DEFAULT NULL,
  `l_beschreibung` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `informatiker_kategorie`
--

CREATE TABLE IF NOT EXISTS `informatiker_kategorie` (
  `inf_kat_id` smallint(5) unsigned NOT NULL,
  `informatiker` int(10) unsigned NOT NULL,
  `kategorie` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\n';

-- --------------------------------------------------------

--
-- Table structure for table `informatiker_quelle`
--

CREATE TABLE IF NOT EXISTS `informatiker_quelle` (
  `informatiker_quelle_id` int(11) NOT NULL,
  `informatiker` int(10) unsigned NOT NULL,
  `quelle` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kategorie`
--

CREATE TABLE IF NOT EXISTS `kategorie` (
  `kategorie_id` smallint(5) unsigned NOT NULL,
  `kategorie_name` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='\n';

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`kategorie_id`, `kategorie_name`) VALUES
(1, 'Mathematiker/in'),
(2, 'Computerpionier/in'),
(3, 'Ingenieur/in'),
(4, 'Erfinder/in'),
(5, 'Unternehmer/in');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(10) unsigned NOT NULL,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `geburtsdatum` date DEFAULT NULL,
  `geburtsort` varchar(50) DEFAULT NULL,
  `todesdatum` date DEFAULT NULL,
  `todesort` varchar(50) DEFAULT NULL,
  `k_beschreibung` varchar(500) DEFAULT NULL,
  `l_beschreibung` varchar(1000) DEFAULT NULL,
  `titel` set('Prof.','Dr.') DEFAULT NULL,
  `geschlecht` set('f','m') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `vorname`, `nachname`, `geburtsdatum`, `geburtsort`, `todesdatum`, `todesort`, `k_beschreibung`, `l_beschreibung`, `titel`, `geschlecht`) VALUES
(1, 'Ada', 'Lovelace', '1815-12-10', 'London', '1852-11-27', 'London', 'Lovelace veröffentlichte als erste ein Programm für einen Rechner und legte\n\ndie theoretischen Grundlagen für automatisierte Programmabläufe.', 'Lovelace kommt aus einer Adelsfamilie und erhält früh eine\n\nnaturwissenschaftliche Ausbildung. Aufgrund ihrer Interessen entwickelte sie \n\nbald Kontakte zu wissenschaftsorientierten Kreisen.\n\n 1843 übersetzt Lovelace „Analytical Engine“ mit umfangreichen \n\nKommentierungen ins Englische. Der Artikel enthält die Beschreibung  einer \n\nmechanischen Rechenmaschine von Charles Babbage. Daneben entwickelt \n\nsie mit Babbage ein Programm zur Berechnung der Bernoulli-Zahlen mittels \n\nder Rechenmaschine. \n\nAdas systematisierte Abfolge von mathematischen  Operationen bildet bis \n\nheute die Grundlage der Programmierung. Außerdem liefert sie wichtige \n\ntheoretische Beiträge im Bereich der Rechenarchitektur. Sie beschäftigt sich \n\nmit der Bedeutung der Rechenmaschine für die Gesellschaft, als auch mit \n\neinzelnen Systemkomponenten.\n\nIhre Überlegungen erhalten zu ihren Lebzeiten wenig Aufmerksamkeit. Sie \n\nstirbt mit 37 Jahren an Krebs.', NULL, 'f'),
(2, 'Konrad', 'Zuse', '1910-06-22', 'Berlin-Wilmersdorf', '1995-12-18', 'Hünfeld', 'Zuse war ein deutscher Computerpionier, der als erster einen\r\n\r\nvollautomatischen und frei programmierbaren Digitalrechner baute.', 'Nach seinem Ingenieurstudium bis 1935 baut Zuse im elterlichen Haus eine\r\n\r\nprogrammierbare Rechenmaschine. Die Z1 arbeitete mit binärer \r\n\r\nGleitkommaarithmetik, besaß ein Ein- und Ausgabewerk, ein Rechenwerk, \r\n\r\nsowie ein Speicher- und ein Programmwerk. Aufgrund mechanischer \r\n\r\nProbleme war die Z1 jedoch nicht voll funktionsfähig. \r\n\r\nDer erste funktionsfähige Digitalrechner ist die Z3, die Zuse zusammen mit \r\n\r\nHelmut Schreyer 1941 baut. Die Z3 wird im Gegensatz zur Z1 über \r\n\r\nelektromagnetische Relaistechnik betrieben. \r\n\r\nBis 1945 entwickelte Zuse eine Algorithmensprache, das sogenannte \r\n\r\nPlankalkül, das als Vorlage für höhere Programmiersprachen gedient hat.\r\n\r\n 1949 gründet Zuse die Zuse KG, die 1956 mit der Serienfertigung begann und \r\n\r\nEuropa mit den ersten Computern belieferte.', 'Dr.', 'm'),
(3, 'Heinz', 'Nixdorf', '1925-04-09', 'Paderborn', '1986-03-17', 'Hannover', 'Nixdorf schuf aus einfachen Verhältnissen kommend eine internationale Computerfirma, die den Durchbruch der Kleinrechner förderte.', '1952 brach Nixdorf als mittelloser Student sein Physikstudium ab um mit 27 Jahren ein eigenes Computerlabor zu gründen. Bereits als Werkstudent arbeitete er an der Entwicklung einfacher Rechner mit und konnte so sein eigenes Konzept eines Elektronenrechners aus Röhren emtwerfem. 1954 verkaufte das Labor für Impulstechnik den ersten in Deutschland gebauten Röhrencomputer an die Buchhaltung der Rheinisch-Westfälischen Elektrizitätswerke.Das Unternehmen entwickelte sich schnell zu einem Zulieferer für elektronische Rechenwerke. Trotz finanzieller Engpässe und der Konkurrenz von Großunternehmen wuchs das Labor bis 1961 auf 50 Mitarbeiter. 1965 wurde der erste Tischrechner präsentiert, wobei der auf Halbleitertechnik basierender Kleincomputer des Entwicklungsingenieurs Otto Müller eine technische Revolution auslöste. Mit der Übernahme der Wanderwerke 1968 wurde die Nixdorf Computer AG gegründet. Durch die Übernahme eines amerikanischen Unternehmens konnte Nixdorf auf den amerikanischen Mark', NULL, 'm'),
(4, 'Grace Brewster', 'Hopper', '1906-12-09', 'New York', '1992-01-01', 'Arlinton', 'Als herausragende Computerspezialistin entwickelte Hopper viele Pionierprojekte in der Computertechnik und programmierte den ersten Compiler.', 'Hopper schlug nach ihrem Studium der Mathematik und Physik eine wissenschaftliche Laufbahn ein. Nach der Promotion 1934 an der Yale University, unterrichtet sie Mathematik am Vassar College. Während des 2. Weltkriegs beginnt Hopper eine militärische Ausbildung und arbeitet zeitgleich an der Harvard Universität im Computerlabor. In den folgenden Jahren spezialisiert sie sich auf die Programmierung und entwickelt den ersten Compiler 1957. Nach einer beruflichen Tätigkeit in der Wirtschaft geht sie in den Ruhestand. Hopper wird jedoch vom amerikanischen Militär wieder in den aktiven Dienst gerufen und arbeitet bis ins hohe Alter als Computerspezialistin. Als herausragende Pionierin in der Entwicklung moderner Computersysteme erhielt sie zahlreiche Auszeichnungen für ihre Leistungen, darunter über 40 Mal die Ehrendoktorwürde.', 'Prof.', 'f'),
(5, 'Alan Mathison', 'Turing', '1912-06-23', 'London', '1954-06-07', 'Wilmslow', 'Turing entwickelt die nach ihm benannte Berechnungsmodell der Turingmaschine und arbeitet an der Entzifferung der Enigma-Verschlüsselungstechnik.', 'In jungen Jahren beweist Turing bereits seine mathematische Problemlösungskompetenz und entwickelt als 24 jähriger ein einfaches Modell zu Hilberts Entscheidungsproblem. Die sogenannte Turingmaschine liefert ein Rechenmodell zur Lösung beliebiger mathematischer Probleme in der Form eines spezifischen Algorithmus. 1938 erweitert er die Turingmaschine um nicht durch Algorithmen lösbare Probleme ebenfalls analysieren können. Während des Zweiten Weltkriegs arbeite er als Kryptoanalytiker an der Entschlüsselung der Enigma-Maschine. Anschließend geht er in den Lehrdienst und schreibt entscheidende Beiträge zur theoretischen Informatik. Ebenso entwickelt er den ersten Schachcomputer sowie den Turing-Test zur Messung künstlicher Intelligenz.', 'Dr.', 'm'),
(6, 'Gottfried Wilhelm ', 'Leibniz', '1646-07-01', 'Leipzig', '1716-11-14', 'Hannover', 'Leibniz entwickelt als Universalgelehrter das duale Zahlensystem.', 'Leibniz war ein Universalgelehrter zur Zeit der Aufklärung. Schon als Kind beschäftigt er sich mit logischen Fragestellungen. Mit 26 Jahren erstellt er eine Rechenmaschine für die vier Grundrechenarten, die mittels Staffelwalzen betrieben wird. Sein wichtigster Beitrag für die moderne Informatik ist die Entdeckung des dualen Zahlensystems. Als Mathematiker beschäftigt er sich umfangreich mit Differenzial- und Integralrechnung. \r\nZahlreiche Initiativen gehen auf ihn zurück, sodass er als großer Denker des 18. Jahrhunderts gilt.', NULL, 'm');

-- --------------------------------------------------------

--
-- Table structure for table `person_bilder`
--

CREATE TABLE IF NOT EXISTS `person_bilder` (
  `id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `bilder_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\n';

-- --------------------------------------------------------

--
-- Table structure for table `person_kategorie`
--

CREATE TABLE IF NOT EXISTS `person_kategorie` (
  `id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `kategorie_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\n';

-- --------------------------------------------------------

--
-- Table structure for table `person_quelle`
--

CREATE TABLE IF NOT EXISTS `person_quelle` (
  `id` int(11) NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `quelle_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quelle`
--

CREATE TABLE IF NOT EXISTS `quelle` (
  `quelle_id` int(10) unsigned NOT NULL,
  `titel` varchar(50) NOT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `typ` varchar(20) NOT NULL,
  `jahr` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quelle`
--

INSERT INTO `quelle` (`quelle_id`, `titel`, `isbn`, `link`, `typ`, `jahr`) VALUES
(1, 'Ada und der Algorithmus', NULL, 'http://www.zeit.de/2014/05/ada-lovelace-programmie', 'Zeitschrift ', 2014),
(2, 'Ada Lovelace Biography', NULL, 'http://www.biography.com/people/ada-lovelace-20825', 'Lexikon', 2015),
(3, 'Ada Lovelace: Die Pionierin der Computertechnik un', '9783770559862', NULL, 'Buch', 2015),
(4, 'Konrad Zuse: Der Vater des Computers', '3790003174', NULL, 'Buch', 2000),
(5, 'Heinz Nixdorf: eine deutsche Karriere', '3478301203', NULL, 'Buch', 1986),
(6, 'Grace Hopper', NULL, 'http://www.frauen-informatik-geschichte.de/index.p', '', NULL),
(7, 'Alan Turing: his Work and Impact', '9780123869807', NULL, 'Buch', 2013),
(8, 'Gottfried Wilhelm Leibnis', '3406419550', NULL, 'Buch', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `quelle_autor`
--

CREATE TABLE IF NOT EXISTS `quelle_autor` (
  `quelle_autor_id` int(10) unsigned NOT NULL,
  `quelle` int(10) unsigned NOT NULL,
  `autor` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\n';

-- --------------------------------------------------------

--
-- Table structure for table `quelle_verlag`
--

CREATE TABLE IF NOT EXISTS `quelle_verlag` (
  `quelle_verlag_id` int(10) unsigned NOT NULL,
  `quelle` int(10) unsigned NOT NULL,
  `verlag` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rolle`
--

CREATE TABLE IF NOT EXISTS `rolle` (
  `rolle_id` int(11) NOT NULL,
  `rollenname` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `verlag`
--

CREATE TABLE IF NOT EXISTS `verlag` (
  `verlag_id` int(10) unsigned NOT NULL,
  `verlag_titel` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `verlag`
--

INSERT INTO `verlag` (`verlag_id`, `verlag_titel`) VALUES
(1, 'DIE ZEIT'),
(2, 'A&E Televsion Networks'),
(3, 'Wilhelm Fink'),
(4, 'Parzeller'),
(5, 'Moderne Industrie'),
(6, 'Beck'),
(7, 'Elsevier');

-- --------------------------------------------------------

--
-- Table structure for table `zitat`
--

CREATE TABLE IF NOT EXISTS `zitat` (
  `id` int(10) unsigned NOT NULL,
  `text` text NOT NULL,
  `quelle` varchar(50) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `jahr` int(11) DEFAULT NULL,
  `seite` varchar(50) DEFAULT NULL,
  `person_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='\n';

--
-- Dumping data for table `zitat`
--

INSERT INTO `zitat` (`id`, `text`, `quelle`, `link`, `jahr`, `seite`, `person_id`) VALUES
(1, 'Die Maschine kann nur tun, was wir ihr zu befehlen wissen', NULL, 'http://www.bk-luebeck.eu/zitate-lovelace.html', NULL, NULL, 1),
(2, 'Die Gefahr, dass der Computer so wird wie der Mensch, ist nicht so groß wie die Gefahr, dass der Mensch so wird wie der Computer.', NULL, 'http://zitate.net/konrad-zuse-zitate', NULL, NULL, 2),
(3, 'Computer müssen so klein sein, dass sie in die linke untere Schublade eines Buchhalter-Schreibtisches passen. ', NULL, 'https://de.wikipedia.org/wiki/Heinz_Nixdorf', NULL, NULL, 3),
(4, 'Wenn es eine gute Idee ist, dann mach es einfach. Es ist viel einfacher sich nachher zu entschuldigen als vorher die Genehmigung zu bekommen.', NULL, 'http://einstieg-informatik.de', NULL, NULL, 4),
(5, 'Wir können nur eine kurze Distanz in die Zukunft blicken, aber dort können wir eine Menge sehen, was getan werden muss.', 'Computing Machinery and Intelligence', NULL, 1950, NULL, 5),
(6, 'Beim Erwachen hatte ich schon so viele Einfälle, dass der Tag nicht ausreichte, um sie niederzuschreiben.', NULL, 'https://de.wikipedia.org/wiki/Gottfried_Wilhelm_Le', NULL, NULL, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`autor_id`);

--
-- Indexes for table `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`benutzer_id`),
  ADD KEY `fk_benutzer_rolle_idx` (`rolle_id`);

--
-- Indexes for table `bilder`
--
ALTER TABLE `bilder`
  ADD PRIMARY KEY (`bild_id`),
  ADD KEY `fk_bilder_informatiker_idx` (`person_id`);

--
-- Indexes for table `informatiker`
--
ALTER TABLE `informatiker`
  ADD PRIMARY KEY (`informatiker_id`),
  ADD KEY `informatiker_nachname_idx` (`nachname`);

--
-- Indexes for table `informatiker_kategorie`
--
ALTER TABLE `informatiker_kategorie`
  ADD PRIMARY KEY (`inf_kat_id`),
  ADD KEY `fk_informatiker_kategorie_informatiker1_idx` (`informatiker`),
  ADD KEY `fk_informatiker_kategorie_kategorie1_idx` (`kategorie`);

--
-- Indexes for table `informatiker_quelle`
--
ALTER TABLE `informatiker_quelle`
  ADD PRIMARY KEY (`informatiker_quelle_id`),
  ADD KEY `fk_informatiker_quelle_informatiker_idx` (`informatiker`),
  ADD KEY `fk_informatiker_quelle_quelle_idx` (`quelle`);

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`kategorie_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informatiker_nachname_idx` (`nachname`);

--
-- Indexes for table `person_bilder`
--
ALTER TABLE `person_bilder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_person_bilder_person1_idx` (`person_id`),
  ADD KEY `fk_person_bilder_bilder1_idx` (`bilder_id`);

--
-- Indexes for table `person_kategorie`
--
ALTER TABLE `person_kategorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_informatiker_kategorie_informatiker1_idx` (`person_id`),
  ADD KEY `fk_informatiker_kategorie_kategorie1_idx` (`kategorie_id`);

--
-- Indexes for table `person_quelle`
--
ALTER TABLE `person_quelle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_informatiker_quelle_informatiker_idx` (`person_id`),
  ADD KEY `fk_informatiker_quelle_quelle_idx` (`quelle_id`);

--
-- Indexes for table `quelle`
--
ALTER TABLE `quelle`
  ADD PRIMARY KEY (`quelle_id`);

--
-- Indexes for table `quelle_autor`
--
ALTER TABLE `quelle_autor`
  ADD PRIMARY KEY (`quelle_autor_id`),
  ADD KEY `fk_quelle_autor_quelle1_idx` (`quelle`),
  ADD KEY `fk_quelle_autor_autor1_idx` (`autor`);

--
-- Indexes for table `quelle_verlag`
--
ALTER TABLE `quelle_verlag`
  ADD PRIMARY KEY (`quelle_verlag_id`),
  ADD KEY `fk_quelle_verlag_quelle1_idx` (`quelle`),
  ADD KEY `fk_quelle_verlag_verlag1_idx` (`verlag`);

--
-- Indexes for table `rolle`
--
ALTER TABLE `rolle`
  ADD PRIMARY KEY (`rolle_id`);

--
-- Indexes for table `verlag`
--
ALTER TABLE `verlag`
  ADD PRIMARY KEY (`verlag_id`);

--
-- Indexes for table `zitat`
--
ALTER TABLE `zitat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_zitat_person1_idx` (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autor`
--
ALTER TABLE `autor`
  MODIFY `autor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `benutzer_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bilder`
--
ALTER TABLE `bilder`
  MODIFY `bild_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `informatiker`
--
ALTER TABLE `informatiker`
  MODIFY `informatiker_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `informatiker_kategorie`
--
ALTER TABLE `informatiker_kategorie`
  MODIFY `inf_kat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `informatiker_quelle`
--
ALTER TABLE `informatiker_quelle`
  MODIFY `informatiker_quelle_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `kategorie_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `person_bilder`
--
ALTER TABLE `person_bilder`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `person_kategorie`
--
ALTER TABLE `person_kategorie`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `person_quelle`
--
ALTER TABLE `person_quelle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quelle`
--
ALTER TABLE `quelle`
  MODIFY `quelle_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `quelle_autor`
--
ALTER TABLE `quelle_autor`
  MODIFY `quelle_autor_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quelle_verlag`
--
ALTER TABLE `quelle_verlag`
  MODIFY `quelle_verlag_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rolle`
--
ALTER TABLE `rolle`
  MODIFY `rolle_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `verlag`
--
ALTER TABLE `verlag`
  MODIFY `verlag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `zitat`
--
ALTER TABLE `zitat`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `benutzer`
--
ALTER TABLE `benutzer`
  ADD CONSTRAINT `fk_benutzer_rolle` FOREIGN KEY (`rolle_id`) REFERENCES `rolle` (`rolle_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bilder`
--
ALTER TABLE `bilder`
  ADD CONSTRAINT `fk_bilder_informatiker` FOREIGN KEY (`person_id`) REFERENCES `informatiker` (`informatiker_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `informatiker_kategorie`
--
ALTER TABLE `informatiker_kategorie`
  ADD CONSTRAINT `fk_informatiker_kategorie_informatiker1` FOREIGN KEY (`informatiker`) REFERENCES `informatiker` (`informatiker_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_informatiker_kategorie_kategorie1` FOREIGN KEY (`kategorie`) REFERENCES `kategorie` (`kategorie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `informatiker_quelle`
--
ALTER TABLE `informatiker_quelle`
  ADD CONSTRAINT `fk_informatiker_quelle_informatiker` FOREIGN KEY (`informatiker`) REFERENCES `informatiker` (`informatiker_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_informatiker_quelle_quelle` FOREIGN KEY (`quelle`) REFERENCES `quelle` (`quelle_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quelle_autor`
--
ALTER TABLE `quelle_autor`
  ADD CONSTRAINT `fk_quelle_autor_autor1` FOREIGN KEY (`autor`) REFERENCES `autor` (`autor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_quelle_autor_quelle1` FOREIGN KEY (`quelle`) REFERENCES `quelle` (`quelle_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quelle_verlag`
--
ALTER TABLE `quelle_verlag`
  ADD CONSTRAINT `fk_quelle_verlag_quelle1` FOREIGN KEY (`quelle`) REFERENCES `quelle` (`quelle_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_quelle_verlag_verlag1` FOREIGN KEY (`verlag`) REFERENCES `verlag` (`verlag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
