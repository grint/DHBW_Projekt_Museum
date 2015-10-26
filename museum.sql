-- -----------------------------------------------------
-- Schema museum
-- -----------------------------------------------------
SET FOREIGN_KEY_CHECKS=0;

CREATE SCHEMA IF NOT EXISTS `museum` ;
USE `museum` ;


-- -----------------------------------------------------
-- Table `museum`.`person_quelle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`person_quelle` ;

CREATE TABLE IF NOT EXISTS `museum`.`person_quelle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `person_id` INT UNSIGNED NULL,
  `quelle_id` INT UNSIGNED NOT NULL,
  INDEX `fk_informatiker_quelle_informatiker_idx` (`person_id` ASC) ,
  INDEX `fk_informatiker_quelle_quelle_idx` (`quelle_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_informatiker_quelle_informatiker`
    FOREIGN KEY (`person_id`)
    REFERENCES `museum`.`person` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_informatiker_quelle_quelle`
    FOREIGN KEY (`quelle_id`)
    REFERENCES `museum`.`quelle` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `museum`.`person_kategorie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`person_kategorie` ;

CREATE TABLE IF NOT EXISTS `museum`.`person_kategorie` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `person_id` INT UNSIGNED NULL,
  `kategorie_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`) ,
  INDEX `fk_informatiker_kategorie_informatiker_idx` (`person_id` ASC) ,
  INDEX `fk_informatiker_kategorie_kategorie_idx` (`kategorie_id` ASC) ,
  CONSTRAINT `fk_informatiker_kategorie_informatiker`
    FOREIGN KEY (`person_id`)
    REFERENCES `museum`.`person` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_informatiker_kategorie_kategorie`
    FOREIGN KEY (`kategorie_id`)
    REFERENCES `museum`.`kategorie` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `museum`.`person_bilder`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`person_bilder` ;

CREATE TABLE IF NOT EXISTS `museum`.`person_bilder` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `person_id` INT UNSIGNED NULL,
  `bilder_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`) ,
  INDEX `fk_person_bilder_person1_idx` (`person_id` ASC) ,
  INDEX `fk_person_bilder_bilder1_idx` (`bilder_id` ASC) ,
  CONSTRAINT `fk_person_bilder_person1`
    FOREIGN KEY (`person_id`)
    REFERENCES `museum`.`person` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_person_bilder_bilder1`
    FOREIGN KEY (`bilder_id`)
    REFERENCES `museum`.`bilder` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `museum`.`person`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`person` ;

CREATE TABLE IF NOT EXISTS `museum`.`person` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `vorname` VARCHAR(50) NOT NULL,
  `nachname` VARCHAR(50) NOT NULL,
  `geburtsdatum` DATE NULL,
  `geburtsort` VARCHAR(50) NULL,
  `todesdatum` DATE NULL,
  `todesort` VARCHAR(50) NULL,
  `k_beschreibung` VARCHAR(1000) NULL,
  `l_beschreibung` VARCHAR(10000) NULL,
  `titel` SET('Prof.', 'Dr.', 'Dipl.-Ing.', 'Prof.-Ing.', 'Dipl.-Inf.', 'Dipl.-Math.') NULL,
  `geschlecht` SET('f', 'm') NOT NULL,
  PRIMARY KEY (`id`) ,
  INDEX `informatiker_nachname_idx` (`nachname` ASC) )
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `museum`.`quelle_autor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`quelle_autor` ;

CREATE TABLE IF NOT EXISTS `museum`.`quelle_autor` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `quelle_id` INT UNSIGNED NULL,
  `autor_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) ,
  INDEX `fk_quelle_autor_quelle1_idx` (`quelle_id` ASC) ,
  INDEX `fk_quelle_autor_autor1_idx` (`autor_id` ASC) ,
  CONSTRAINT `fk_quelle_autor_quelle1`
    FOREIGN KEY (`quelle_id`)
    REFERENCES `museum`.`quelle` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_quelle_autor_autor1`
    FOREIGN KEY (`autor_id`)
    REFERENCES `museum`.`autor` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `museum`.`quelle_verlag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`quelle_verlag` ;

