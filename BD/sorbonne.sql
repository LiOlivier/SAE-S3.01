-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 16 jan. 2025 à 10:22
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sorbonne`
--

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

CREATE TABLE `action` (
  `Id_Action` int(11) NOT NULL,
  `annee` int(11) DEFAULT NULL,
  `Id_Departement` int(11) DEFAULT NULL,
  `numSemestre` int(11) DEFAULT NULL,
  `Id_Etudiant` int(11) DEFAULT NULL,
  `Id_Stage` int(11) DEFAULT NULL,
  `date_realisation` int(11) DEFAULT NULL,
  `lienDocument` varchar(255) DEFAULT NULL,
  `Id_TypeAction` int(11) NOT NULL,
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `Id` int(11) NOT NULL,
  `id_Administrateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`Id`, `id_Administrateur`) VALUES
(8, 0),
(9, 0);

-- --------------------------------------------------------

--
-- Structure de la table `annee`
--

CREATE TABLE `annee` (
  `annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annee`
--

INSERT INTO `annee` (`annee`) VALUES
(2023),
(2024),
(2025);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `Id_Departement` int(11) NOT NULL,
  `Libelle` varchar(255) DEFAULT NULL,
  `Id_Enseignant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`Id_Departement`, `Libelle`, `Id_Enseignant`) VALUES
(1, 'INFO', 8);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(11) NOT NULL,
  `id_Enseignant` int(11) NOT NULL,
  `id_Etudiant` int(11) NOT NULL,
  `Bureau` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `id_Enseignant`, `id_Etudiant`, `Bureau`) VALUES
(8, 2, 54, 'L105');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `Id_Entreprise` int(11) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `indicationVisite` tinyint(1) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`Id_Entreprise`, `adresse`, `code_postal`, `ville`, `indicationVisite`, `tel`) VALUES
(1, '16 rue Jean Courtois', 72400, 'La Ferté-Bernard', 1, '0500813500'),
(2, '8 rue Jean Morgon', 1000, 'Bourg-en-Bresse', 1, '0184986414'),
(3, '32 rue Paul Eluard', 27140, 'Gisors', 0, '9900115577'),
(4, '7 rue de la Roche', 79360, 'Les Fosses', 1, '0123456789'),
(5, '21 rue Pascal', 18000, 'Bourges', 0, '9876543210'),
(6, '39 rue Baron Louis', 54200, 'Toul', 1, '0000000000'),
(7, '26 rue Saint-Julien', 33112, 'Saint-Laurent-Médoc', 0, '6666666666');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `Id_Etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_Etudiant`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Structure de la table `gere`
--

CREATE TABLE `gere` (
  `Id_Departement` int(11) NOT NULL,
  `numSemestre` int(11) NOT NULL,
  `Id_Secretaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gere`
--

INSERT INTO `gere` (`Id_Departement`, `numSemestre`, `Id_Secretaire`) VALUES
(1, 4, 9);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `annee` int(11) NOT NULL,
  `Id_Departement` int(11) NOT NULL,
  `numSemestre` int(11) NOT NULL,
  `Id_Etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`annee`, `Id_Departement`, `numSemestre`, `Id_Etudiant`) VALUES
(2024, 1, 4, 1),
(2024, 1, 4, 2),
(2024, 1, 4, 3),
(2024, 1, 4, 4),
(2024, 1, 4, 5),
(2024, 1, 4, 6),
(2024, 1, 4, 7);

-- --------------------------------------------------------

--
-- Structure de la table `intervient`
--

