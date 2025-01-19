-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 04:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barani`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `Id_Action` int(11) NOT NULL,
  `annee` int(11) DEFAULT NULL,
  `Id_Departement` int(11) DEFAULT NULL,
  `numSemestre` int(11) DEFAULT NULL,
  `Id_Etudiant` int(11) DEFAULT NULL,
  `Id_Stage` int(11) DEFAULT NULL,
  `date_realisation` date DEFAULT NULL,
  `lienDocument` varchar(255) DEFAULT NULL,
  `Id_TypeAction` int(11) NOT NULL,
  `Id` int(11) NOT NULL,
  `Etat` enum('A faire','En attente','Valider','Refuser') NOT NULL DEFAULT 'A faire',
  `id_Pedagogique` int(11) DEFAULT NULL,
  `Id_Tuteur_Entreprise` int(11) DEFAULT NULL,
  `Id_Secretaire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE `administrateur` (
  `Id_Administrateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`Id_Administrateur`) VALUES
(31);

-- --------------------------------------------------------

--
-- Table structure for table `annee`
--

CREATE TABLE `annee` (
  `annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `annee`
--

INSERT INTO `annee` (`annee`) VALUES
(2023),
(2024),
(2025),
(2026);

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `Id_Departement` int(11) NOT NULL,
  `Libelle` varchar(255) DEFAULT NULL,
  `Id_Enseignant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`Id_Departement`, `Libelle`, `Id_Enseignant`) VALUES
(1, 'INFO', 8),
(2, 'GEA', 9),
(3, 'RT', 10),
(4, 'SD', 11);

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `Id_Enseignant` int(11) NOT NULL,
  `Bureau` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`Id_Enseignant`, `Bureau`) VALUES
(8, 'L105'),
(9, 'L106'),
(10, 'L107'),
(11, 'L108'),
(12, 'L109'),
(13, 'L110'),
(22, 'T105'),
(23, 'G107');

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE `entreprise` (
  `Id_Entreprise` int(11) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `indicationVisite` tinyint(1) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `entreprise`
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
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(24),
(25),
(26),
(27),
(28),
(29),
(30);

-- --------------------------------------------------------

--
-- Table structure for table `gere`
--

CREATE TABLE `gere` (
  `Id_Departement` int(11) NOT NULL,
  `numSemestre` int(11) NOT NULL,
  `Id_Secretaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gere`
--

INSERT INTO `gere` (`Id_Departement`, `numSemestre`, `Id_Secretaire`) VALUES
(1, 4, 15),
(2, 4, 15);

-- --------------------------------------------------------

--
-- Table structure for table `inscription`
--

CREATE TABLE `inscription` (
  `annee` int(11) NOT NULL,
  `Id_Departement` int(11) NOT NULL,
  `numSemestre` int(11) NOT NULL,
  `Id_Etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `inscription`
--

INSERT INTO `inscription` (`annee`, `Id_Departement`, `numSemestre`, `Id_Etudiant`) VALUES
(2024, 1, 4, 1),
(2024, 1, 4, 2),
(2024, 1, 4, 3),
(2024, 1, 4, 4),
(2024, 1, 4, 5),
(2024, 1, 4, 6),
(2024, 1, 4, 7),
(2024, 2, 4, 24),
(2024, 3, 4, 27),
(2024, 4, 4, 29),
(2025, 1, 6, 25),
(2025, 2, 6, 26),
(2025, 3, 6, 28),
(2025, 4, 6, 30);

-- --------------------------------------------------------

--
-- Table structure for table `intervient`
--

CREATE TABLE `intervient` (
  `Id_Enseignant` int(11) NOT NULL,
  `Id_Departement` int(11) NOT NULL,
  `specialise` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `intervient`
--

INSERT INTO `intervient` (`Id_Enseignant`, `Id_Departement`, `specialise`) VALUES
(8, 1, 'BD');

-- --------------------------------------------------------

--
-- Table structure for table `pedagogique`
--

CREATE TABLE `pedagogique` (
  `id` int(11) NOT NULL,
  `id_Pedagogique` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `Bureau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pedagogique`
--

INSERT INTO `pedagogique` (`id`, `id_Pedagogique`, `id_etudiant`, `Bureau`) VALUES
(1, 8, 4, 'l105');

-- --------------------------------------------------------

--
-- Table structure for table `secretaire`
--

CREATE TABLE `secretaire` (
  `Id_Secretaire` int(11) NOT NULL,
  `Bureau` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `secretaire`
--

INSERT INTO `secretaire` (`Id_Secretaire`, `Bureau`) VALUES
(15, 'L100'),
(16, 'L101');

-- --------------------------------------------------------

--
-- Table structure for table `semestre`
--

CREATE TABLE `semestre` (
  `Id_Departement` int(11) NOT NULL,
  `numSemestre` int(11) NOT NULL,
  `Id_Enseignant` int(11) NOT NULL,
  `annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `semestre`
--

INSERT INTO `semestre` (`Id_Departement`, `numSemestre`, `Id_Enseignant`, `annee`) VALUES
(1, 4, 8, 2024),
(1, 6, 9, 2025),
(2, 4, 10, 2024),
(2, 6, 11, 2025),
(3, 4, 12, 2024),
(3, 6, 13, 2025),
(4, 4, 22, 2024),
(4, 6, 23, 2025);

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `annee` int(11) DEFAULT NULL,
  `Id_Departement` int(11) DEFAULT NULL,
  `numSemestre` int(11) DEFAULT NULL,
  `Id_Etudiant` int(11) DEFAULT NULL,
  `Id_Stage` int(11) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `mission` varchar(255) DEFAULT NULL,
  `date_soutenance` varchar(255) DEFAULT NULL,
  `salle_soutenance` varchar(255) DEFAULT NULL,
  `Id_Enseignant_1` int(11) DEFAULT NULL,
  `Id_Tuteur_Entreprise` int(11) DEFAULT NULL,
  `Id_Enseignant_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`annee`, `Id_Departement`, `numSemestre`, `Id_Etudiant`, `Id_Stage`, `date_debut`, `date_fin`, `mission`, `date_soutenance`, `salle_soutenance`, `Id_Enseignant_1`, `Id_Tuteur_Entreprise`, `Id_Enseignant_2`) VALUES
(2024, 1, 4, 1, 1, '2024-04-01', '2024-06-30', 'Développement d’une application web', '2024-07-15', 'Salle A1', 8, 17, 9),
(2024, 1, 4, 2, 2, '2024-05-01', '2024-07-31', 'Analyse des données clients', '2024-08-20', 'Salle B2', 8, 18, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tuteur_entreprise`
--

CREATE TABLE `tuteur_entreprise` (
  `id` int(11) NOT NULL,
  `Id_Entreprise` int(11) NOT NULL,
  `Id_Tuteur_Entreprise` int(11) NOT NULL,
  `id_Pedagogique` int(11) NOT NULL,
  `id_Etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tuteur_entreprise`
--

INSERT INTO `tuteur_entreprise` (`id`, `Id_Entreprise`, `Id_Tuteur_Entreprise`, `id_Pedagogique`, `id_Etudiant`) VALUES
(17, 1, 0, 0, 0),
(18, 2, 0, 0, 0),
(19, 3, 0, 0, 0),
(20, 4, 0, 0, 0),
(21, 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `typeaction`
--

CREATE TABLE `typeaction` (
  `Id_TypeAction` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `Executant` varchar(255) NOT NULL,
  `Destinataire` varchar(255) NOT NULL,
  `delaiEnJours` int(11) DEFAULT NULL,
  `dateLimite` date DEFAULT NULL,
  `ReferenceDelai` int(11) DEFAULT NULL,
  `requiertDoc` enum('oui','non') NOT NULL DEFAULT 'non',
  `LienModeleDoc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `typeaction`
--

INSERT INTO `typeaction` (`Id_TypeAction`, `libelle`, `Executant`, `Destinataire`, `delaiEnJours`, `dateLimite`, `ReferenceDelai`, `requiertDoc`, `LienModeleDoc`) VALUES
(1, 'Chargement des informations du stage', 'Responsable de Stage', 'Application', 0, NULL, NULL, 'non', NULL),
(2, 'Compte rendu d\'installation', 'Etudiant', 'Tuteur Pédagogique', 7, NULL, 1, 'oui', 'lien_modele_compte_rendu_installation.pdf'),
(3, 'Contact avec l\'entreprise', 'Tuteur Pédagogique', 'Entreprise', 14, NULL, 1, 'non', NULL),
(4, 'Entretien mi-stage', 'Tuteur Pédagogique', 'Entreprise', 30, NULL, 1, 'non', NULL),
(5, 'Planification de la soutenance', 'Tuteur Pédagogique', 'Etudiant', 21, NULL, 2, 'oui', 'lien_modele_planification_soutenance.pdf'),
(6, 'Dépôt du rapport de stage', 'Etudiant', 'Tuteur Pédagogique, Second Jury', 100, NULL, 2, 'oui', 'lien_modele_rapport_stage.pdf'),
(7, 'Dépôt du bordereau de stage', 'Etudiant', 'Responsable de Stage', 7, NULL, 1, 'oui', 'lien_modele_bordereau_stage.pdf'),
(8, 'Validation du bordereau de stage', 'Responsable de Stage', 'Etudiant', 14, NULL, 1, 'non', NULL),
(9, 'Dépôt de la convention de stage', 'Etudiant', 'Responsable de Stage', 7, NULL, 1, 'oui', 'lien_modele_convention_stage.pdf'),
(10, 'Validation de la convention de stage', 'Responsable de Stage', 'Etudiant', 14, NULL, 1, 'non', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('etudiant','enseignant','administrateur','tuteur','pedagogique','secretaire') NOT NULL,
  `id_Pedagogique` int(11) DEFAULT NULL,
  `id_Tuteur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `telephone`, `login`, `password`, `role`, `id_Pedagogique`, `id_Tuteur`) VALUES
(1, 'Essafa', 'Yassine', 'yassineessafa49@gmail.com', '0102030405', '12302332', '090709756JF', 'etudiant', 0, 0),
(2, 'Vuong', 'Denis', 'vuong.denis.p@gmail.com', '0607080910', 'denisv', 'pass123Denis', 'etudiant', 0, 0),
(3, 'Rattina', 'Bharani', 'bharanirattina@gmail.com', '1009080706', 'bharani', 'sdfghrYUGGrhs', 'etudiant', 0, 0),
(4, 'Lointier', 'Maxime', 'lointier.maxime@gmail.com', '0504030201', 'max', '$argon2id$v=19$m=262144,t=4,p=2$ZXQxc1NueWR2bUxWbVk1Sw$NDKJxQEXpoM0GFc2QQBAIwYI9Q3VXpK905c8p/lxqLw', 'etudiant', 8, 6),
(5, 'Pham', 'Huy', 'phamhuy110205@gmail.com', '0698456326', 'huypham', '455985cecfe', 'etudiant', 0, 0),
(6, 'Li', 'Olivier', 'liolivier98@gmail.com', '0700012345', 'oli98', 'YUEFUvfb8484', 'etudiant', 0, 0),
(7, 'Jeremias', 'Sherwin', 'sherwinfrance18@gmail.com', '0880088008', 'jeremias', 'gojgoirssssss', 'etudiant', 0, 0),
(8, 'Audibert', 'Laurent', 'laurent.audibert@univ-paris13.fr', '0999999999', 'laudibert', 'lplflel', 'pedagogique', 0, 0),
(9, 'Charnois', 'Thierry', 'thierry.charnois@example.com', '0123456789', 'tcharnois', 'password1', 'enseignant', 0, 0),
(10, 'Dubacq', 'Jean-Christophe', 'jean-christophe.dubacq@example.com', '0123456791', 'jdubacq', 'password2', 'enseignant', 0, 0),
(11, 'Finta', 'Lucian', 'lucian.finta@example.com', '0123456792', 'lfinta', 'password3', 'enseignant', 0, 0),
(12, 'Butelle', 'Franck', 'franck.butelle@example.com', '0123456793', 'fbutelle', 'password4', 'enseignant', 0, 0),
(13, 'Buscaldi', 'Davide', 'davide.buscaldi@example.com', '0123456794', 'dbuscaldi', 'password5', 'enseignant', 0, 0),
(14, 'Bacher', 'Axel', 'axel.bacher@example.com', '0123456795', 'abacher', 'password6', 'enseignant', 0, 0),
(15, 'Preteseille', 'Christine', 'christine.preteseille@gmail.com', '0194516774', 'cpreteseille', 'jujuujjuju', 'secretaire', 0, 0),
(16, 'Abbas', 'Fatima', 'abbas.Fatima@gmail.com', '0194528774', 'abbasfatima', 'jswldkvhjkq', 'secretaire', 0, 0),
(17, 'Martin', 'Paul', 'paul.martin@example.com', '0123456780', 'pmartin', 'tuteur123', 'tuteur', 0, 0),
(18, 'Dupont', 'Marie', 'marie.dupont@example.com', '0123456781', 'mdupont', 'tuteur456', 'tuteur', 0, 0),
(19, 'Lemoine', 'Jacques', 'jacques.lemoine@example.com', '0123456782', 'jlemoine', 'tuteur789', 'tuteur', 0, 0),
(20, 'Boulanger', 'Emma', 'emma.boulanger@example.com', '0123456783', 'eboulanger', 'tuteur101', 'tuteur', 0, 0),
(21, 'Durand', 'Esther', 'esther.durand@example.com', '0123456784', 'sdurand', 'tuteur202', 'tuteur', 0, 0),
(22, 'Musk ', 'Elon', 'Musk@gmail.com', '0102030405', 'Musklogin', '12345', 'enseignant', 0, 0),
(23, 'Gates', 'Bill', 'Bill@gmail.com', '1234567899', 'billy', 'billy1235', 'enseignant', NULL, NULL),
(24, 'Holland', 'Tom', 'Tom@gmail.com', '0601971028', 'Spiderman', '1234', 'etudiant', NULL, NULL),
(25, 'Jr', 'Robert Downey', 'rdj@gmail.com', '1234556789', 'IronMan', 'Jarvis', 'etudiant', NULL, NULL),
(26, 'Black', 'M', 'blackM@gmail.com', '12346565665', 'BlackM', 'juyiyiy', 'etudiant', NULL, NULL),
(27, 'Maitre', 'Gims', 'lunettes@gmail.com', '23456543454', 'gbbuire', 'nfenuzo', 'etudiant', NULL, NULL),
(28, 'Justin ', 'Biber', 'jb@gmail.com', '167487767', 'baby@gmail.com', 'bb987654', 'etudiant', NULL, NULL),
(29, 'scarlett ', 'johansson', 'sj@gmail.com', '12345676543', 'Black Widow', 'ehfuehoo', 'etudiant', NULL, NULL),
(30, 'Dua', 'Lipa', 'Dua@gmail.com', '12345654', 'DuaTheBest', '67BRHG7Chf', 'etudiant', NULL, NULL),
(31, 'NKAWAWO', 'Homere', 'Homere@gmail.com', '1234567', 'homere', '1234', 'administrateur', NULL, NULL),
(32, 'yo', 'yoyo', 'yo@gmail.com', '0601020304', 'yoyo', '$2y$10$M5XO6iYslGtxdvdNJZGUDub22fNQNdEDccXhEznREt2V7yFeOskcm', '', NULL, NULL),
(33, 'haribo', 'pouloulou', 'hp@gmail.com', '093783734', 'haripou', '$2y$10$91qxMOpBexjKJAVRpChPB.9Az0X/1M1jAaZsrHLmrgM8G8ZI/9jCW', 'enseignant', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`Id_Action`),
  ADD KEY `annee` (`annee`,`Id_Departement`,`numSemestre`,`Id_Etudiant`,`Id_Stage`),
  ADD KEY `Id_TypeAction` (`Id_TypeAction`),
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`Id_Administrateur`);

--
-- Indexes for table `annee`
--
ALTER TABLE `annee`
  ADD PRIMARY KEY (`annee`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`Id_Departement`),
  ADD UNIQUE KEY `Id_Enseignant` (`Id_Enseignant`),
  ADD UNIQUE KEY `Libelle` (`Libelle`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`Id_Enseignant`);

--
-- Indexes for table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`Id_Entreprise`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gere`
--
ALTER TABLE `gere`
  ADD PRIMARY KEY (`Id_Departement`,`numSemestre`,`Id_Secretaire`),
  ADD KEY `Id_Secretaire` (`Id_Secretaire`);

--
-- Indexes for table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`annee`,`Id_Departement`,`numSemestre`,`Id_Etudiant`),
  ADD KEY `Id_Departement` (`Id_Departement`,`numSemestre`),
  ADD KEY `Id_Etudiant` (`Id_Etudiant`);

--
-- Indexes for table `intervient`
--
ALTER TABLE `intervient`
  ADD PRIMARY KEY (`Id_Departement`,`Id_Enseignant`),
  ADD KEY `Id_Enseignant` (`Id_Enseignant`);

--
-- Indexes for table `pedagogique`
--
ALTER TABLE `pedagogique`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secretaire`
--
ALTER TABLE `secretaire`
  ADD PRIMARY KEY (`Id_Secretaire`);

--
-- Indexes for table `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`Id_Departement`,`numSemestre`),
  ADD UNIQUE KEY `Id_Enseignant` (`Id_Enseignant`),
  ADD KEY `annee` (`annee`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`Id_Stage`),
  ADD KEY `annee` (`annee`,`Id_Departement`,`numSemestre`,`Id_Etudiant`),
  ADD KEY `Id_Tuteur_Entreprise` (`Id_Tuteur_Entreprise`),
  ADD KEY `Id_Enseignant_1` (`Id_Enseignant_1`),
  ADD KEY `Id_Enseignant_2` (`Id_Enseignant_2`);

--
-- Indexes for table `tuteur_entreprise`
--
ALTER TABLE `tuteur_entreprise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_Entreprise` (`Id_Entreprise`);

--
-- Indexes for table `typeaction`
--
ALTER TABLE `typeaction`
  ADD PRIMARY KEY (`Id_TypeAction`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `Id_Action` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `Id_Departement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `Id_Entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pedagogique`
--
ALTER TABLE `pedagogique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stage`
--
ALTER TABLE `stage`
  MODIFY `Id_Stage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `typeaction`
--
ALTER TABLE `typeaction`
  MODIFY `Id_TypeAction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `action_ibfk_1` FOREIGN KEY (`annee`,`Id_Departement`,`numSemestre`,`Id_Etudiant`,`Id_Stage`) REFERENCES `stage` (`annee`, `Id_Departement`, `numSemestre`, `Id_Etudiant`, `Id_Stage`),
  ADD CONSTRAINT `action_ibfk_2` FOREIGN KEY (`Id_TypeAction`) REFERENCES `typeaction` (`Id_TypeAction`),
  ADD CONSTRAINT `action_ibfk_3` FOREIGN KEY (`Id`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`Id_Administrateur`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`Id_Enseignant`) REFERENCES `enseignant` (`Id_Enseignant`);

--
-- Constraints for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`Id_Enseignant`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `gere`
--
ALTER TABLE `gere`
  ADD CONSTRAINT `gere_ibfk_1` FOREIGN KEY (`Id_Secretaire`) REFERENCES `secretaire` (`Id_Secretaire`),
  ADD CONSTRAINT `gere_ibfk_2` FOREIGN KEY (`Id_Departement`,`numSemestre`) REFERENCES `semestre` (`Id_Departement`, `numSemestre`);

--
-- Constraints for table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`Id_Departement`,`numSemestre`) REFERENCES `semestre` (`Id_Departement`, `numSemestre`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`Id_Etudiant`) REFERENCES `etudiant` (`id`),
  ADD CONSTRAINT `inscription_ibfk_3` FOREIGN KEY (`annee`) REFERENCES `annee` (`annee`);

--
-- Constraints for table `intervient`
--
ALTER TABLE `intervient`
  ADD CONSTRAINT `intervient_ibfk_1` FOREIGN KEY (`Id_Enseignant`) REFERENCES `enseignant` (`Id_Enseignant`),
  ADD CONSTRAINT `intervient_ibfk_2` FOREIGN KEY (`Id_Departement`) REFERENCES `departement` (`Id_Departement`);

--
-- Constraints for table `secretaire`
--
ALTER TABLE `secretaire`
  ADD CONSTRAINT `secretaire_ibfk_1` FOREIGN KEY (`Id_Secretaire`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `semestre`
--
ALTER TABLE `semestre`
  ADD CONSTRAINT `semestre_ibfk_1` FOREIGN KEY (`Id_Departement`) REFERENCES `departement` (`Id_Departement`),
  ADD CONSTRAINT `semestre_ibfk_2` FOREIGN KEY (`Id_Enseignant`) REFERENCES `enseignant` (`Id_Enseignant`),
  ADD CONSTRAINT `semestre_ibfk_3` FOREIGN KEY (`annee`) REFERENCES `annee` (`annee`);

--
-- Constraints for table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`annee`,`Id_Departement`,`numSemestre`,`Id_Etudiant`) REFERENCES `inscription` (`annee`, `Id_Departement`, `numSemestre`, `Id_Etudiant`),
  ADD CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`Id_Tuteur_Entreprise`) REFERENCES `tuteur_entreprise` (`id`),
  ADD CONSTRAINT `stage_ibfk_3` FOREIGN KEY (`Id_Enseignant_1`) REFERENCES `enseignant` (`Id_Enseignant`),
  ADD CONSTRAINT `stage_ibfk_4` FOREIGN KEY (`Id_Enseignant_2`) REFERENCES `enseignant` (`Id_Enseignant`);

--
-- Constraints for table `tuteur_entreprise`
--
ALTER TABLE `tuteur_entreprise`
  ADD CONSTRAINT `tuteur_entreprise_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `tuteur_entreprise_ibfk_2` FOREIGN KEY (`Id_Entreprise`) REFERENCES `entreprise` (`Id_Entreprise`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