CREATE TABLE IF NOT EXISTS `museum`.`quelle_verlag` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `quelle_id` INT UNSIGNED NULL,
  `verlag_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) ,
  INDEX `fk_quelle_verlag_quelle1_idx` (`quelle_id` ASC) ,
  INDEX `fk_quelle_verlag_verlag1_idx` (`verlag_id` ASC) ,
  CONSTRAINT `fk_quelle_verlag_quelle1`
    FOREIGN KEY (`quelle_id`)
    REFERENCES `museum`.`quelle` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_quelle_verlag_verlag1`
    FOREIGN KEY (`verlag_id`)
    REFERENCES `museum`.`verlag` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `museum`.`quelle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`quelle` ;

CREATE TABLE IF NOT EXISTS `museum`.`quelle` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titel` VARCHAR(1000) NOT NULL,
  `isbn` VARCHAR(50) NULL,
  `link` VARCHAR(1000) NULL,
  `typ` VARCHAR(100) NULL,
  `jahr` INT NULL,
  PRIMARY KEY (`id`) )
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `museum`.`autor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`autor` ;

CREATE TABLE IF NOT EXISTS `museum`.`autor` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `vorname` VARCHAR(50) NOT NULL,
  `nachname` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`) )
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `museum`.`kategorie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`kategorie` ;

CREATE TABLE IF NOT EXISTS `museum`.`kategorie` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `beschreibung` TEXT NULL,
  PRIMARY KEY (`id`) )
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `museum`.`verlag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`verlag` ;

CREATE TABLE IF NOT EXISTS `museum`.`verlag` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`) )
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `museum`.`bilder`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`bilder` ;

CREATE TABLE IF NOT EXISTS `museum`.`bilder` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pfad` VARCHAR(100) NOT NULL,
  `beschreibung` TEXT NULL,
  `link` VARCHAR(100) NULL,
  PRIMARY KEY (`id`) )
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `museum`.`zitat`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `museum`.`zitat` ;

