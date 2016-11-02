-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 02 Novembre 2016 à 15:10
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `facebook`
--

-- --------------------------------------------------------

--
-- Structure de la table `ecrit`
--

CREATE TABLE IF NOT EXISTS `ecrit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` text CHARACTER SET utf8,
  `dateEcrit` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `idAuteur` int(11) NOT NULL,
  `idAmi` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `ecrit`
--

INSERT INTO `ecrit` (`id`, `titre`, `contenu`, `dateEcrit`, `image`, `idAuteur`, `idAmi`) VALUES
(1, 'Titre', 'Ecureil', '2016-11-02 02:58:31', NULL, 1, 1),
(2, 'Viande', 'Texte 2 avec une image', '2016-11-02 02:59:12', 'cell.png', 1, 1),
(3, 'Titre', 'T? $ †  ? ? ? 0 ? † ? ? † ? ', '2016-11-02 02:59:39', NULL, 1, 1),
(4, 'Titre', 'V▲ ₱ 0 Я † ☰ Ж † ☰  ∪ † ₣ 8', '2016-11-02 03:00:57', NULL, 1, 1),
(5, 'Titre', 'J''aime les pates', '2016-11-02 03:04:05', 'bg.png', 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `lien`
--

CREATE TABLE IF NOT EXISTS `lien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur1` int(11) NOT NULL,
  `idUtilisateur2` int(11) NOT NULL,
  `etat` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `lien`
--

INSERT INTO `lien` (`id`, `idUtilisateur1`, `idUtilisateur2`, `etat`) VALUES
(1, 1, 4, 'ami');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `passwd`, `hash`) VALUES
(1, 'titi', '5d933eef19aee7da192608de61b6c23d', NULL),
(2, 'tom', '30035607ee5bb378c71ab434a6d05410', NULL),
(3, 'lucky', '46ecbec5ec7951ce102670dbd0b2def5', NULL),
(4, 'daffy', '36846677e3a8f4c0b16d8bdf8ef18608', '5819f22ca9bfe');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
