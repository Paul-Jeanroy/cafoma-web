-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 30 mars 2023 à 12:40
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cafomabdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP DATABASE IF EXISTS cafomabdd ;
CREATE DATABASE cafomabdd CHARACTER SET utf8;

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `acronyme` char(5) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(150) NOT NULL,
  `video` varchar(150) NOT NULL,
  `login_createur` varchar(50) NOT NULL,
  `pour_qui` varchar(250) NOT NULL,
  `prerequis` varchar(250) NOT NULL,
  PRIMARY KEY (`acronyme`),
  KEY `utilisateur_FK` (`login_createur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`acronyme`, `titre`, `description`, `image`, `video`, `login_createur`, `pour_qui`, `prerequis`) VALUES
('HMLCS', 'HTML et CSS', 'Apprentissage de l\'HTML et du CSS', '77201_html&css.png', '28460_html&css.png', 'test', 'tout le monde', 'aucun'),
('HTML', 'HTML', 'test', '50598_html.png', 'IntroHTML.mp4', 'test', 'tous le monde', 'aucun'),
('JS', 'JavaScript', 'd,skldsk,f', '20908_js.png', '37145_js.png', 'admin', 'moi', 'aucun'),
('test', 'test', 'test', '18172_fond_accueil.jpg', '23344_c.png', 'test', 'iudnq', 'knfds');

-- --------------------------------------------------------


--
-- Structure de la table `ressources`
--
DROP TABLE IF EXISTS `sequence`;
CREATE TABLE IF NOT EXISTS `sequence` (
  `acronyme` char(5) NOT NULL,
  `numero_sequence` int NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (acronyme,`numero_sequence`),
  KEY `formation_sequence_acronyme_FK` (`acronyme`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `sequence`
--

INSERT INTO `sequence` (acronyme, `numero_sequence`, `intitule`, `description`) VALUES
('HTML',1, 'Avant de commencer #1', 'Avant de commencer #1');


DROP TABLE IF EXISTS `ressources`;
CREATE TABLE IF NOT EXISTS `ressources` (
  `acronyme` char(5) NOT NULL,
  `numero_sequence` int NOT NULL,
  `numero_ressource` int NOT NULL,
  `intitule` text NOT NULL,
  `type_document` varchar(10) NOT NULL,
  `document` text NOT NULL,
  PRIMARY KEY (`acronyme`,`numero_sequence`,numero_ressource),
  CONSTRAINT  acronyme_sequence_sequence_FK FOREIGN KEY (`acronyme`,`numero_sequence`) REFERENCES sequence (`acronyme`,`numero_sequence`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ressources`
--

INSERT INTO `ressources` (acronyme, `numero_sequence`, numero_ressource, `intitule`, `type_document`, `document`) VALUES
('HTML',1,1, 'Introduction #1', 'video', 'introHTML.mp4'),
('HTML',1,2, 'Les bases de l\'HTML', 'pdf', '58579_fond_accueil.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `sequence`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `login` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `est_valide` tinyint(1) NOT NULL,
  `clef` varchar(50) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `password`, `mail`, `role`, `image`, `est_valide`, `clef`, `token`) VALUES
('abonne', '$2y$10$pF2pLd2Cs8tuQv2kKonj/ujHiQf6s.Tuo5ZmKxcy927GN11iyxpIC', 'ctouti@gmail.com', 'etudiant', 'profil.png', 1, NULL, NULL),
('admin', '$2y$10$Z.NV5jhY4Emy2XRJlbVnJ.uWsmeJkOB06xKq5Eb8ml9QapXUOJOmm', 'ctouti@gmail.com', 'administrateur', 'profil.png', 1, NULL, NULL),
('paul', '$2y$10$UphC1kdaEKwvEVRqaawoT.Jbkfh9BpRqUv9NgO47yzs678QC/IyWu', 'pauljeanroy12345@gmail.com', 'etudiant', 'profil.png', 1, '6415f883f31bb', NULL),
('test', '$2y$10$Jpn.CEI6v.OBJg1KwZXJlOlVbJVfK0zi0ixIhpFLFJsaseCSZCd8.', 'partenaire@partenaire.com', 'partenaire', 'profil.png', 1, '6418c500f0633', NULL),
('tophe', '$2y$10$1wRqiw9qcMXT2lD69DQgpetpq2GuzNN8pqLqa0hFQAg9kL6PiIKYa', 'ctouti@gmail.com', 'administrateur', 'profil.png', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_formation_inscrire`
--

DROP TABLE IF EXISTS `utilisateur_formation_inscrire`;
CREATE TABLE IF NOT EXISTS `utilisateur_formation_inscrire` (
  `login` varchar(50) NOT NULL,
  `acronyme` char(5) NOT NULL,
  `date_inscription` datetime NOT NULL,
  PRIMARY KEY (`login`,`acronyme`),
  KEY `ufi_formation_FK` (`acronyme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur_formation_inscrire`
--

INSERT INTO `utilisateur_formation_inscrire` (`login`, `acronyme`, `date_inscription`) VALUES
('paul', 'HMLCS', '2023-03-27 12:10:22'),
('paul', 'HTML', '2023-03-29 18:20:51'),
('paul', 'JS', '2023-03-27 11:46:14');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `utilisateur_FK` FOREIGN KEY (`login_createur`) REFERENCES `utilisateur` (`login`);



--
-- Contraintes pour la table `ressources`
--
ALTER TABLE `ressources`
  ADD CONSTRAINT `,numero_sequence_ressource_FK` FOREIGN KEY (acronyme,`numero_sequence`) REFERENCES `sequence` (acronyme,`numero_sequence`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `sequence`
--
ALTER TABLE `sequence`
  ADD CONSTRAINT `formation_sequence_acronyme_FK` FOREIGN KEY (`acronyme`) REFERENCES `formation` (`acronyme`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `utilisateur_formation_inscrire`
--
ALTER TABLE `utilisateur_formation_inscrire`
  ADD CONSTRAINT `ufi_formation_FK` FOREIGN KEY (`acronyme`) REFERENCES `formation` (`acronyme`),
  ADD CONSTRAINT `ufi_utilisateur_FK` FOREIGN KEY (`login`) REFERENCES `utilisateur` (`login`);
COMMIT;