CREATE TABLE IF NOT EXISTS `museum`.`zitat` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` TEXT NOT NULL,
  `quelle` VARCHAR(50) NULL,
  `link` VARCHAR(50) NULL,
  `jahr` INT NULL,
  `seite` VARCHAR(50) NULL,
  `person_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`) ,
  INDEX `fk_zitat_person1_idx` (`person_id` ASC) ,
  CONSTRAINT `fk_zitat_person1`
    FOREIGN KEY (`person_id`)
    REFERENCES `museum`.`person` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
DEFAULT CHARACTER SET = utf8;





-- -----------------------------------------------------
-- Data for table `museum`.`person`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;
INSERT INTO `museum`.`person` (`id`, `vorname`, `nachname`, `geburtsdatum`, `geburtsort`, `todesdatum`, `todesort`, `k_beschreibung`, `l_beschreibung`, `titel`, `geschlecht`) VALUES (1, 'Ada', 'Lovelace', '1815-12-10', 'London', '1852-11-27', 'London', 'Lovelace veröffentlichte als erste ein Programm für einen Rechner und legte die theoretischen Grundlagen für automatisierte Programmabläufe.', 'Lovelace kommt aus einer Adelsfamilie und erhält früh einenaturwissenschaftliche Ausbildung. Aufgrund ihrer Interessen entwickelte sie bald Kontakte zu wissenschaftsorientierten Kreisen. 1843 übersetzt Lovelace „Analytical Engine“ mit umfangreichen Kommentierungen ins Englische. Der Artikel enthält die Beschreibung  einer mechanischen Rechenmaschine von Charles Babbage. Daneben entwickelte sie mit Babbage ein Programm zur Berechnung der Bernoulli-Zahlen mittels der Rechenmaschine. Adas systematisierte Abfolge von mathematischen  Operationen bildet bis heute die Grundlage der Programmierung. Außerdem liefert sie wichtige theoretische Beiträge im Bereich der Rechenarchitektur. Sie beschäftigt sich mit der Bedeutung der Rechenmaschine für die Gesellschaft,  als auch mit einzelnen Systemkomponenten. Ihre Überlegungen erhalten zu ihren Lebzeiten wenig Aufmerksamkeit. Sie stirbt mit 37 Jahren an Krebs.', NULL, 'f');
INSERT INTO `museum`.`person` (`id`, `vorname`, `nachname`, `geburtsdatum`, `geburtsort`, `todesdatum`, `todesort`, `k_beschreibung`, `l_beschreibung`, `titel`, `geschlecht`) VALUES (2, 'Konrad', 'Zuse', '1910-06-22', 'Berlin-Wilmersdorf', '1995-12-18', 'Hünfeld', 'Zuse war ein deutscher Computerpionier, der als erster einen vollautomatischen und freiprogrammierbaren Digitalrechner baute.', 'Nach seinem Ingenieurstudium bis 1935 baut Zuse im elterlichen Haus eineprogrammierbare Rechenmaschine. Die Z1 arbeitete mit binärer Gleitkommaarithmetik, besaß ein Ein- und Ausgabewerk, ein Rechenwerk, sowie ein Speicher- und ein Programmwerk. Aufgrund mechanischer Probleme war die Z1 jedoch nicht voll funktionsfähig. Der erste funktionsfähige Digitalrechner ist die Z3, die Zuse zusammen mit Helmut Schreyer 1941 baut. Die Z3 wird im Gegensatz zur Z1 über elektromagnetische Relaistechnik betrieben. Bis 1945 entwickelte Zuse eine Algorithmensprache, das sogenannte Plankalkül, das als Vorlage für höhere Programmiersprachen gedient hat. 1949 gründet Zuse die Zuse KG, die 1956 mit der Serienfertigung begann und Europa mit den ersten Computern belieferte.', 'Dr.', 'm');
INSERT INTO `museum`.`person` (`id`, `vorname`, `nachname`, `geburtsdatum`, `geburtsort`, `todesdatum`, `todesort`, `k_beschreibung`, `l_beschreibung`, `titel`, `geschlecht`) VALUES (3, 'Heinz', 'Nixdorf', '1925-04-09', 'Paderborn', '1986-03-17', 'Hannover', 'Nixdorf schuf aus einfachen Verhältnissen kommend eine internationale Computerfirma, die den Durchbruch der Kleinrechner förderte.', '1952 brach Nixdorf als mittelloser Student sein Physikstudium ab um mit 27 Jahren ein eigenes Computerlabor zu gründen. Bereits als Werkstudent arbeitete er an der Entwicklung einfacher Rechner mit und konnte so sein eigenes Konzept eines Elektronenrechners aus Röhren emtwerfem. 1954 verkaufte das Labor für Impulstechnik den ersten in Deutschland gebauten Röhrencomputer an die Buchhaltung der Rheinisch-Westfälischen Elektrizitätswerke. Das Unternehmen entwickelte sich schnell zu einem Zulieferer für elektronische Rechenwerke. Trotz finanzieller Engpässe und der Konkurrenz von Großunternehmen wuchs das Labor bis 1961 auf 50 Mitarbeiter. 1965 wurde der erste Tischrechner präsentiert, wobei der auf Halbleitertechnik basierender Kleincomputer des Entwicklungsingenieurs Otto Müller eine technische Revolution auslöste. Mit der Übernahme der Wanderwerke 1968 wurde die Nixdorf Computer AG gegründet. Durch die Übernahme eines amerikanischen Unternehmens konnte Nixdorf auf den amerikanischen Mark', NULL, 'm');
INSERT INTO `museum`.`person` (`id`, `vorname`, `nachname`, `geburtsdatum`, `geburtsort`, `todesdatum`, `todesort`, `k_beschreibung`, `l_beschreibung`, `titel`, `geschlecht`) VALUES (4, 'Grace Brewster', 'Hopper', '1906-12-09', 'New York', '1992-01-01', 'Arlinton', 'Als herausragende Computerspezialistin entwickelte Hopper viele Pionierprojekte in der Computertechnik und programmierte den ersten Compiler.', 'Hopper schlug nach ihrem Studium der Mathematik und Physik eine wissenschaftliche Laufbahn ein. Nach der Promotion 1934 an der Yale University, unterrichtet sie Mathematik am Vassar College. Während des 2. Weltkriegs beginnt Hopper eine militärische Ausbildung und arbeitete zeitgleich an der Harvard Universität im Computerlabor. In den folgenden Jahren spezialisiert sie sich auf die Programmierung und entwickelte den ersten Compiler 1957. Nach einer beruflichen Tätigkeit in der Wirtschaft geht sie in den Ruhestand. Hopper wird jedoch vom amerikanischen Militär wieder in den aktiven Dienst gerufen und arbeitete bis ins hohe Alter als Computerspezialistin. Als herausragende Pionierin in der Entwicklung moderner Computersysteme erhielt sie zahlreiche Auszeichnungen für ihre Leistungen, darunter über 40 Mal die Ehrendoktorwürde.', 'Prof.', 'f');
INSERT INTO `museum`.`person` (`id`, `vorname`, `nachname`, `geburtsdatum`, `geburtsort`, `todesdatum`, `todesort`, `k_beschreibung`, `l_beschreibung`, `titel`, `geschlecht`) VALUES (5, 'Alan Mathison', 'Turing', '1912-06-23', 'London', '1954-06-07', 'Wilmslow', 'Turing entwickelte die nach ihm benannte Berechnungsmodell der Turingmaschine und arbeitete an der Entzifferung der Enigma-Verschlüsselungstechnik.', 'In jungen Jahren beweist Turing bereits seine mathematische Problemlösungskompetenz und entwickelte als 24 jähriger ein einfaches Modell zu Hilberts Entscheidungsproblem. Die sogenannte Turingmaschine liefert ein Rechenmodell zur Lösung beliebiger mathematischer Probleme in der Form eines spezifischen Algorithmus. 1938 erweitert er die Turingmaschine um nicht durch Algorithmen lösbare Probleme ebenfalls analysieren können. Während des Zweiten Weltkriegs arbeite er als Kryptoanalytiker an der Entschlüsselung der Enigma-Maschine. Anschließend geht er in den Lehrdienst und schreibt entscheidende Beiträge zur theoretischen Informatik. Ebenso entwickelte er den ersten Schachcomputer sowie den Turing-Test zur Messung künstlicher Intelligenz.', 'Dr.', 'm');
INSERT INTO `museum`.`person` (`id`, `vorname`, `nachname`, `geburtsdatum`, `geburtsort`, `todesdatum`, `todesort`, `k_beschreibung`, `l_beschreibung`, `titel`, `geschlecht`) VALUES (6, 'Gottfried Wilhelm ', 'Leibniz', '1646-07-01', 'Leipzig', '1716-11-14', 'Hannover', 'Leibniz entwickelte als Universalgelehrter das duale Zahlensystem.', 'Leibniz war ein Universalgelehrter zur Zeit der Aufklärung. Schon als Kind beschäftigt er sich mit logischen Fragestellungen. Mit 26 Jahren erstellt er eine Rechenmaschine für die vier Grundrechenarten, die mittels Staffelwalzen betrieben wird. Sein wichtigster Beitrag für die moderne Informatik ist die Entdeckung des dualen Zahlensystems. Als Mathematiker beschäftigt er sich umfangreich mit Differenzial- und Integralrechnung. Zahlreiche Initiativen gehen auf ihn zurück, sodass er als großer Denker des 18. Jahrhunderts gilt.', NULL, 'm');

COMMIT;


-- -----------------------------------------------------
-- Data for table `museum`.`quelle`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;
INSERT INTO `museum`.`quelle` (`id`, `titel`, `isbn`, `link`, `typ`, `jahr`) VALUES (1, 'Ada und der Algorithmus', NULL, 'http://www.zeit.de/2014/05/ada-lovelace-programmiererin', 'Zeitschrift', 2014);
INSERT INTO `museum`.`quelle` (`id`, `titel`, `isbn`, `link`, `typ`, `jahr`) VALUES (2, 'Ada Lovelace Biography', NULL, 'http://www.biography.com/people/ada-lovelace-20825323', 'Lexikon', 2015);
INSERT INTO `museum`.`quelle` (`id`, `titel`, `isbn`, `link`, `typ`, `jahr`) VALUES (3, 'Ada Lovelace: Die Pionierin der Computertechnik und ihre Nachfolgerinnen', '9783770559862', NULL, 'Buch', 2015);
INSERT INTO `museum`.`quelle` (`id`, `titel`, `isbn`, `link`, `typ`, `jahr`) VALUES (4, 'Konrad Zuse: Der Vater des Computers', '3790003174', NULL, 'Buch', 2000);
INSERT INTO `museum`.`quelle` (`id`, `titel`, `isbn`, `link`, `typ`, `jahr`) VALUES (5, 'Heinz Nixdorf: eine deutsche Karriere', '3478301203', NULL, 'Buch', 1986);
INSERT INTO `museum`.`quelle` (`id`, `titel`, `isbn`, `link`, `typ`, `jahr`) VALUES (6, 'Grace Hopper', NULL, 'http://www.frauen-informatik-geschichte.de/index.php?id=62', 'Webseite', NULL);
INSERT INTO `museum`.`quelle` (`id`, `titel`, `isbn`, `link`, `typ`, `jahr`) VALUES (7, 'Alan Turing: his Work and Impact', '9780123869807', NULL, 'Buch', 2013);
INSERT INTO `museum`.`quelle` (`id`, `titel`, `isbn`, `link`, `typ`, `jahr`) VALUES (8, 'Gottfried Wilhelm Leibniz', '3406419550', NULL, 'Buch', 2000);

COMMIT;


-- -----------------------------------------------------
-- Data for table `museum`.`autor`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (1, 'Biography.com', 'Editors');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (2, 'Sybille', 'Krämer');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (3, 'Eberhard', 'Fennel');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (4, 'Horst-Dieter', 'Brähmig');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (5, 'Wilhelm', 'Mons');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (6, 'Horst', 'Zuse');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (7, 'Hermann', 'Flessner');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (8, 'Jürgen', 'Alex');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (9, 'Kurt', 'Pauli');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (10, 'Klaus', 'Kemper');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (11, 'Veronika', 'Oechtering');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (12, 'Barry', 'Cooper');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (13, 'Jan', 'van Leeuwen');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (14, 'Michael-Thomas', 'Liske');
INSERT INTO `museum`.`autor` (`id`, `vorname`, `nachname`) VALUES (15, 'Anne', 'Kunze');

COMMIT;


-- -----------------------------------------------------
-- Data for table `museum`.`kategorie`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;
INSERT INTO `museum`.`kategorie` (`id`, `name`, `beschreibung`) VALUES (1, 'Mathematiker/in', '');
INSERT INTO `museum`.`kategorie` (`id`, `name`, `beschreibung`) VALUES (2, 'Computerpionier/in', '');
INSERT INTO `museum`.`kategorie` (`id`, `name`, `beschreibung`) VALUES (3, 'Ingenieur/in', '');
INSERT INTO `museum`.`kategorie` (`id`, `name`, `beschreibung`) VALUES (4, 'Erfinder/in', '');
INSERT INTO `museum`.`kategorie` (`id`, `name`, `beschreibung`) VALUES (5, 'Unternehmer/in', '');

COMMIT;


-- -----------------------------------------------------
-- Data for table `museum`.`person_quelle`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;
INSERT INTO `museum`.`person_quelle` (`id`, `person_id`, `quelle_id`) VALUES (1,  1,  1);
INSERT INTO `museum`.`person_quelle` (`id`, `person_id`, `quelle_id`) VALUES (2,  1,  2);
INSERT INTO `museum`.`person_quelle` (`id`, `person_id`, `quelle_id`) VALUES (3,  1,  3);
INSERT INTO `museum`.`person_quelle` (`id`, `person_id`, `quelle_id`) VALUES (4,  2,  4);
INSERT INTO `museum`.`person_quelle` (`id`, `person_id`, `quelle_id`) VALUES (5,  3,  5);
INSERT INTO `museum`.`person_quelle` (`id`, `person_id`, `quelle_id`) VALUES (6,  4,  6);
INSERT INTO `museum`.`person_quelle` (`id`, `person_id`, `quelle_id`) VALUES (7,  5,  7);
INSERT INTO `museum`.`person_quelle` (`id`, `person_id`, `quelle_id`) VALUES (8,  6,  8);

COMMIT;


-- -----------------------------------------------------
-- Data for table `museum`.`quelle_autor`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (1, 1, 15);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (2, 2, 1);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (3, 3, 2);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (4, 4, 3);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (5, 4, 4);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (6, 4, 5);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (7, 4, 6);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (8, 4, 7);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (9, 4, 8);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (10, 4, 9);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (11, 5, 10);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (12, 6, 11);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (13, 7, 12);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (14, 7, 13);
INSERT INTO `museum`.`quelle_autor` (`id`, `quelle_id`, `autor_id`) VALUES (15, 8, 14);

COMMIT;


-- -----------------------------------------------------
-- Data for table `museum`.`verlag`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;
INSERT INTO `museum`.`verlag` (`id`, `name`) VALUES (1, 'DIE ZEIT');
INSERT INTO `museum`.`verlag` (`id`, `name`) VALUES (2, 'A&E Televsion Networks');
INSERT INTO `museum`.`verlag` (`id`, `name`) VALUES (3, 'Wilhelm Fink');
INSERT INTO `museum`.`verlag` (`id`, `name`) VALUES (4, 'Parzeller');
INSERT INTO `museum`.`verlag` (`id`, `name`) VALUES (5, 'Moderne Industrie');
INSERT INTO `museum`.`verlag` (`id`, `name`) VALUES (6, 'Beck');
INSERT INTO `museum`.`verlag` (`id`, `name`) VALUES (7, 'Elsevier');

COMMIT;


-- -----------------------------------------------------
-- Data for table `museum`.`quelle_verlag`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;
INSERT INTO `museum`.`quelle_verlag` (`id`, `quelle_id`, `verlag_id`) VALUES (1, 1, 1);
INSERT INTO `museum`.`quelle_verlag` (`id`, `quelle_id`, `verlag_id`) VALUES (2, 2, 2);
INSERT INTO `museum`.`quelle_verlag` (`id`, `quelle_id`, `verlag_id`) VALUES (3, 3, 3);
INSERT INTO `museum`.`quelle_verlag` (`id`, `quelle_id`, `verlag_id`) VALUES (4, 4, 4);
INSERT INTO `museum`.`quelle_verlag` (`id`, `quelle_id`, `verlag_id`) VALUES (5, 5, 5);
INSERT INTO `museum`.`quelle_verlag` (`id`, `quelle_id`, `verlag_id`) VALUES (6, 7, 7);
INSERT INTO `museum`.`quelle_verlag` (`id`, `quelle_id`, `verlag_id`) VALUES (7, 8, 6);

COMMIT;


-- -----------------------------------------------------
-- Data for table `museum`.`person_kategorie`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;
INSERT INTO `museum`.`person_kategorie` (`id`, `person_id`, `kategorie_id`) VALUES (1,  1,  1);
INSERT INTO `museum`.`person_kategorie` (`id`, `person_id`, `kategorie_id`) VALUES (2,  2,  2);
INSERT INTO `museum`.`person_kategorie` (`id`, `person_id`, `kategorie_id`) VALUES (3,  2,  3);
INSERT INTO `museum`.`person_kategorie` (`id`, `person_id`, `kategorie_id`) VALUES (4,  2,  4);
INSERT INTO `museum`.`person_kategorie` (`id`, `person_id`, `kategorie_id`) VALUES (5,  2,  5);
INSERT INTO `museum`.`person_kategorie` (`id`, `person_id`, `kategorie_id`) VALUES (6,  3,  5);
INSERT INTO `museum`.`person_kategorie` (`id`, `person_id`, `kategorie_id`) VALUES (7,  4,  1);
INSERT INTO `museum`.`person_kategorie` (`id`, `person_id`, `kategorie_id`) VALUES (8,  4,  2);
INSERT INTO `museum`.`person_kategorie` (`id`, `person_id`, `kategorie_id`) VALUES (9,  5,  1);
INSERT INTO `museum`.`person_kategorie` (`id`, `person_id`, `kategorie_id`) VALUES (10,  6,  1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `museum`.`zitat`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;
INSERT INTO `museum`.`zitat` (`id`, `text`, `quelle`, `link`, `jahr`, `seite`, `person_id`) VALUES (1, 'Die Maschine kann nur tun, was wir ihr zu befehlen wissen', NULL, 'http://www.bk-luebeck.eu/zitate-lovelace.html', NULL, NULL, 1);
INSERT INTO `museum`.`zitat` (`id`, `text`, `quelle`, `link`, `jahr`, `seite`, `person_id`) VALUES (2, 'Die Gefahr, dass der Computer so wird wie der Mensch, ist nicht so groß wie die Gefahr, dass der Mensch so wird wie der Computer.', NULL, 'http://zitate.net/konrad-zuse-zitate', NULL, NULL, 2);
INSERT INTO `museum`.`zitat` (`id`, `text`, `quelle`, `link`, `jahr`, `seite`, `person_id`) VALUES (3, 'Computer müssen so klein sein, dass sie in die linke untere Schublade eines Buchhalter-Schreibtisches passen.', NULL, 'https://de.wikipedia.org/wiki/Heinz_Nixdorf', NULL, NULL, 3);
INSERT INTO `museum`.`zitat` (`id`, `text`, `quelle`, `link`, `jahr`, `seite`, `person_id`) VALUES (4, 'Wenn es eine gute Idee ist, dann mach es einfach. Es ist viel einfacher sich nachher zu entschuldigen als vorher die Genehmigung zu bekommen.', NULL, 'http://einstieg-informatik.de', NULL, NULL, 4);
INSERT INTO `museum`.`zitat` (`id`, `text`, `quelle`, `link`, `jahr`, `seite`, `person_id`) VALUES (5, 'Wir können nur eine kurze Distanz in die Zukunft blicken, aber dort können wir eine Menge sehen, was getan werden muss.', 'Computing Machinery and Intelligence', NULL, 1950, NULL, 5);
INSERT INTO `museum`.`zitat` (`id`, `text`, `quelle`, `link`, `jahr`, `seite`, `person_id`) VALUES (6, 'Beim Erwachen hatte ich schon so viele Einfälle, dass der Tag nicht ausreichte, um sie niederzuschreiben.', NULL, 'https://de.wikipedia.org/wiki/Gottfried_Wilhelm_Le', NULL, NULL, 6);

COMMIT;




-- -----------------------------------------------------
-- Data for table `museum`.`person_bilder`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;

INSERT INTO `museum`.`person_bilder`(`id`, `person_id`, `bilder_id`) VALUES ('1', '1', '1');
INSERT INTO `museum`.`person_bilder`(`id`, `person_id`, `bilder_id`) VALUES ('2', '1', '2');
INSERT INTO `museum`.`person_bilder`(`id`, `person_id`, `bilder_id`) VALUES ('3', '2', '3');
INSERT INTO `museum`.`person_bilder`(`id`, `person_id`, `bilder_id`) VALUES ('4', '2', '4');
INSERT INTO `museum`.`person_bilder`(`id`, `person_id`, `bilder_id`) VALUES ('5', '3', '5');
INSERT INTO `museum`.`person_bilder`(`id`, `person_id`, `bilder_id`) VALUES ('6', '3', '6');
INSERT INTO `museum`.`person_bilder`(`id`, `person_id`, `bilder_id`) VALUES ('7', '4', '7');
INSERT INTO `museum`.`person_bilder`(`id`, `person_id`, `bilder_id`) VALUES ('8', '4', '8');
INSERT INTO `museum`.`person_bilder`(`id`, `person_id`, `bilder_id`) VALUES ('9', '5', '9');
INSERT INTO `museum`.`person_bilder`(`id`, `person_id`, `bilder_id`) VALUES ('10', '6', '10');

COMMIT;



-- -----------------------------------------------------
-- Data for table `museum`.`bilder`
-- -----------------------------------------------------
START TRANSACTION;
USE `museum`;

INSERT INTO `museum`.`bilder`(`id`, `pfad`, `beschreibung`, `link`) VALUES ('1', 'lovelace-1.jpg', 'Ada Lovelace 1836: Gemälde von Margaret Sarah Carpenter (Wikipedia)', 'https://de.wikipedia.org/wiki/Ada_Lovelace');
INSERT INTO `museum`.`bilder`(`id`, `pfad`, `beschreibung`, `link`) VALUES ('2', 'lovelace-2.jpg', '', 'http://www.biography.com/people/ada-lovelace-20825323');
INSERT INTO `museum`.`bilder`(`id`, `pfad`, `beschreibung`, `link`) VALUES ('3', 'zuse-1.jpg', 'Konrad Zuse, 1992 (Wikipedia)', 'https://de.wikipedia.org/wiki/Konrad_Zuse');
INSERT INTO `museum`.`bilder`(`id`, `pfad`, `beschreibung`, `link`) VALUES ('4', 'zuse-2.jpg', 'Konrad Zuse (Archiv des Deutschen Museums)', 'http://www.deutsches-museum.de/archiv/projekte/');
INSERT INTO `museum`.`bilder`(`id`, `pfad`, `beschreibung`, `link`) VALUES ('5', 'nixdorf-1.jpg', 'Heinz Nixdorf (Wikipedia)', 'https://de.wikipedia.org/wiki/Heinz_Nixdorf');
INSERT INTO `museum`.`bilder`(`id`, `pfad`, `beschreibung`, `link`) VALUES ('6', 'nixdorf-2.jpg', 'Heinz Nixdorf (Wikipedia)', 'https://de.wikipedia.org/wiki/Heinz_Nixdorf');
INSERT INTO `museum`.`bilder`(`id`, `pfad`, `beschreibung`, `link`) VALUES ('7', 'hopper-1.jpg', 'Grace Hopper, 1960 (Wikipedia)', 'https://de.wikipedia.org/wiki/Grace_Hopper');
INSERT INTO `museum`.`bilder`(`id`, `pfad`, `beschreibung`, `link`) VALUES ('8', 'hopper-2.jpg', 'Grace Hopper, 1984 (Wikipedia)', 'https://de.wikipedia.org/wiki/Grace_Hopper');
INSERT INTO `museum`.`bilder`(`id`, `pfad`, `beschreibung`, `link`) VALUES ('9', 'turing-1.jpg', 'Alan Turing, 1927 (Wikipedia)', 'https://de.wikipedia.org/wiki/Alan_Turing');
INSERT INTO `museum`.`bilder`(`id`, `pfad`, `beschreibung`, `link`) VALUES ('10', 'leibniz-1.jpg', 'Gottfried Wilhelm Leibniz (Fokus Online)', 'http://www.focus.de/wissen/mensch/naturwissenschaften/mathematik/tid-8279/geschichte_aid_229017.html');

COMMIT;