CREATE TABLE `intervient` (
  `Id_Enseignant` int(11) NOT NULL,
  `Id_Departement` int(11) NOT NULL,
  `specialise` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `intervient`
--

INSERT INTO `intervient` (`Id_Enseignant`, `Id_Departement`, `specialise`) VALUES
(8, 1, 'BD');

-- --------------------------------------------------------

--
-- Structure de la table `secretaire`
--

CREATE TABLE `secretaire` (
  `Id_Secretaire` int(11) NOT NULL,
  `Bureau` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `secretaire`
--

INSERT INTO `secretaire` (`Id_Secretaire`, `Bureau`) VALUES
(9, 'L100');

-- --------------------------------------------------------

--
-- Structure de la table `semestre`
--

CREATE TABLE `semestre` (
  `Id_Departement` int(11) NOT NULL,
  `numSemestre` int(11) NOT NULL,
  `Id_Enseignant` int(11) NOT NULL,
  `annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `semestre`
--

INSERT INTO `semestre` (`Id_Departement`, `numSemestre`, `Id_Enseignant`, `annee`) VALUES
(1, 4, 8, 2024);

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `Id_Stage` int(11) NOT NULL,
  `annee` int(11) DEFAULT NULL,
  `Id_Departement` int(11) DEFAULT NULL,
  `numSemestre` int(11) DEFAULT NULL,
  `Id_Etudiant` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `mission` varchar(255) DEFAULT NULL,
  `date_soutenance` date DEFAULT NULL,
  `salle_soutenance` varchar(255) DEFAULT NULL,
  `Id_Enseignant_1` int(11) DEFAULT NULL,
  `Id_Tuteur_Entreprise` int(11) NOT NULL,
  `Id_Enseignant_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`Id_Stage`, `annee`, `Id_Departement`, `numSemestre`, `Id_Etudiant`, `date_debut`, `date_fin`, `mission`, `date_soutenance`, `salle_soutenance`, `Id_Enseignant_1`, `Id_Tuteur_Entreprise`, `Id_Enseignant_2`) VALUES
(1, 2024, 1, 4, 1, '2024-04-01', '2024-06-30', 'Développement d’une application web', '2024-07-15', 'Salle A1', 8, 9, 8),
(2, 2024, 1, 4, 2, '2024-05-01', '2024-07-31', 'Analyse des données clients', '2024-08-20', 'Salle B2', 8, 9, 8);

-- --------------------------------------------------------

--
-- Structure de la table `tuteur_entreprise`
--

CREATE TABLE `tuteur_entreprise` (
  `Id` int(11) NOT NULL,
  `id_Tuteur_Entreprise` int(11) NOT NULL,
  `id_Etudiant` int(11) NOT NULL,
  `Id_Entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tuteur_entreprise`
--

INSERT INTO `tuteur_entreprise` (`Id`, `id_Tuteur_Entreprise`, `id_Etudiant`, `Id_Entreprise`) VALUES
(8, 6, 54, 1),
(9, 5, 54, 3);

-- --------------------------------------------------------

--
-- Structure de la table `typeaction`
--

CREATE TABLE `typeaction` (
  `Id_TypeAction` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `Executant` varchar(255) DEFAULT NULL,
  `Destinataire` varchar(255) DEFAULT NULL,
  `delaiEnJours` int(11) DEFAULT NULL,
  `ReferenceDelai` int(11) DEFAULT NULL,
  `requiertDoc` varchar(255) DEFAULT NULL,
  `LienModeleDoc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typeaction`
--

INSERT INTO `typeaction` (`Id_TypeAction`, `libelle`, `Executant`, `Destinataire`, `delaiEnJours`, `ReferenceDelai`, `requiertDoc`, `LienModeleDoc`) VALUES
(1, 'Rapport d’installation', 'Etudiant', 'Tuteur Pédagogique', 7, 1, 'Oui', 'lien_modele_rapport_installation.pdf'),
(2, 'Contact Entreprise', 'Tuteur Pédagogique', 'Entreprise', 14, 1, 'Non', NULL),
(3, 'Entretien Mi-Stage', 'Tuteur Pédagogique', 'Entreprise', 30, 1, 'Non', NULL),
(4, 'Planification Soutenance', 'Tuteur Pédagogique', 'Etudiant', 90, 2, 'Oui', 'lien_modele_planification.pdf'),
(5, 'Dépôt Rapport de Stage', 'Etudiant', 'Tuteur Pédagogique', 100, 2, 'Oui', 'lien_modele_rapport_stage.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('etudiant','enseignant','administrateur','secretaire','tuteur') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `telephone`, `login`, `password`, `role`) VALUES
(1, 'Essafa', 'Yassine', 'yassineessafa49@gmail.com', '0102030405', '12302332', '090709756JF', 'etudiant'),
(2, 'Vuong', 'Denis', 'vuong.denis.p@gmail.com', '0607080910', '48944444', 'gb59etffffre', 'enseignant'),
(3, 'Rattina', 'Bharani', 'bharanirattina@gmail.com', '1009080706', '4895615649', 'sdfghrYUGGrhs', 'administrateur'),
(4, 'Lointier', 'Maxime', 'lointier.maxime@gmail.com', '0504030201', 'max', '12345', 'tuteur'),
(5, 'Pham', 'Huy', 'phamhuy110205@gmail.com', '6984563269', 'L0gIn', '455985cecfe', 'tuteur'),
(6, 'Li', 'Olivier', 'liolivier98@gmail.com', '0700000000', 'grr955efefef', 'YUEFUvfb8484', 'tuteur'),
(7, 'Jeremias', 'Sherwin', 'sherwinfrance18@gmail.com', '0880088008', 'XxgoatxX', 'gojgoirssssss', 'etudiant'),
(8, 'Audibert', 'Laurent', 'laurent.audibert@univ-paris13.fr', '9999999999', 'szdLPLSZ89', 'lplflel', 'etudiant'),
(9, 'Preteseille', 'Christine', 'christine.preteseille@gmail.com', '19451677411', 'siuuujxjjqj7', 'jujuujjuju', 'etudiant'),
(50, 'ygtfrd', 'Loick', 'gf@hgf.com', '098765', 'lolo', '$argon2id$v=19$m=262144,t=4,p=2$TEhqS2pheTRqdGtsRzRPbg$Pvx6PVO6++6p+UcCusOrZ7lr2kXSC6yL9ahxevlyxd8', 'etudiant'),
(53, 'notlointier', 'notmaxime', 'hahahha@gmail.com', '45197815615', 'notmaxime', '$argon2id$v=19$m=262144,t=4,p=2$LjlqQUpMcWJsT1dKeVFyWA$O1a4F+UJeRmWnXKzcmwlpr9BEqoyy2SHgrzPWyFvJ0I', 'etudiant'),
(54, 'lointier', 'Maxsous', 'erghgre@gmail.com', '1515', 'maxsous', '$argon2id$v=19$m=262144,t=4,p=2$ZXQxc1NueWR2bUxWbVk1Sw$NDKJxQEXpoM0GFc2QQBAIwYI9Q3VXpK905c8p/lxqLw', 'etudiant');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`Id_Action`),
  ADD UNIQUE KEY `annee` (`annee`,`Id_Departement`,`numSemestre`,`Id_Etudiant`,`Id_Stage`),
  ADD KEY `Id_TypeAction` (`Id_TypeAction`),
  ADD KEY `Id` (`Id`);

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `annee`
--
ALTER TABLE `annee`
  ADD PRIMARY KEY (`annee`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`Id_Departement`),
  ADD UNIQUE KEY `Id_Enseignant` (`Id_Enseignant`),
  ADD UNIQUE KEY `Libelle` (`Libelle`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`Id_Entreprise`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`Id_Etudiant`);

--
-- Index pour la table `gere`
--
ALTER TABLE `gere`
  ADD PRIMARY KEY (`Id_Departement`,`numSemestre`,`Id_Secretaire`),
  ADD KEY `Id_Secretaire` (`Id_Secretaire`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`annee`,`Id_Departement`,`numSemestre`,`Id_Etudiant`),
  ADD KEY `Id_Departement` (`Id_Departement`,`numSemestre`),
  ADD KEY `Id_Etudiant` (`Id_Etudiant`);

--
-- Index pour la table `intervient`
--
ALTER TABLE `intervient`
  ADD PRIMARY KEY (`Id_Departement`,`Id_Enseignant`),
  ADD KEY `Id_Enseignant` (`Id_Enseignant`);

--
-- Index pour la table `secretaire`
--
ALTER TABLE `secretaire`
  ADD PRIMARY KEY (`Id_Secretaire`);

--
-- Index pour la table `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`Id_Departement`,`numSemestre`),
  ADD UNIQUE KEY `Id_Enseignant` (`Id_Enseignant`),
  ADD KEY `annee` (`annee`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`Id_Stage`),
  ADD UNIQUE KEY `annee` (`annee`,`Id_Departement`,`numSemestre`,`Id_Etudiant`),
  ADD KEY `Id_Tuteur_Entreprise` (`Id_Tuteur_Entreprise`),
  ADD KEY `Id_Enseignant_1` (`Id_Enseignant_1`),
  ADD KEY `Id_Enseignant_2` (`Id_Enseignant_2`);

--
-- Index pour la table `tuteur_entreprise`
--
ALTER TABLE `tuteur_entreprise`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Entreprise` (`Id_Entreprise`);

--
-- Index pour la table `typeaction`
--
ALTER TABLE `typeaction`
  ADD PRIMARY KEY (`Id_TypeAction`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `motdepasse` (`password`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `action`
--
ALTER TABLE `action`
  MODIFY `Id_Action` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `Id_Departement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `Id_Entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `Id_Stage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typeaction`
--
ALTER TABLE `typeaction`
  MODIFY `Id_TypeAction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `action_ibfk_1` FOREIGN KEY (`annee`,`Id_Departement`,`numSemestre`,`Id_Etudiant`,`Id_Stage`) REFERENCES `stage` (`annee`, `Id_Departement`, `numSemestre`, `Id_Etudiant`, `Id_Stage`),
  ADD CONSTRAINT `action_ibfk_2` FOREIGN KEY (`Id_TypeAction`) REFERENCES `typeaction` (`Id_TypeAction`),
  ADD CONSTRAINT `action_ibfk_3` FOREIGN KEY (`Id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`Id_Enseignant`) REFERENCES `enseignant` (`id`);

--
-- Contraintes pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`Id_Etudiant`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `gere`
--
ALTER TABLE `gere`
  ADD CONSTRAINT `gere_ibfk_1` FOREIGN KEY (`Id_Secretaire`) REFERENCES `secretaire` (`Id_Secretaire`),
  ADD CONSTRAINT `gere_ibfk_2` FOREIGN KEY (`Id_Departement`,`numSemestre`) REFERENCES `semestre` (`Id_Departement`, `numSemestre`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`Id_Departement`,`numSemestre`) REFERENCES `semestre` (`Id_Departement`, `numSemestre`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`Id_Etudiant`) REFERENCES `etudiant` (`Id_Etudiant`),
  ADD CONSTRAINT `inscription_ibfk_3` FOREIGN KEY (`annee`) REFERENCES `annee` (`annee`);

--
-- Contraintes pour la table `intervient`
--
ALTER TABLE `intervient`
  ADD CONSTRAINT `intervient_ibfk_1` FOREIGN KEY (`Id_Enseignant`) REFERENCES `enseignant` (`id`),
  ADD CONSTRAINT `intervient_ibfk_2` FOREIGN KEY (`Id_Departement`) REFERENCES `departement` (`Id_Departement`);

--
-- Contraintes pour la table `secretaire`
--
ALTER TABLE `secretaire`
  ADD CONSTRAINT `secretaire_ibfk_1` FOREIGN KEY (`Id_Secretaire`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `semestre`
--
ALTER TABLE `semestre`
  ADD CONSTRAINT `semestre_ibfk_1` FOREIGN KEY (`Id_Departement`) REFERENCES `departement` (`Id_Departement`),
  ADD CONSTRAINT `semestre_ibfk_2` FOREIGN KEY (`Id_Enseignant`) REFERENCES `enseignant` (`id`),
  ADD CONSTRAINT `semestre_ibfk_3` FOREIGN KEY (`annee`) REFERENCES `annee` (`annee`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`annee`,`Id_Departement`,`numSemestre`,`Id_Etudiant`) REFERENCES `inscription` (`annee`, `Id_Departement`, `numSemestre`, `Id_Etudiant`),
  ADD CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`Id_Tuteur_Entreprise`) REFERENCES `tuteur_entreprise` (`Id`),
  ADD CONSTRAINT `stage_ibfk_3` FOREIGN KEY (`Id_Enseignant_1`) REFERENCES `enseignant` (`id`),
  ADD CONSTRAINT `stage_ibfk_4` FOREIGN KEY (`Id_Enseignant_2`) REFERENCES `enseignant` (`id`);

--
-- Contraintes pour la table `tuteur_entreprise`
--
ALTER TABLE `tuteur_entreprise`
  ADD CONSTRAINT `tuteur_entreprise_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `tuteur_entreprise_ibfk_2` FOREIGN KEY (`Id_Entreprise`) REFERENCES `entreprise` (`Id_Entreprise`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
