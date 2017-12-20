-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 01 Décembre 2017 à 12:51
-- Version du serveur :  10.0.28-MariaDB-2
-- Version de PHP :  5.6.29-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hamza`
--

-- --------------------------------------------------------

--
-- Structure de la table `functions`
--

CREATE TABLE `functions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_license` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `historic`
--

CREATE TABLE `historic` (
  `id` int(11) NOT NULL,
  `id_type_licences` int(11) NOT NULL DEFAULT '1' COMMENT '1 : Hebdo, 2 : Mensuel, 3 : Annuel',
  `date_debut` int(11) NOT NULL,
  `date_fin` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `licenses`
--

CREATE TABLE `licenses` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `activation_key` varchar(45) NOT NULL,
  `mac` varchar(17) NOT NULL,
  `id_historic` int(11) NOT NULL,
  `key_use` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_licenses`
--

CREATE TABLE `type_licenses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `time_suscribe` int(11) NOT NULL COMMENT 'timestamp unix (seconds)',
  `price` int(11) NOT NULL COMMENT 'prix en credits',
  `auto_renewal` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_licenses`
--

INSERT INTO `type_licenses` (`id`, `name`, `time_suscribe`, `price`, `auto_renewal`) VALUES
(1, 'Nothing', 0, 0, 0),
(2, 'Unlimited', -1, 100, 0),
(3, '1 year', 31557600, 40, 0),
(4, '1 month', 2629800, 5, 1),
(5, '3 months ', 7889400, 12, 1),
(6, '6 months', 15778800, 20, 1),
(7, '1 year', 31557600, 35, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `cart` text NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_license` (`id_license`);

--
-- Index pour la table `historic`
--
ALTER TABLE `historic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_licences` (`id_type_licences`);

--
-- Index pour la table `licenses`
--
ALTER TABLE `licenses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_historic` (`id_historic`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `type_licenses`
--
ALTER TABLE `type_licenses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `functions`
--
ALTER TABLE `functions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `historic`
--
ALTER TABLE `historic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `licenses`
--
ALTER TABLE `licenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `type_licenses`
--
ALTER TABLE `type_licenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `functions`
--
ALTER TABLE `functions`
  ADD CONSTRAINT `functions_ibfk_1` FOREIGN KEY (`id_license`) REFERENCES `licenses` (`id`);

--
-- Contraintes pour la table `historic`
--
ALTER TABLE `historic`
  ADD CONSTRAINT `historic_ibfk_1` FOREIGN KEY (`id_type_licences`) REFERENCES `type_licenses` (`id`);

--
-- Contraintes pour la table `licenses`
--
ALTER TABLE `licenses`
  ADD CONSTRAINT `licenses_ibfk_1` FOREIGN KEY (`id_historic`) REFERENCES `historic` (`id`),
  ADD CONSTRAINT `licenses_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
