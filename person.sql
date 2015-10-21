-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2015 at 05:58 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informatiker_nachname_idx` (`nachname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
