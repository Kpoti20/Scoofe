-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 10 Mai 2018 à 19:09
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `scolariteweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE IF NOT EXISTS `etablissement` (
`id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `motdepasse` text NOT NULL,
  `vi` varchar(30) NOT NULL,
  `ad` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `etablissement`
--

INSERT INTO `etablissement` (`id`, `pseudo`, `mail`, `motdepasse`, `vi`, `ad`) VALUES
(1, 'junior', 'junior@yahoo.fr', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', ''),
(2, 'hf', 'g@g.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', ''),
(3, 'go', 'go@go.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', ''),
(4, 's', 'h@l.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', ''),
(5, 'ap', 'ap@ap.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', ''),
(6, 'sp', 'sp@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', '', ''),
(7, 'Defitech', 'def@defitech.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
`mat` int(11) NOT NULL,
  `no` varchar(30) NOT NULL,
  `pr` varchar(15) NOT NULL,
  `pre` varchar(15) NOT NULL,
  `se` varchar(8) NOT NULL,
  `te` int(11) NOT NULL,
  `form` varchar(15) NOT NULL,
  `mo` int(2) NOT NULL,
  `fil` varchar(10) NOT NULL,
  `tut` varchar(50) NOT NULL,
  `identite` varchar(60) NOT NULL,
  `sco` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`mat`, `no`, `pr`, `pre`, `se`, `te`, `form`, `mo`, `fil`, `tut`, `identite`, `sco`) VALUES
(4, 'KOURA', 'prisco', 'roland', 'Masculin', 98526431, 'BTS', 8, 'DA2', 'beba@yahoo.fr', 'KOURA prisco roland', 385000),
(6, 'AFFAMBI', 'Prisco', 'Jean', 'Masculin', 92648578, 'BTS', 3, 'DA', 'kogo@outlook.com', 'AFFAMBI Prisco Jean', 385000),
(7, 'AWANYO', 'David', 'Loic', 'Masculin', 91652317, 'BTS', 7, 'ARLE', 'awo@gmail.com', 'AWANYO David Loic', 385000),
(8, 'DADZIE', 'Dzidula', 'Kevin', 'Masculin', 93654875, 'BTS', 4, 'DA', 'aff@gmail.com', 'DADZIE Dzidula Kevin', 385000),
(9, 'EROP', 'DOP', 'sdop', 'FÃ©minin', 9652364, 'Licence', 3, 'DA', 'rona@hotmail.com', 'EROP DOP sdop', 500000);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE IF NOT EXISTS `filiere` (
`idfil` int(11) NOT NULL,
  `lib` varchar(10) NOT NULL,
  `des` varchar(35) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `filiere`
--

INSERT INTO `filiere` (`idfil`, `lib`, `des`) VALUES
(1, 'DA', 'Informatiques'),
(2, 'ARLE', 'Reseaux');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`id` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `message` varchar(600) CHARACTER SET utf8 NOT NULL,
  `msg` varchar(300) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `id_expediteur`, `id_destinataire`, `message`, `msg`) VALUES
(7, 7, 2, ' Cher parent ou tuteur votre Ã©tudiant  AFFAMBI Prisco Jean a effectuÃ©(e) le payement de la scolaritÃ© au montant de 53462 f CFA ce 2018-05-07.             Situation de la scolaritÃ©.\r\n              Pour la scolarite 385000 f CFA, le frais pÃ©riode par rapport Ã  la modalitÃ© choisie est : 128333.33333333 f CFA . L''Ã©tudiant(e) AFFAMBI Prisco Jean a reglÃ© :53462 f CFA, le montant restant sur frais pÃ©riode est : 74871.333333333 f CFA . Le restant net Ã  payer est : 331538 f CFA. ', ''),
(8, 7, 2, ' Cher parent ou tuteur votre Ã©tudiant  AFFAMBI Prisco Jean a effectuÃ©(e) le payement de la scolaritÃ© au montant de 53462 f CFA ce 2018-05-07.             Situation de la scolaritÃ©.\r\n              Pour la scolarite 385000 f CFA, le frais pÃ©riode par rapport Ã  la modalitÃ© choisie est : 128333.33333333 f CFA . L''Ã©tudiant(e) AFFAMBI Prisco Jean a reglÃ© :53462 f CFA, le montant restant sur frais pÃ©riode est : 74871.333333333 f CFA . Le restant net Ã  payer est : 331538 f CFA. ', ''),
(9, 7, 2, ' Cher parent ou tuteur votre Ã©tudiant  AFFAMBI Prisco Jean a effectuÃ©(e) le payement de la scolaritÃ© au montant de 53462 f CFA ce 2018-05-07.             Situation de la scolaritÃ©.\r\n              Pour la scolarite 385000 f CFA, le frais pÃ©riode par rapport Ã  la modalitÃ© choisie est : 128333.33333333 f CFA . L''Ã©tudiant(e) AFFAMBI Prisco Jean a reglÃ© :53462 f CFA, le montant restant sur frais pÃ©riode est : 74871.333333333 f CFA . Le restant net Ã  payer est : 331538 f CFA. ', '');

-- --------------------------------------------------------

--
-- Structure de la table `payement`
--

CREATE TABLE IF NOT EXISTS `payement` (
`idp` int(11) NOT NULL,
  `ljr` date NOT NULL,
  `mate` varchar(80) NOT NULL,
  `montre` int(11) NOT NULL,
  `mont` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `payement`
--

INSERT INTO `payement` (`idp`, `ljr`, `mate`, `montre`, `mont`) VALUES
(8, '2018-05-01', 'KOURA prisco roland', 98562, 4568),
(9, '2018-05-07', 'KOURA prisco roland', 7578, 278),
(10, '2018-05-03', 'KOURA prisco roland', 756879, 4562),
(14, '2018-05-07', 'AFFAMBI Prisco Jean', 56897, 53462),
(15, '2018-05-10', 'EROP DOP sdop', 56798, 4521),
(16, '2018-05-10', 'AWANYO David Loic', 385000, 55000);

-- --------------------------------------------------------

--
-- Structure de la table `tuteur`
--

CREATE TABLE IF NOT EXISTS `tuteur` (
`id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(35) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `p1` varchar(5) NOT NULL,
  `p2` varchar(5) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `motdepasse` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `tuteur`
--

INSERT INTO `tuteur` (`id`, `nom`, `prenom`, `mail`, `p1`, `p2`, `pseudo`, `motdepasse`) VALUES
(1, 'nora', 'awoumezunu', 'awo@gmail.com', 'nor', 'awo', 'norawo', '0f7cddc8d5f7eab19c573e3b35cbe410ec866ab8'),
(2, 'godwin', 'koule', 'kogo@outlook.com', 'god', 'kou', 'godkou', 'fa1449614618fe58f7ad0f566c9921123e3347ad'),
(3, 'ALOPE', 'ronaldo', 'rona@hotmail.com', 'ALO', 'ron', 'aloron', '602e34c95ed4d68b11149f0eaba83578cf701433'),
(6, 'fabiola', 'Boronbossou', 'beba@yahoo.fr', 'fab', 'Bor', 'fabbor', '9a1548838c5f3c97a36415294c85fd1d6d46896f'),
(7, 'rolander', 'affambiop', 'aff@gmail.com', 'rol', 'aff', 'rolaff', 'ae8f57cf8e29a5483cd289758ffb56e4a9d9aaf2'),
(8, 'eteter', 'vffgh', 'AD@AOP.com', 'ete', 'vff', 'etevff', 'af1eaa5632ec6125fd5cb1973fedf390427c1a1e'),
(9, 'kop', 'sitta', 'aop@sd.com', 'kop', 'sit', 'kopsit', 'd31859daeaa1604f5cb073ac6f4a8dc89ad238d6'),
(10, 'ALOPE', 'sorabi', 'as@sorabi.com', '', '', '', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `etablissement`
--
ALTER TABLE `etablissement`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
 ADD PRIMARY KEY (`mat`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
 ADD PRIMARY KEY (`idfil`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payement`
--
ALTER TABLE `payement`
 ADD PRIMARY KEY (`idp`);

--
-- Index pour la table `tuteur`
--
ALTER TABLE `tuteur`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
MODIFY `mat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
MODIFY `idfil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `payement`
--
ALTER TABLE `payement`
MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `tuteur`
--
ALTER TABLE `tuteur`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
