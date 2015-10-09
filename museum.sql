-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 09 2015 г., 14:20
-- Версия сервера: 5.5.44-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `museum`
--

-- --------------------------------------------------------

--
-- Структура таблицы `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `benutzer`
--

CREATE TABLE IF NOT EXISTS `benutzer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `benutzername` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `passwort` varchar(100) DEFAULT NULL,
  `rolle_id` int(11) NOT NULL,
  `erstellt_am` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `letzter_besuch` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_benutzer_rolle_idx` (`rolle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `bilder`
--

CREATE TABLE IF NOT EXISTS `bilder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pfad` varchar(100) NOT NULL,
  `beschreibung` text,
  `link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\n' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `kategorie`
--

CREATE TABLE IF NOT EXISTS `kategorie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `beschreibung` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\n' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `geburtsdatum` date DEFAULT NULL,
  `geburtsort` varchar(50) DEFAULT NULL,
  `todesdatum` date DEFAULT NULL,
  `todesort` varchar(50) DEFAULT NULL,
  `k_beschreibung` varchar(500) DEFAULT NULL,
  `l_beschreibung` varchar(1000) DEFAULT NULL,
  `titel` set('Prof.','Dr.') DEFAULT NULL,
  `geschlecht` set('f','m') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `informatiker_nachname_idx` (`nachname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `person`
--

INSERT INTO `person` (`id`, `vorname`, `nachname`, `geburtsdatum`, `geburtsort`, `todesdatum`, `todesort`, `k_beschreibung`, `l_beschreibung`, `titel`, `geschlecht`) VALUES
(1, 'Ada', 'Lovelace', '1815-12-10', 'London', '1852-11-27', 'London', 'Lovelace veröffentlichte als erste ein Programm für einen Rechner und legte\n\ndie theoretischen Grundlagen für automatisierte Programmabläufe.', 'Lovelace kommt aus einer Adelsfamilie und erhält früh eine\n\nnaturwissenschaftliche Ausbildung. Aufgrund ihrer Interessen entwickelte sie \n\nbald Kontakte zu wissenschaftsorientierten Kreisen.\n\n 1843 übersetzt Lovelace „Analytical Engine“ mit umfangreichen \n\nKommentierungen ins Englische. Der Artikel enthält die Beschreibung  einer \n\nmechanischen Rechenmaschine von Charles Babbage. Daneben entwickelt \n\nsie mit Babbage ein Programm zur Berechnung der Bernoulli-Zahlen mittels \n\nder Rechenmaschine. \n\nAdas systematisierte Abfolge von mathematischen  Operationen bildet bis \n\nheute die Grundlage der Programmierung. Außerdem liefert sie wichtige \n\ntheoretische Beiträge im Bereich der Rechenarchitektur. Sie beschäftigt sich \n\nmit der Bedeutung der Rechenmaschine für die Gesellschaft, als auch mit \n\neinzelnen Systemkomponenten.\n\nIhre Überlegungen erhalten zu ihren Lebzeiten wenig Aufmerksamkeit. Sie \n\nstirbt mit 37 Jahren an Krebs.', NULL, 'f'),
(2, 'Konrad', 'Zuse', '1910-06-22', 'Berlin-Wilmersdorf', '1995-12-18', 'Hünfeld', 'Zuse war ein deutscher Computerpionier, der als erster einen\r\n\r\nvollautomatischen und frei programmierbaren Digitalrechner baute.', 'Nach seinem Ingenieurstudium bis 1935 baut Zuse im elterlichen Haus eine\r\n\r\nprogrammierbare Rechenmaschine. Die Z1 arbeitete mit binärer \r\n\r\nGleitkommaarithmetik, besaß ein Ein- und Ausgabewerk, ein Rechenwerk, \r\n\r\nsowie ein Speicher- und ein Programmwerk. Aufgrund mechanischer \r\n\r\nProbleme war die Z1 jedoch nicht voll funktionsfähig. \r\n\r\nDer erste funktionsfähige Digitalrechner ist die Z3, die Zuse zusammen mit \r\n\r\nHelmut Schreyer 1941 baut. Die Z3 wird im Gegensatz zur Z1 über \r\n\r\nelektromagnetische Relaistechnik betrieben. \r\n\r\nBis 1945 entwickelte Zuse eine Algorithmensprache, das sogenannte \r\n\r\nPlankalkül, das als Vorlage für höhere Programmiersprachen gedient hat.\r\n\r\n 1949 gründet Zuse die Zuse KG, die 1956 mit der Serienfertigung begann und \r\n\r\nEuropa mit den ersten Computern belieferte.', 'Dr.', 'm');

-- --------------------------------------------------------

--
-- Структура таблицы `person_bilder`
--

CREATE TABLE IF NOT EXISTS `person_bilder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` int(10) unsigned NOT NULL,
  `bilder_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_person_bilder_person1_idx` (`person_id`),
  KEY `fk_person_bilder_bilder1_idx` (`bilder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\n' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `person_kategorie`
--

CREATE TABLE IF NOT EXISTS `person_kategorie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` int(10) unsigned NOT NULL,
  `kategorie_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_informatiker_kategorie_informatiker1_idx` (`person_id`),
  KEY `fk_informatiker_kategorie_kategorie1_idx` (`kategorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\n' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `person_quelle`
--

CREATE TABLE IF NOT EXISTS `person_quelle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(10) unsigned NOT NULL,
  `quelle_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_informatiker_quelle_informatiker_idx` (`person_id`),
  KEY `fk_informatiker_quelle_quelle_idx` (`quelle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `quelle`
--

CREATE TABLE IF NOT EXISTS `quelle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titel` varchar(50) NOT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `typ` varchar(45) DEFAULT NULL,
  `jahr` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `quelle_autor`
--

CREATE TABLE IF NOT EXISTS `quelle_autor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quelle_id` int(10) unsigned NOT NULL,
  `autor_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_quelle_autor_quelle1_idx` (`quelle_id`),
  KEY `fk_quelle_autor_autor1_idx` (`autor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\n' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `quelle_verlag`
--

CREATE TABLE IF NOT EXISTS `quelle_verlag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quelle_id` int(10) unsigned NOT NULL,
  `verlag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_quelle_verlag_quelle1_idx` (`quelle_id`),
  KEY `fk_quelle_verlag_verlag1_idx` (`verlag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `rolle`
--

CREATE TABLE IF NOT EXISTS `rolle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` enum('Admin','User') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `verlag`
--

CREATE TABLE IF NOT EXISTS `verlag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `zitat`
--

CREATE TABLE IF NOT EXISTS `zitat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `quelle` varchar(50) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `jahr` int(11) DEFAULT NULL,
  `seite` varchar(50) DEFAULT NULL,
  `person_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_zitat_person1_idx` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='\n' AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `benutzer`
--
ALTER TABLE `benutzer`
  ADD CONSTRAINT `fk_benutzer_rolle` FOREIGN KEY (`rolle_id`) REFERENCES `rolle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `person_bilder`
--
ALTER TABLE `person_bilder`
  ADD CONSTRAINT `fk_person_bilder_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_person_bilder_bilder1` FOREIGN KEY (`bilder_id`) REFERENCES `bilder` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `person_kategorie`
--
ALTER TABLE `person_kategorie`
  ADD CONSTRAINT `fk_informatiker_kategorie_informatiker1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_informatiker_kategorie_kategorie1` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `person_quelle`
--
ALTER TABLE `person_quelle`
  ADD CONSTRAINT `fk_informatiker_quelle_informatiker` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_informatiker_quelle_quelle` FOREIGN KEY (`quelle_id`) REFERENCES `quelle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `quelle_autor`
--
ALTER TABLE `quelle_autor`
  ADD CONSTRAINT `fk_quelle_autor_quelle1` FOREIGN KEY (`quelle_id`) REFERENCES `quelle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_quelle_autor_autor1` FOREIGN KEY (`autor_id`) REFERENCES `autor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `quelle_verlag`
--
ALTER TABLE `quelle_verlag`
  ADD CONSTRAINT `fk_quelle_verlag_quelle1` FOREIGN KEY (`quelle_id`) REFERENCES `quelle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_quelle_verlag_verlag1` FOREIGN KEY (`verlag_id`) REFERENCES `verlag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `zitat`
--
ALTER TABLE `zitat`
  ADD CONSTRAINT `fk_zitat_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
