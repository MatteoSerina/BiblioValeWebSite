-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generato il: Set 30, 2013 alle 11:56
-- Versione del server: 5.5.27
-- Versione PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `libreria`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `autori`
--

CREATE TABLE IF NOT EXISTS `autori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cognome` text NOT NULL,
  `nome` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=164 ;

--
-- Dump dei dati per la tabella `autori`
--

INSERT INTO `autori` (`id`, `cognome`, `nome`) VALUES
(1, 'Adams', 'Douglas'),
(2, 'Ahern', 'Cecelia'),
(3, 'Albanese', 'Antonio'),
(4, 'Alighieri', 'Dante'),
(5, 'Allende', 'Isabelle'),
(6, 'Ammaniti', 'Niccol'),
(7, 'Andersen', 'Hans'),
(8, 'Anonimo', ''),
(9, 'Apollinaire', 'Guillaume'),
(10, 'Apuleio', 'Lucio'),
(11, 'Austen', 'Jane'),
(12, 'Auster', 'Paul'),
(13, 'Ballestra', 'Silvia'),
(14, 'Bank', 'Melissa'),
(15, 'Baricco', 'Alessandro'),
(16, 'Baudelaire', 'Charles'),
(17, 'Baum', 'Lyman'),
(18, 'Beckford', 'William'),
(19, 'Benni', 'Stefano'),
(20, 'Bianconi', 'Francesco'),
(21, 'Bierce', 'Ambrose'),
(22, 'Biggers', 'Earl'),
(23, 'Bisio', 'Claudio'),
(24, 'Boccaccio', 'Giovanni'),
(25, 'Bodei', 'Remo'),
(26, 'Bradbury', 'Ray'),
(27, 'Bront', 'Anne'),
(28, 'Bront', 'Charlotte'),
(29, 'Bront', 'Emily'),
(30, 'Brown', 'Dan'),
(31, 'Buchan', 'John'),
(32, 'Bukowski', 'Charles'),
(33, 'Bulgakov', 'Michail'),
(34, 'Byatt', 'Antonia'),
(35, 'Calvino', 'Italo'),
(36, 'Caproni', 'Giorgio'),
(37, 'Carroll', 'Lewis'),
(38, 'Chevalier', 'Tracy'),
(39, 'Christiane', 'F.'),
(40, 'Christie', 'Agatha'),
(41, 'Clarke', 'Susanna'),
(42, 'Cleland', 'John'),
(43, 'Coe', 'Jonathan'),
(44, 'Coelho', 'Paulo'),
(45, 'Conan', 'Doyle'),
(46, 'Conrad', 'Joseph'),
(47, 'Cooper', 'Glenn'),
(48, 'D''annunzio', 'Gabriele'),
(49, 'De', 'Laclos'),
(50, 'Dickens', 'Charles'),
(51, 'Dickinson', 'Emily'),
(52, 'Diderot', 'Denis'),
(53, 'Dostoevskij', 'F'),
(54, 'Dumas', 'Alexandre'),
(55, 'Ebershoff', 'David'),
(56, 'Eco', 'Umberto'),
(57, 'Eschilo', ''),
(58, 'Eugenides', 'Jeffrey'),
(59, 'Evans', 'Nicholas'),
(60, 'Fielding', 'Helen'),
(61, 'Fitzgerald', 'Francis'),
(62, 'Flaubert', 'Gustave'),
(63, 'Forster', 'Edward'),
(64, 'Foscolo', 'Ugo'),
(65, 'Foster', 'Alan'),
(66, 'Frank', 'Anna'),
(67, 'Freeman', 'Richard'),
(68, 'Garc', 'Lorca'),
(69, 'Goethe', 'Jonathan'),
(70, 'Gogol''', 'Nikolaj'),
(71, 'Golden', 'Arthur'),
(72, 'Goldoni', 'Carlo'),
(73, 'Goodrich', 'Frances'),
(74, 'Grimm', 'Jacob'),
(75, 'Haddon', 'Mark'),
(76, 'Harris', 'Joanne'),
(77, 'Hawthorne', 'Nathaniel'),
(78, 'Hemingway', 'Ernest'),
(79, 'Hesse', 'Herman'),
(80, 'Hoffmann', 'Ernst'),
(81, 'Hogg', 'James'),
(82, 'Hugo', 'Victor'),
(83, 'James', 'Henry'),
(84, 'Jerome', 'Jerome'),
(85, 'Joyce', 'James'),
(86, 'Kafka', 'Franz'),
(87, 'Kane', 'Sarah'),
(88, 'Kesey', 'Ken'),
(89, 'King', 'Stephen'),
(90, 'Kipling', 'Joseph'),
(91, 'Lapierre', 'Alexandra'),
(92, 'Lawrence', 'David'),
(93, 'Lee', 'Harper'),
(94, 'Lee', 'Masters'),
(95, 'Leroux', 'Gaston'),
(96, 'Leroy', 'Jeremiah'),
(97, 'Lewis', 'Clive'),
(98, 'Lewis', 'Mattew'),
(99, 'Littizzetto', 'Luciana'),
(100, 'Lovecraft', 'Howard'),
(101, 'Macchiavelli', 'Niccol'),
(102, 'Manzoni', 'Alessandro'),
(103, 'Marlowe', 'Christopher'),
(104, 'Martin', 'George'),
(105, 'Mason', 'Alfred'),
(106, 'Maturin', 'Charles'),
(107, 'Mauriac', 'Fran'),
(108, 'Melville', 'Herman'),
(109, 'M', 'Prosper'),
(110, 'Meyer', 'Stephenie'),
(111, 'Michelangelo', ''),
(112, 'Moravia', 'Alberto'),
(113, 'Musset', 'Alfred'),
(114, 'N', 'Ir'),
(115, 'Neruda', 'Pablo'),
(116, 'Orwell', 'George'),
(117, 'Panarello', 'Melissa'),
(118, 'Parker', 'Lara'),
(119, 'Pennac', 'Daniel'),
(120, 'Petronio', ''),
(121, 'Pirandello', 'Luigi'),
(122, 'Platone', ''),
(123, 'Poe', 'Edgar'),
(124, 'Pr', 'Jacques'),
(125, 'Rimbaud', 'Arthur'),
(126, 'Rinehart', 'Mary'),
(127, 'Rowling', 'Joanne'),
(128, 'Sade', 'Donatien-Alphonse-Fran'),
(129, 'Saint-Exup', 'Antoine'),
(130, 'Sansom', 'Christopher'),
(131, 'Selvon', 'Sam'),
(132, 'Sep', 'Luis'),
(133, 'Shakespeare', 'William'),
(134, 'Shelly', 'Mary'),
(135, 'Simoni', 'Marcello'),
(136, 'Sofocle', ''),
(137, 'Stendhal', ''),
(138, 'Stevenson', 'Robert'),
(139, 'Stoker', 'Bram'),
(140, 'Sturiale', 'Alice'),
(141, 'S', 'Patrick'),
(142, 'Suzuki', 'Koji'),
(143, 'Svevo', 'Italo'),
(144, 'Tarantino', 'Quentin'),
(145, 'Thackeray', 'William'),
(146, 'Tobino', 'Mario'),
(147, 'Tolkien', 'John'),
(148, 'Tolstoj', 'Lev'),
(149, 'Unamuno', 'Miguel'),
(150, 'Van', 'Dine'),
(151, 'Vari', 'Autori'),
(152, 'Verga', 'Giovanni'),
(153, 'Verlaine', 'Paul'),
(154, 'Voltaire', ''),
(155, 'Wallace', 'Edgar'),
(156, 'Walpole', 'Horace'),
(157, 'Wilde', 'Oscar'),
(158, 'Woolf', 'Virginia'),
(159, 'Yourcenar', 'Marguerite'),
(160, 'Zaf', 'Carlos'),
(161, 'Zimmer', 'Bradley'),
(162, 'Zola', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `generi`
--

CREATE TABLE IF NOT EXISTS `generi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `generi`
--

INSERT INTO `generi` (`id`, `nome`) VALUES
(1, 'Romanzo');

-- --------------------------------------------------------

--
-- Struttura della tabella `libri`
--

CREATE TABLE IF NOT EXISTS `libri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` text NOT NULL,
  `id_autore` int(11) NOT NULL,
  `id_genere` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `stato` text NOT NULL,
  `gradimento` int(11) NOT NULL,
  `note` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_autore` (`id_autore`,`id_genere`),
  KEY `id_genere` (`id_genere`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=308 ;

--
-- Dump dei dati per la tabella `libri`
--

INSERT INTO `libri` (`id`, `titolo`, `id_autore`, `id_genere`, `anno`, `stato`, `gradimento`, `note`) VALUES
(1, 'Guida galattica per autostoppisti', 1, 1, 0, '0', 0, ''),
(2, 'La vita, l''universo e tutto quanto', 1, 1, 0, '0', 0, ''),
(3, 'Ristorante al termine dell''universo', 1, 1, 0, '0', 0, ''),
(4, 'P.s. I love you', 2, 1, 0, '0', 0, ''),
(5, 'Patapim e Patapam', 3, 1, 0, '0', 0, ''),
(6, 'La divina commedia', 4, 1, 0, '0', 0, ''),
(7, 'La divina commedia - purgatorio', 4, 1, 0, '0', 0, ''),
(8, 'D''amore e ombra', 5, 1, 0, '0', 0, ''),
(9, 'La casa degli spiriti', 5, 1, 0, '0', 0, ''),
(10, 'Come dio comanda', 6, 1, 0, '0', 0, ''),
(11, 'Trentottotto fiabe', 7, 1, 0, '0', 0, ''),
(12, 'La mia vita segreta', 8, 1, 0, '0', 0, ''),
(13, 'Le undicimila verghe', 9, 1, 0, '0', 0, ''),
(14, 'La favola di Amore e Psiche', 10, 1, 0, '0', 0, ''),
(15, 'Emma', 11, 1, 0, '0', 0, ''),
(16, 'L''abbazia di Northanger', 11, 1, 0, '0', 0, ''),
(17, 'Lady susan', 11, 1, 0, '0', 0, ''),
(18, 'Mansfield park', 11, 1, 0, '0', 0, ''),
(19, 'Orgoglio e pregiudizio', 11, 1, 0, '0', 0, ''),
(20, 'Persuasione', 11, 1, 0, '0', 0, ''),
(21, 'Ragione e sentimento', 11, 1, 0, '0', 0, ''),
(22, 'Trilogia di New York', 12, 1, 0, '0', 0, ''),
(23, 'La giovinezza della signorina N.N.', 13, 1, 0, '0', 0, ''),
(24, 'Manuale di caccia e pesca per ragazze', 14, 1, 0, '0', 0, ''),
(25, 'Castelli di rabbia', 15, 1, 0, '0', 0, ''),
(26, 'City', 15, 1, 0, '0', 0, ''),
(27, 'Emmaus', 15, 1, 0, '0', 0, ''),
(28, 'La storia di don giovanni', 15, 1, 0, '0', 0, ''),
(29, 'Mr. Gwyn', 15, 1, 0, '0', 0, ''),
(30, 'Next. Piccolo libro sulla globalizzazione e sul mondo che verr', 15, 1, 0, '0', 0, ''),
(31, 'Novecento', 15, 1, 0, '0', 0, ''),
(32, 'Oceano mare', 15, 1, 0, '0', 0, ''),
(33, 'Omero, Iliade', 15, 1, 0, '0', 0, ''),
(34, 'Questa storia', 15, 1, 0, '0', 0, ''),
(35, 'Senza sangue', 15, 1, 0, '0', 0, ''),
(36, 'Seta', 15, 1, 0, '0', 0, ''),
(37, 'Tre volte all''alba', 15, 1, 0, '0', 0, ''),
(38, 'I fiori del male', 16, 1, 0, '0', 0, ''),
(39, 'Les fleurs du mal', 16, 1, 0, '0', 0, ''),
(40, 'Il meraviglioso mago di oz', 17, 1, 0, '0', 0, ''),
(41, 'Vathek', 18, 1, 0, '0', 0, ''),
(42, 'Bar sotto al mare', 19, 1, 0, '0', 0, ''),
(43, 'Bar sport', 19, 1, 0, '0', 0, ''),
(44, 'Bar sport duemila', 19, 1, 0, '0', 0, ''),
(45, 'Elianto', 19, 1, 0, '0', 0, ''),
(46, 'Saltatempo', 19, 1, 0, '0', 0, ''),
(47, 'Il regno animale', 20, 1, 0, '0', 0, ''),
(48, 'Racconti dell''orrore', 21, 1, 0, '0', 0, ''),
(49, 'Charlie Chan e la casa senza chiavi', 22, 1, 0, '0', 0, ''),
(50, 'Quella vacca di Nonna Papera', 23, 1, 0, '0', 0, ''),
(51, 'Il decameron', 24, 1, 0, '0', 0, ''),
(52, 'Le forme del bello', 25, 1, 0, '0', 0, ''),
(53, 'Fahrenheit 451', 26, 1, 0, '0', 0, ''),
(54, 'Agnes Grey', 29, 1, 0, '0', 0, ''),
(55, 'Jane Eyre', 29, 1, 0, '0', 0, ''),
(56, 'Cime tempestose', 29, 1, 0, '0', 0, ''),
(57, 'Angeli e demoni', 30, 1, 0, '0', 0, ''),
(58, 'Crypto', 30, 1, 0, '0', 0, ''),
(59, 'Inferno', 30, 1, 0, '0', 0, ''),
(60, 'La verit', 30, 1, 0, '0', 0, ''),
(61, 'I trentanove scalini', 31, 1, 0, '0', 0, ''),
(62, 'Pulp', 32, 1, 0, '0', 0, ''),
(63, 'Cuore di cane', 33, 1, 0, '0', 0, ''),
(64, 'Il maestro e margherita', 33, 1, 0, '0', 0, ''),
(65, 'Possessione', 34, 1, 0, '0', 0, ''),
(66, 'Calvino racconta l''Orlando furioso', 35, 1, 0, '0', 0, ''),
(67, 'Poesie', 36, 1, 0, '0', 0, ''),
(68, 'Alice nel paese delle meraviglie', 37, 1, 0, '0', 0, ''),
(69, 'Alice nel paese delle meraviglie e attraverso lo specchio', 37, 1, 0, '0', 0, ''),
(70, 'La ragazza con l''orecchino di perla', 38, 1, 0, '0', 0, ''),
(71, 'Noi, i ragazzi dello zoo di Berlino', 39, 1, 0, '0', 0, ''),
(72, 'Assassinio sull''Orient Express', 40, 1, 0, '0', 0, ''),
(73, 'Poirot e il mistero di Styles Court', 40, 1, 0, '0', 0, ''),
(74, 'Jonathan Strange & mr. Norrell', 41, 1, 0, '0', 0, ''),
(75, 'Fanny Hill. Memorie di una donna di piacere', 42, 1, 0, '0', 0, ''),
(76, 'La casa del sonno', 43, 1, 0, '0', 0, ''),
(77, 'L''amore non guasta', 43, 1, 0, '0', 0, ''),
(78, 'L''alchimista', 44, 1, 0, '0', 0, ''),
(79, 'Undici minuti', 44, 1, 0, '0', 0, ''),
(80, 'Il mastino dei baskerville', 45, 1, 0, '0', 0, ''),
(81, 'Il ritorno di Sherlock Holmes', 45, 1, 0, '0', 0, ''),
(82, 'Il segno dei quattro', 45, 1, 0, '0', 0, ''),
(83, 'Il taccuino di Sherlock Holmes', 45, 1, 0, '0', 0, ''),
(84, 'La valle della paura', 45, 1, 0, '0', 0, ''),
(85, 'L''abisso di atlantide - una scoperta meravigliosa', 45, 1, 0, '0', 0, ''),
(86, 'Le memorie di Sherlock Holmes', 45, 1, 0, '0', 0, ''),
(87, 'L''ultimo saluto di Sherlock Holmes', 45, 1, 0, '0', 0, ''),
(88, 'Racconti fantastici e dell''orrore I', 45, 1, 0, '0', 0, ''),
(89, 'Racconti fantastici e dell''orrore II', 45, 1, 0, '0', 0, ''),
(90, 'Uno studio in rosso', 45, 1, 0, '0', 0, ''),
(91, 'Cuore di tenebra', 46, 1, 0, '0', 0, ''),
(92, 'La linea d''ombra', 46, 1, 0, '0', 0, ''),
(93, 'I custodi della biblioteca', 47, 1, 0, '0', 0, ''),
(94, 'Il libro delle anime', 47, 1, 0, '0', 0, ''),
(95, 'La biblioteca dei morti', 47, 1, 0, '0', 0, ''),
(96, 'Il piacere', 48, 1, 0, '0', 0, ''),
(97, 'Le relazioni pericolose', 49, 1, 0, '0', 0, ''),
(98, 'Il circolo pickwick', 50, 1, 0, '0', 0, ''),
(99, 'Tempi difficili', 50, 1, 0, '0', 0, ''),
(100, 'Poesie', 51, 1, 0, '0', 0, ''),
(101, 'Jacques il fatalista e il suo padrone', 52, 1, 0, '0', 0, ''),
(102, 'Th', 52, 1, 0, '0', 0, ''),
(103, 'Le notti bianche', 53, 1, 0, '0', 0, ''),
(104, 'L''idiota', 53, 1, 0, '0', 0, ''),
(105, 'La signora delle camelie', 54, 1, 0, '0', 0, ''),
(106, 'Il conte di Montecristo', 54, 1, 0, '0', 0, ''),
(107, 'La regina Margot', 54, 1, 0, '0', 0, ''),
(108, 'La 19a moglie', 55, 1, 0, '0', 0, ''),
(109, 'Il nome della rosa', 56, 1, 0, '0', 0, ''),
(110, 'Prometeo incatenato', 57, 1, 0, '0', 0, ''),
(111, 'Le vergini suicide', 58, 1, 0, '0', 0, ''),
(112, 'Middlesex', 58, 1, 0, '0', 0, ''),
(113, 'L''uomo che sussurrava ai cavalli', 59, 1, 0, '0', 0, ''),
(114, 'Il diario di Bridget Jones', 60, 1, 0, '0', 0, ''),
(115, 'Belli e dannati', 61, 1, 0, '0', 0, ''),
(116, 'Il grande Gatsby', 61, 1, 0, '0', 0, ''),
(117, 'Madame Bovary', 62, 1, 0, '0', 0, ''),
(118, 'A passage to India', 63, 1, 0, '0', 0, ''),
(119, 'Camera con vista', 63, 1, 0, '0', 0, ''),
(120, 'Ultime lettere di Jacopo Ortis', 64, 1, 0, '0', 0, ''),
(121, 'Alien', 65, 1, 0, '0', 0, ''),
(122, 'Diario', 66, 1, 0, '0', 0, ''),
(123, 'L''impronta Scarlatta', 67, 1, 0, '0', 0, ''),
(124, 'La casa di Bernarda Alba', 68, 1, 0, '0', 0, ''),
(125, 'Tutte le poesie', 68, 1, 0, '0', 0, ''),
(126, 'I dolori del giovane Werther', 69, 1, 0, '0', 0, ''),
(127, 'Le veglie alla fattoria di dilanka', 70, 1, 0, '0', 0, ''),
(128, 'Memorie di una geisha', 71, 1, 0, '0', 0, ''),
(129, 'La locandiera', 72, 1, 0, '0', 0, ''),
(130, 'Il diario di Anne Frank', 73, 1, 0, '0', 0, ''),
(131, 'Fiabe I', 74, 1, 0, '0', 0, ''),
(132, 'Fiabe II', 74, 1, 0, '0', 0, ''),
(133, 'Lo strano caso del cane ucciso a mezzanotte', 75, 1, 0, '0', 0, ''),
(134, 'Chocolat', 76, 1, 0, '0', 0, ''),
(135, 'La lettera scarlatta', 77, 1, 0, '0', 0, ''),
(136, 'Il vecchio e il mare', 78, 1, 0, '0', 0, ''),
(137, 'Narciso e Boccadoro', 79, 1, 0, '0', 0, ''),
(138, 'Siddharta', 79, 1, 0, '0', 0, ''),
(139, 'L''uomo della sabbia e altri racconti', 80, 1, 0, '0', 0, ''),
(140, 'Suor Monika', 80, 1, 0, '0', 0, ''),
(141, 'The private memoirs and confessions of a justified sinner', 81, 1, 0, '0', 0, ''),
(142, 'I miserabili I', 82, 1, 0, '0', 0, ''),
(143, 'I miserabili II', 82, 1, 0, '0', 0, ''),
(144, 'I miserabili III', 82, 1, 0, '0', 0, ''),
(145, 'Notre dame de Paris', 82, 1, 0, '0', 0, ''),
(146, 'Il carteggio aspern', 83, 1, 0, '0', 0, ''),
(147, 'Ritratto di signora', 83, 1, 0, '0', 0, ''),
(148, 'Tre uomini in barca', 84, 1, 0, '0', 0, ''),
(149, 'Gente di Dublino', 85, 1, 0, '0', 0, ''),
(150, 'La metamorfosi', 86, 1, 0, '0', 0, ''),
(151, 'Tutto il teatro', 87, 1, 0, '0', 0, ''),
(152, 'Qualcuno vol', 88, 1, 0, '0', 0, ''),
(153, 'Desperation', 89, 1, 0, '0', 0, ''),
(154, 'It', 89, 1, 0, '0', 0, ''),
(155, 'La bambina che amava Tom Gordon', 89, 1, 0, '0', 0, ''),
(156, 'Misery', 89, 1, 0, '0', 0, ''),
(157, 'Shining', 89, 1, 0, '0', 0, ''),
(158, 'Kim', 90, 1, 0, '0', 0, ''),
(159, 'Artemisia', 91, 1, 0, '0', 0, ''),
(160, 'Le angeliche', 91, 1, 0, '0', 0, ''),
(161, 'L''amante di lady Chatterlay', 92, 1, 0, '0', 0, ''),
(162, 'Il buio oltre la siepe', 94, 1, 0, '0', 0, ''),
(163, 'Antologia di Spoon River', 94, 1, 0, '0', 0, ''),
(164, 'Il fantasma dell''Opera', 95, 1, 0, '0', 0, ''),
(165, 'Ingannevole ', 96, 1, 0, '0', 0, ''),
(166, 'Le cronache di Narnia', 98, 1, 0, '0', 0, ''),
(167, 'The monk', 98, 1, 0, '0', 0, ''),
(168, 'Sola come un gambo di sedano', 99, 1, 0, '0', 0, ''),
(169, 'I racconti del Necronomicon', 100, 1, 0, '0', 0, ''),
(170, 'La casa stregata', 100, 1, 0, '0', 0, ''),
(171, 'Lo strano caso di Charles Dexter Ward', 100, 1, 0, '0', 0, ''),
(172, 'La mandragola - Belfagor - Lettere', 101, 1, 0, '0', 0, ''),
(173, 'I promessi sposi', 102, 1, 0, '0', 0, ''),
(174, 'Il Dottor Faust', 103, 1, 0, '0', 0, ''),
(175, 'Le cronache del ghiaccio e del fuoco I - Il trono di spade', 104, 1, 0, '0', 0, ''),
(176, 'Le cronache del ghiaccio e del fuoco II - Il grande inverno', 104, 1, 0, '0', 0, ''),
(177, 'Le cronache del ghiaccio e del fuoco III - il regno dei lupi', 104, 1, 0, '0', 0, ''),
(178, 'Le cronache del ghiaccio e del fuoco IV - La regina dei draghi', 104, 1, 0, '0', 0, ''),
(179, 'Le cronache del ghiaccio e del fuoco IX - il dominio della regina', 104, 1, 0, '0', 0, ''),
(180, 'Le cronache del ghiaccio e del fuoco V - Tempesta di spade', 104, 1, 0, '0', 0, ''),
(181, 'Le cronache del ghiaccio e del fuoco VI - I fiumi della guerra', 104, 1, 0, '0', 0, ''),
(182, 'Le cronache del ghiaccio e del fuoco VII - Il portale delle tenebre', 104, 1, 0, '0', 0, ''),
(183, 'Le cronache del ghiaccio e del fuoco VIII - L''ombra della profezia', 104, 1, 0, '0', 0, ''),
(184, 'Le cronache del ghiaccio e del fuoco X - I guerrieri del ghiaccio', 104, 1, 0, '0', 0, ''),
(185, 'Le cronache del ghiaccio e del fuoco XI - I fuochi di Valyria', 104, 1, 0, '0', 0, ''),
(186, 'Delitto a Villa Rose', 105, 1, 0, '0', 0, ''),
(187, 'Melmoth l''errante', 106, 1, 0, '0', 0, ''),
(188, 'Melmoth the wanderer', 106, 1, 0, '0', 0, ''),
(189, 'Genitrix', 107, 1, 0, '0', 0, ''),
(190, 'Benito Cereno', 108, 1, 0, '0', 0, ''),
(191, 'Carmen', 109, 1, 0, '0', 0, ''),
(192, 'L''ospite', 110, 1, 0, '0', 0, ''),
(193, 'The twilight saga I - Twilight', 110, 1, 0, '0', 0, ''),
(194, 'The twilight saga II - New moon', 110, 1, 0, '0', 0, ''),
(195, 'The twilight saga III - Eclipse', 110, 1, 0, '0', 0, ''),
(196, 'The twilight saga IV - Breaking dawn', 110, 1, 0, '0', 0, ''),
(197, 'Poesie', 111, 1, 0, '0', 0, ''),
(198, 'Agostino', 112, 1, 0, '0', 0, ''),
(199, 'Gamiani', 113, 1, 0, '0', 0, ''),
(200, 'Il ballo', 114, 1, 0, '0', 0, ''),
(201, 'Poesie d''amore', 115, 1, 0, '0', 0, ''),
(202, '1984', 116, 1, 0, '0', 0, ''),
(203, 'La fattoria degli animali', 116, 1, 0, '0', 0, ''),
(204, '100 colpi di spazzola prima di andare a dormire', 117, 1, 0, '0', 0, ''),
(205, 'Dark Shadows', 118, 1, 0, '0', 0, ''),
(206, 'L''occhio del lupo', 119, 1, 0, '0', 0, ''),
(207, 'Satyricon', 120, 1, 0, '0', 0, ''),
(208, 'Il fu Mattia Pascal', 121, 1, 0, '0', 0, ''),
(209, 'Novelle per un anno', 121, 1, 0, '0', 0, ''),
(210, 'Sei personaggi in cerca d''autore', 121, 1, 0, '0', 0, ''),
(211, 'Uno, nessuno e centomila', 121, 1, 0, '0', 0, ''),
(212, 'Apologia di Socrate - Critone', 122, 1, 0, '0', 0, ''),
(213, 'Le inchieste di Monsieur Dupin', 123, 1, 0, '0', 0, ''),
(214, 'Poesie', 123, 1, 0, '0', 0, ''),
(215, 'Racconti', 123, 1, 0, '0', 0, ''),
(216, 'Poesie d''amore e libert', 124, 1, 0, '0', 0, ''),
(217, 'Il battello ebbro', 125, 1, 0, '0', 0, ''),
(218, 'Poesie', 125, 1, 0, '0', 0, ''),
(219, 'La scala a chiocciola', 126, 1, 0, '0', 0, ''),
(220, 'Harry Potter and the prisoner of Azkaban', 127, 1, 0, '0', 0, ''),
(221, 'Harry Potter I e la pietra filosofale', 127, 1, 0, '0', 0, ''),
(222, 'Harry Potter II e la camera dei segreti', 127, 1, 0, '0', 0, ''),
(223, 'Harry Potter III e il prigioniero di azkaban', 127, 1, 0, '0', 0, ''),
(224, 'Harry Potter IV e il calice di fuoco', 127, 1, 0, '0', 0, ''),
(225, 'Harry Potter V e l''ordine della fenice', 127, 1, 0, '0', 0, ''),
(226, 'Harry Potter VI e il principe mezzosangue', 127, 1, 0, '0', 0, ''),
(227, 'Harry Potter VII e i doni della morte', 127, 1, 0, '0', 0, ''),
(228, 'Il seggio vacante', 127, 1, 0, '0', 0, ''),
(229, 'La filosofia nelboudoir', 128, 1, 0, '0', 0, ''),
(230, 'Il piccolo Principe', 129, 1, 0, '0', 0, ''),
(231, 'winter in madrid', 130, 1, 0, '0', 0, ''),
(232, 'The lonely londoners', 131, 1, 0, '0', 0, ''),
(233, 'Storia di una gabbianella e del gatto che le insegn', 132, 1, 0, '0', 0, ''),
(234, 'Amleto', 133, 1, 0, '0', 0, ''),
(235, 'Il mercante di Venezia', 133, 1, 0, '0', 0, ''),
(236, 'La bisbetica domata', 133, 1, 0, '0', 0, ''),
(237, 'La tempesta', 133, 1, 0, '0', 0, ''),
(238, 'Molto strepito per nulla', 133, 1, 0, '0', 0, ''),
(239, 'Otello', 133, 1, 0, '0', 0, ''),
(240, 'Romeo e Giulietta', 133, 1, 0, '0', 0, ''),
(241, 'Sogno di una notte di mezza estate', 133, 1, 0, '0', 0, ''),
(242, 'Sonetti', 133, 1, 0, '0', 0, ''),
(243, 'Tutto il teatro I', 133, 1, 0, '0', 0, ''),
(244, 'Tutto il teatro II', 133, 1, 0, '0', 0, ''),
(245, 'Tutto il teatro III', 133, 1, 0, '0', 0, ''),
(246, 'Tutto il teatro IV', 133, 1, 0, '0', 0, ''),
(247, 'Tutto il teatro V', 133, 1, 0, '0', 0, ''),
(248, 'Tutto il teatro VI', 133, 1, 0, '0', 0, ''),
(249, 'Tutto il teatro VII', 133, 1, 0, '0', 0, ''),
(250, 'Tutto il teatro VIII', 133, 1, 0, '0', 0, ''),
(251, 'Frankenstein', 134, 1, 0, '0', 0, ''),
(252, 'Frankenstein', 134, 1, 0, '0', 0, ''),
(253, 'I sotterranei della cattedrale', 135, 1, 0, '0', 0, ''),
(254, 'Antigone. Variazioni sul mito', 136, 1, 0, '0', 0, ''),
(255, 'Le rouge et le noir', 137, 1, 0, '0', 0, ''),
(256, 'Lo strano caso del Dottor Jeckyll e il signor Hyde', 138, 1, 0, '0', 0, ''),
(257, 'Dracula', 139, 1, 0, '0', 0, ''),
(258, 'Il libro di Alice', 140, 1, 0, '0', 0, ''),
(259, 'Il profumo', 141, 1, 0, '0', 0, ''),
(260, 'Ring', 142, 1, 0, '0', 0, ''),
(261, 'La coscienza di Zeno', 143, 1, 0, '0', 0, ''),
(262, 'Pulp fiction', 144, 1, 0, '0', 0, ''),
(263, 'La fiera delle vanit', 145, 1, 0, '0', 0, ''),
(264, 'Gli ultimi giorni di magliano', 146, 1, 0, '0', 0, ''),
(265, 'La ladra', 146, 1, 0, '0', 0, ''),
(266, 'Le libere donne di magliano', 146, 1, 0, '0', 0, ''),
(267, 'Per le antiche scale', 146, 1, 0, '0', 0, ''),
(268, 'il signore degli anelli', 147, 1, 0, '0', 0, ''),
(269, 'il silmarillion', 147, 1, 0, '0', 0, ''),
(270, 'lo hobbit', 147, 1, 0, '0', 0, ''),
(271, 'Anna Karenina', 148, 1, 0, '0', 0, ''),
(272, 'I due ussari', 148, 1, 0, '0', 0, ''),
(273, 'Niebla', 149, 1, 0, '0', 0, ''),
(274, 'La strana morte del signor Benson', 150, 1, 0, '0', 0, ''),
(275, 'Giovent', 151, 1, 0, '0', 0, ''),
(276, 'Incubatoio 16', 151, 1, 0, '0', 0, ''),
(277, 'Poeti romantici inglesi', 151, 1, 0, '0', 0, ''),
(278, 'Storie di fantasmi', 151, 1, 0, '0', 0, ''),
(279, 'Wolfmen - storie di lupi mannari', 151, 1, 0, '0', 0, ''),
(280, 'Storia di una capinera', 152, 1, 0, '0', 0, ''),
(281, 'Poesie D''amore', 153, 1, 0, '0', 0, ''),
(282, 'Candido', 154, 1, 0, '0', 0, ''),
(283, 'Zadig', 154, 1, 0, '0', 0, ''),
(284, 'Il castello del terrore', 155, 1, 0, '0', 0, ''),
(285, 'The castle of Otranto', 156, 1, 0, '0', 0, ''),
(286, 'Aforismi', 157, 1, 0, '0', 0, ''),
(287, 'Il fantasma di Canterville', 157, 1, 0, '0', 0, ''),
(288, 'Il ritratto di Dorian Gray', 157, 1, 0, '0', 0, ''),
(289, 'Gita al faro', 158, 1, 0, '0', 0, ''),
(290, 'La signora Dalloway', 158, 1, 0, '0', 0, ''),
(291, 'Una stanza tutta per s', 158, 1, 0, '0', 0, ''),
(292, 'Memorie di Adriano', 159, 1, 0, '0', 0, ''),
(293, 'El pr', 160, 1, 0, '0', 0, ''),
(294, 'Guida a Barcellona', 160, 1, 0, '0', 0, ''),
(295, 'Il gioco dell''angelo', 160, 1, 0, '0', 0, ''),
(296, 'Il palazzo della mezzanotte', 160, 1, 0, '0', 0, ''),
(297, 'Il prigioniero del cielo', 160, 1, 0, '0', 0, ''),
(298, 'Il principe della nebbia', 160, 1, 0, '0', 0, ''),
(299, 'Le luci di settembre', 160, 1, 0, '0', 0, ''),
(300, 'L''ombra del vento', 160, 1, 0, '0', 0, ''),
(301, 'Marina', 160, 1, 0, '0', 0, ''),
(302, 'La sfida degli Alton', 161, 1, 0, '0', 0, ''),
(303, 'Le nebbie di Avalon', 161, 1, 0, '0', 0, ''),
(304, 'Le querce di Albion', 161, 1, 0, '0', 0, ''),
(305, 'Nana', 162, 1, 0, '0', 0, '');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `tutti_libri`
--
CREATE TABLE IF NOT EXISTS `tutti_libri` (
`id` int(11)
,`titolo` text
,`nome` text
,`cognome` text
,`genere` text
,`anno` int(11)
,`stato` text
,`gradimento` int(11)
,`note` longtext
);
-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `password`) VALUES
(1, 'vale', '4a11c46c4a1ad82c104faa86b90530f36c199dd050a6cb8e0334cb228ca60220');

-- --------------------------------------------------------

--
-- Struttura per la vista `tutti_libri`
--
DROP TABLE IF EXISTS `tutti_libri`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tutti_libri` AS select `libri`.`id` AS `id`,`libri`.`titolo` AS `titolo`,`autori`.`nome` AS `nome`,`autori`.`cognome` AS `cognome`,`generi`.`nome` AS `genere`,`libri`.`anno` AS `anno`,`libri`.`stato` AS `stato`,`libri`.`gradimento` AS `gradimento`,`libri`.`note` AS `note` from ((`libri` left join `autori` on((`autori`.`id` = `libri`.`id_autore`))) left join `generi` on((`generi`.`id` = `libri`.`id_genere`)));

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `libri`
--
ALTER TABLE `libri`
  ADD CONSTRAINT `libri_ibfk_11` FOREIGN KEY (`id_autore`) REFERENCES `autori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libri_ibfk_12` FOREIGN KEY (`id_genere`) REFERENCES `generi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
