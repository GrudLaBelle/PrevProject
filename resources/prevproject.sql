-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : ven. 30 sep. 2022 à 16:22
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `antoinebarre_prevproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `enterprise`
--

CREATE TABLE `enterprise` (
  `id` bigint(20) NOT NULL,
  `enterprise_name` varchar(255) NOT NULL,
  `siret` bigint(14) NOT NULL,
  `user_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `enterprise_stat`
--

CREATE TABLE `enterprise_stat` (
  `id` bigint(20) NOT NULL,
  `enterprise_id` bigint(20) NOT NULL,
  `ape_code` varchar(5) NOT NULL,
  `ape_name` varchar(500) NOT NULL,
  `workers_number` int(11) NOT NULL,
  `accidents_number` int(11) NOT NULL,
  `index_of_frequency` float NOT NULL,
  `year` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `injury_location`
--

CREATE TABLE `injury_location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `injury_location`
--

INSERT INTO `injury_location` (`id`, `name`) VALUES
(1, 'Tête et cou, y compris yeux'),
(2, 'Membres supérieurs, y compris mains et doigts'),
(3, 'Torse et organes'),
(4, 'Membres inférieurs'),
(5, 'Multiples endroits du corps affectés'),
(6, 'Inconnu ou non précisé');

-- --------------------------------------------------------

--
-- Structure de la table `injury_location_enterprise`
--

CREATE TABLE `injury_location_enterprise` (
  `injury_location_id` int(11) NOT NULL,
  `enterprise_stat_id` bigint(20) NOT NULL,
  `number` bigint(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `injury_location_national`
--

CREATE TABLE `injury_location_national` (
  `injury_location_id` int(11) NOT NULL,
  `national_stat_id` bigint(20) NOT NULL,
  `number` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `injury_nature`
--

CREATE TABLE `injury_nature` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `injury_nature`
--

INSERT INTO `injury_nature` (`id`, `name`) VALUES
(1, 'Traumatismes internes'),
(2, 'Plaies ouvertes'),
(3, 'Commotions et traumatismes internes'),
(4, 'Chocs traumatiques'),
(5, 'Entorses et foulures'),
(6, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `injury_nature_enterprise`
--

CREATE TABLE `injury_nature_enterprise` (
  `injury_nature_id` int(11) NOT NULL,
  `enterprise_stat_id` bigint(20) NOT NULL,
  `number` bigint(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `injury_nature_national`
--

CREATE TABLE `injury_nature_national` (
  `injury_nature_id` int(11) NOT NULL,
  `national_stat_id` bigint(20) NOT NULL,
  `number` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `national_stat`
--

CREATE TABLE `national_stat` (
  `id` bigint(20) NOT NULL,
  `ape_code` varchar(5) NOT NULL,
  `ape_name` varchar(500) NOT NULL,
  `workers_number` int(11) NOT NULL,
  `accidents_number` int(11) NOT NULL,
  `index_of_frequency` float NOT NULL,
  `year` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `risk`
--

CREATE TABLE `risk` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `risk`
--

INSERT INTO `risk` (`id`, `name`) VALUES
(1, 'Manutention manuelle'),
(2, 'Outillage à main'),
(3, 'Chutes de plain-pied'),
(4, 'Chutes de hauteur'),
(5, 'Machines'),
(6, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `risk_enterprise`
--

CREATE TABLE `risk_enterprise` (
  `risk_id` int(11) NOT NULL,
  `enterprise_stat_id` bigint(20) NOT NULL,
  `number` bigint(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `risk_national`
--

CREATE TABLE `risk_national` (
  `risk_id` int(11) NOT NULL,
  `national_stat_id` bigint(20) NOT NULL,
  `number` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'rôle test'),
(2, 'user'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `enterprise`
--
ALTER TABLE `enterprise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `enterprise_stat`
--
ALTER TABLE `enterprise_stat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_id` (`enterprise_id`);

--
-- Index pour la table `injury_location`
--
ALTER TABLE `injury_location`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `injury_location_enterprise`
--
ALTER TABLE `injury_location_enterprise`
  ADD PRIMARY KEY (`injury_location_id`,`enterprise_stat_id`),
  ADD KEY `injury_location_id` (`injury_location_id`,`enterprise_stat_id`),
  ADD KEY `enterprises_stats_id` (`enterprise_stat_id`);

--
-- Index pour la table `injury_location_national`
--
ALTER TABLE `injury_location_national`
  ADD PRIMARY KEY (`national_stat_id`,`injury_location_id`),
  ADD KEY `injury_location_id` (`injury_location_id`),
  ADD KEY `national_stats_id` (`national_stat_id`);

--
-- Index pour la table `injury_nature`
--
ALTER TABLE `injury_nature`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `injury_nature_enterprise`
--
ALTER TABLE `injury_nature_enterprise`
  ADD PRIMARY KEY (`injury_nature_id`,`enterprise_stat_id`),
  ADD KEY `injury_nature_id` (`injury_nature_id`),
  ADD KEY `enterprises_stats_id` (`enterprise_stat_id`);

--
-- Index pour la table `injury_nature_national`
--
ALTER TABLE `injury_nature_national`
  ADD PRIMARY KEY (`national_stat_id`,`injury_nature_id`),
  ADD KEY `national_stats_id` (`national_stat_id`,`injury_nature_id`),
  ADD KEY `injury_nature_id` (`injury_nature_id`);

--
-- Index pour la table `national_stat`
--
ALTER TABLE `national_stat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `risk`
--
ALTER TABLE `risk`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `risk_enterprise`
--
ALTER TABLE `risk_enterprise`
  ADD PRIMARY KEY (`risk_id`,`enterprise_stat_id`),
  ADD KEY `risk_id` (`risk_id`,`enterprise_stat_id`),
  ADD KEY `enterprises_stats_id` (`enterprise_stat_id`);

--
-- Index pour la table `risk_national`
--
ALTER TABLE `risk_national`
  ADD PRIMARY KEY (`national_stat_id`,`risk_id`),
  ADD KEY `national_stats_id` (`national_stat_id`,`risk_id`),
  ADD KEY `risk_id` (`risk_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enterprise`
--
ALTER TABLE `enterprise`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enterprise_stat`
--
ALTER TABLE `enterprise_stat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `injury_location`
--
ALTER TABLE `injury_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `injury_nature`
--
ALTER TABLE `injury_nature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `national_stat`
--
ALTER TABLE `national_stat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `risk`
--
ALTER TABLE `risk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enterprise`
--
ALTER TABLE `enterprise`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `enterprise_stat`
--
ALTER TABLE `enterprise_stat`
  ADD CONSTRAINT `enterprise_stat_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `injury_location_enterprise`
--
ALTER TABLE `injury_location_enterprise`
  ADD CONSTRAINT `injury_location_enterprise_ibfk_1` FOREIGN KEY (`enterprise_stat_id`) REFERENCES `enterprise_stat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `injury_location_enterprise_ibfk_2` FOREIGN KEY (`injury_location_id`) REFERENCES `injury_location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `injury_location_national`
--
ALTER TABLE `injury_location_national`
  ADD CONSTRAINT `injury_location_national_ibfk_1` FOREIGN KEY (`injury_location_id`) REFERENCES `injury_location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `injury_location_national_ibfk_2` FOREIGN KEY (`national_stat_id`) REFERENCES `national_stat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `injury_nature_enterprise`
--
ALTER TABLE `injury_nature_enterprise`
  ADD CONSTRAINT `injury_nature_enterprise_ibfk_1` FOREIGN KEY (`injury_nature_id`) REFERENCES `injury_nature` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `injury_nature_enterprise_ibfk_2` FOREIGN KEY (`enterprise_stat_id`) REFERENCES `enterprise_stat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `injury_nature_national`
--
ALTER TABLE `injury_nature_national`
  ADD CONSTRAINT `injury_nature_national_ibfk_1` FOREIGN KEY (`injury_nature_id`) REFERENCES `injury_nature` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `injury_nature_national_ibfk_2` FOREIGN KEY (`national_stat_id`) REFERENCES `national_stat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `risk_enterprise`
--
ALTER TABLE `risk_enterprise`
  ADD CONSTRAINT `risk_enterprise_ibfk_1` FOREIGN KEY (`enterprise_stat_id`) REFERENCES `enterprise_stat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risk_enterprise_ibfk_2` FOREIGN KEY (`risk_id`) REFERENCES `risk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `risk_national`
--
ALTER TABLE `risk_national`
  ADD CONSTRAINT `risk_national_ibfk_1` FOREIGN KEY (`risk_id`) REFERENCES `risk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risk_national_ibfk_2` FOREIGN KEY (`national_stat_id`) REFERENCES `national_stat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
