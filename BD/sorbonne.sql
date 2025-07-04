-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2025 at 05:20 PM
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
-- Database: `sorbonne`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `id_action` int(11) NOT NULL,
  `annee` int(11) DEFAULT NULL,
  `id_departement` int(11) DEFAULT NULL,
  `num_semestre` int(11) DEFAULT NULL,
  `id_etudiant` int(11) DEFAULT NULL,
  `id_stage` int(11) DEFAULT NULL,
  `date_realisation` date DEFAULT NULL,
  `lien_document` varchar(255) DEFAULT NULL,
  `id_type_action` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `etat` enum('A faire','En attente','Valider','Refuser') NOT NULL DEFAULT 'A faire',
  `id_pedagogique` int(11) DEFAULT NULL,
  `id_tuteur_entreprise` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_administrateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`id_administrateur`) VALUES
(31),
(59),
(61);

-- --------------------------------------------------------

--
-- Table structure for table `annee`
--

CREATE TABLE `annee` (
  `annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id_departement` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `id_enseignant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`id_departement`, `libelle`, `id_enseignant`) VALUES
(1, 'INFO', 62),
(2, 'GEA', 9),
(3, 'RT', 10),
(4, 'SD', 11);

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_enseignant` int(11) NOT NULL,
  `bureau` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `bureau`) VALUES
(8, 'L105'),
(9, 'L106'),
(10, 'L107'),
(11, 'L108'),
(12, 'L109'),
(13, 'L110'),
(22, 'T105'),
(23, 'G107'),
(57, 'I098'),
(62, 'T206');

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `indication_visite` tinyint(1) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `adresse`, `code_postal`, `ville`, `indication_visite`, `tel`) VALUES
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
  `id_etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`) VALUES
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
(30),
(57);

-- --------------------------------------------------------

--
-- Table structure for table `gere`
--

CREATE TABLE `gere` (
  `id_departement` int(11) NOT NULL,
  `num_semestre` int(11) NOT NULL,
  `id_secretaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gere`
--

INSERT INTO `gere` (`id_departement`, `num_semestre`, `id_secretaire`) VALUES
(1, 4, 15),
(2, 4, 15);

-- --------------------------------------------------------

--
-- Table structure for table `inscription`
--

CREATE TABLE `inscription` (
  `annee` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `num_semestre` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inscription`
--

INSERT INTO `inscription` (`annee`, `id_departement`, `num_semestre`, `id_etudiant`) VALUES
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
  `id_enseignant` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `specialise` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intervient`
--

INSERT INTO `intervient` (`id_enseignant`, `id_departement`, `specialise`) VALUES
(8, 1, 'BD');

-- --------------------------------------------------------

--
-- Table structure for table `secretaire`
--

CREATE TABLE `secretaire` (
  `id_secretaire` int(11) NOT NULL,
  `bureau` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secretaire`
--

INSERT INTO `secretaire` (`id_secretaire`, `bureau`) VALUES
(15, 'L100'),
(16, 'L101'),
(55, NULL),
(56, NULL),
(60, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semestre`
--

CREATE TABLE `semestre` (
  `id_departement` int(11) NOT NULL,
  `num_semestre` int(11) NOT NULL,
  `id_enseignant` int(11) NOT NULL,
  `annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semestre`
--

INSERT INTO `semestre` (`id_departement`, `num_semestre`, `id_enseignant`, `annee`) VALUES
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
  `id_departement` int(11) DEFAULT NULL,
  `num_semestre` int(11) DEFAULT NULL,
  `id_etudiant` int(11) DEFAULT NULL,
  `id_stage` int(11) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `mission` varchar(255) DEFAULT NULL,
  `date_soutenance` date DEFAULT NULL,
  `salle_soutenance` varchar(255) DEFAULT NULL,
  `id_enseignant_1` int(11) DEFAULT NULL,
  `id_tuteur_entreprise` int(11) DEFAULT NULL,
  `id_enseignant_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`annee`, `id_departement`, `num_semestre`, `id_etudiant`, `id_stage`, `date_debut`, `date_fin`, `mission`, `date_soutenance`, `salle_soutenance`, `id_enseignant_1`, `id_tuteur_entreprise`, `id_enseignant_2`) VALUES
(2024, 1, 4, 1, 1, '2024-04-01', '2024-06-30', 'Développement d’une application web', '2025-02-01', 'room 404', 11, 17, 23),
(2024, 1, 4, 2, 2, '2024-05-01', '2024-07-31', 'Analyse des données clients', '2024-08-20', 'Salle B2', 8, 18, 9),
(2025, 1, 6, 25, 5, '2025-01-25', '2025-01-30', 'ironman sem6 info test1', '2025-03-05', 'botlobby', NULL, NULL, 13),
(2024, 1, 4, 7, 6, '2025-01-20', '2025-01-30', 'sherwin sem4 info test1', NULL, NULL, NULL, NULL, NULL),
(2024, 1, 4, 4, 9, '2025-02-06', '2025-06-19', 'Stage logic', '2025-01-22', 'F333', 11, 20, 22),
(2024, 1, 4, 5, 10, '2025-02-10', '2025-04-04', 'dev web', '2025-01-24', 'F5', 57, 20, 11),
(2024, 1, 4, 3, 11, '2025-01-20', '2025-01-29', 'bbbbbbb', '2025-01-26', 'q109', 8, 62, 22);

-- --------------------------------------------------------

--
-- Table structure for table `tuteur_entreprise`
--

CREATE TABLE `tuteur_entreprise` (
  `id_tuteur_entreprise` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuteur_entreprise`
--

INSERT INTO `tuteur_entreprise` (`id_tuteur_entreprise`, `id_entreprise`) VALUES
(17, 1),
(18, 2),
(38, 2),
(19, 3),
(44, 3),
(20, 4),
(53, 4),
(21, 5),
(62, 5),
(34, 6),
(54, 6);

-- --------------------------------------------------------

--
-- Table structure for table `typeaction`
--

CREATE TABLE `typeaction` (
  `id_type_action` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `executant` varchar(255) NOT NULL,
  `destinataire` varchar(255) NOT NULL,
  `delai_en_jours` int(11) DEFAULT NULL,
  `delai_limite` date DEFAULT NULL,
  `reference_delai` int(11) DEFAULT NULL,
  `requiert_doc` enum('oui','non') NOT NULL DEFAULT 'non',
  `lien_modele_doc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `typeaction`
--

INSERT INTO `typeaction` (`id_type_action`, `libelle`, `executant`, `destinataire`, `delai_en_jours`, `delai_limite`, `reference_delai`, `requiert_doc`, `lien_modele_doc`) VALUES
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
  `role` enum('etudiant','enseignant','administrateur','tuteur','pedagogique','secretaire','chefdept') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `telephone`, `login`, `password`, `role`) VALUES
(1, 'Essafa', 'Yassine', 'yassineessafa49@gmail.com', '0102030405', '12302332', '090709756JF', 'etudiant'),
(2, 'Vuong', 'Denis', 'vuong.denis.p@gmail.com', '0607080910', 'denisv', 'pass123Denis', 'etudiant'),
(3, 'Rattina', 'Bharani', 'bharanirattina@gmail.com', '1009080706', 'bharani', 'sdfghrYUGGrhs', 'etudiant'),
(4, 'Lointier', 'Maxime', 'lointier.maxime@gmail.com', '0504030201', 'max', '$argon2id$v=19$m=262144,t=4,p=2$ZXQxc1NueWR2bUxWbVk1Sw$NDKJxQEXpoM0GFc2QQBAIwYI9Q3VXpK905c8p/lxqLw', 'etudiant'),
(5, 'Pham', 'Huy', 'phamhuy110205@gmail.com', '0698456326', 'huypham', '455985cecfe', 'etudiant'),
(6, 'Li', 'Olivier', 'liolivier98@gmail.com', '0700012345', 'oli98', 'YUEFUvfb8484', 'etudiant'),
(7, 'Jeremias', 'Sherwin', 'sherwinfrance18@gmail.com', '0880088008', 'jeremias', 'gojgoirssssss', 'etudiant'),
(8, 'Audibert', 'Laurent', 'laurent.audibert@univ-paris13.fr', '0999999999', 'laudibert', 'lplflel', 'pedagogique'),
(9, 'Charnois', 'Thierry', 'thierry.charnois@example.com', '0123456789', 'tcharnois', 'password1', 'pedagogique'),
(10, 'Dubacq', 'Jean-Christophe', 'jean-christophe.dubacq@example.com', '0123456791', 'jdubacq', 'password2', 'pedagogique'),
(11, 'Finta', 'Lucian', 'lucian.finta@example.com', '0123456792', 'lfinta', 'password3', 'pedagogique'),
(12, 'Butelle', 'Franck', 'franck.butelle@example.com', '0123456793', 'fbutelle', 'password4', 'pedagogique'),
(13, 'Buscaldi', 'Davide', 'davide.buscaldi@example.com', '0123456794', 'dbuscaldi', 'password5', 'pedagogique'),
(14, 'Bacher', 'Axel', 'axel.bacher@example.com', '0123456795', 'abacher', 'password6', 'enseignant'),
(15, 'Preteseille', 'Christine', 'christine.preteseille@gmail.com', '0194516774', 'cpreteseille', 'jujuujjuju', 'secretaire'),
(16, 'Abbas', 'Fatima', 'abbas.Fatima@gmail.com', '0194528774', 'abbasfatima', 'jswldkvhjkq', 'secretaire'),
(17, 'Martin', 'Paul', 'paul.martin@example.com', '0123456780', 'pmartin', 'tuteur123', 'tuteur'),
(18, 'Dupont', 'Marie', 'marie.dupont@example.com', '0123456781', 'mdupont', 'tuteur456', 'tuteur'),
(19, 'Lemoine', 'Jacques', 'jacques.lemoine@example.com', '0123456782', 'jlemoine', 'tuteur789', 'tuteur'),
(20, 'Boulanger', 'Emma', 'emma.boulanger@example.com', '0123456783', 'eboulanger', 'tuteur101', 'tuteur'),
(21, 'Durand', 'Esther', 'esther.durand@example.com', '0123456784', 'sdurand', 'tuteur202', 'tuteur'),
(22, 'Musk ', 'Elon', 'Musk@gmail.com', '0102030405', 'Musklogin', '12345', 'enseignant'),
(23, 'Gates', 'Bill', 'Bill@gmail.com', '1234567899', 'billy', 'billy1235', 'pedagogique'),
(24, 'Holland', 'Tom', 'Tom@gmail.com', '0601971028', 'Spiderman', '1234', 'etudiant'),
(25, 'Jr', 'Robert Downey', 'rdj@gmail.com', '1234556789', 'IronMan', 'Jarvis', 'etudiant'),
(26, 'Black', 'M', 'blackM@gmail.com', '12346565665', 'BlackM', 'juyiyiy', 'etudiant'),
(27, 'Maitre', 'Gims', 'lunettes@gmail.com', '23456543454', 'gbbuire', 'nfenuzo', 'etudiant'),
(28, 'Justin ', 'Biber', 'jb@gmail.com', '167487767', 'baby@gmail.com', 'bb987654', 'etudiant'),
(29, 'scarlett ', 'johansson', 'sj@gmail.com', '12345676543', 'Black Widow', 'ehfuehoo', 'etudiant'),
(30, 'Dua', 'Lipa', 'Dua@gmail.com', '12345654', 'DuaTheBest', '67BRHG7Chf', 'etudiant'),
(31, 'NKAWAWO', 'Homere', 'Homere@gmail.com', '1234567', 'homere', '1234', 'administrateur'),
(32, 'yo', 'yoyo', 'yo@gmail.com', '0601020304', 'yoyo', '$2y$10$M5XO6iYslGtxdvdNJZGUDub22fNQNdEDccXhEznREt2V7yFeOskcm', ''),
(33, 'haribo', 'pouloulou', 'hp@gmail.com', '093783734', 'haripou', '$2y$10$91qxMOpBexjKJAVRpChPB.9Az0X/1M1jAaZsrHLmrgM8G8ZI/9jCW', 'enseignant'),
(34, 'Jill', 'Book', 'jill@gmail.com', '14795632', 'jill', '$2y$10$i5VOFZ3FzTjrTZgsr66i1ecWDx1IrbjrqCoFytAd0JOQv7hdCDb3m', 'tuteur'),
(38, 'aa', 'aaaa', 'aaaa@gmail.com', '789654132748', 'mra', '$2y$10$onWk4ImNtDg91umQ6pKKC.d4Ol/FqJqx/fyx/cVN6d09.ft3JeLaK', 'tuteur'),
(44, 'Jung', 'look', 'jung@gmail.com', '2134567985', 'jung', '$2y$10$PFooDGjLLobQDKVKr.qXheDHVTHlvCWgK2xftIjw2BLCyUX5xKc8i', 'tuteur'),
(53, 'Peka', 'Fly', 'peka@gmail.com', '9879987856', 'peka', '$2y$10$jVbNmbnVzPo6eTanrAmSC.URmLMOvhZalvQhMFd7FFTD21R8/BB3C', 'tuteur'),
(54, 'sedfg', 'jhyg', 'fgrd@gmail.com', '55665745646', 'gggg', '$2y$10$Wg64j5lUdcquzmxtneiSK.O2glFR.T22RgcuRK2R2t.8QcbwIbbdO', 'tuteur'),
(55, 'po', 'po', 'po@gmail.com', '12345678765', 'po', '$2y$10$N/AoZrh3hjOw5bxeos.UDedtyU4xMFg4.BpW.tOBS4TghPnYsnhfK', 'secretaire'),
(56, 'huifiuzu', 'uiegiu', 'jheufhfuei@gmail.com', '34567809', 'lio', '$2y$10$D2zyjkUExtxQlj3qoJCuQ.LEIgxgMFVhL2SwWk7IIBZMWNbaAUbWG', 'pedagogique'),
(57, 'ygregfiyer', 'grbigrig', 'huifhg@gmail.com', '2324567398598', 'titi', '$2y$10$iYhjy4SNsR.uwglJNvdfvuJCI/1nHljCHM8FWRuPW92AQhinepNqy', 'pedagogique'),
(59, 'hvghbknjnj', ' vbn,b,vn', 'cfhghbkjlhjg@gmail.com', '23456543', 'juju', '$2y$10$aXSzkmvVqZckzbl7sqyrSu1VpD213j/Jnlyd2Ch8I//qEIZ9ucyCW', 'administrateur'),
(60, 'rick', 'mory', 'mory@gmail.com', '4567876545', 'rick', '$2y$10$tnQfnMDDDYna8jFWlEQqWuVDXs3JseZOCMAc6kn0lZ26F0igdgFoy', 'secretaire'),
(61, 'rr', 'rr', 'rr@gmail.com', '2345678765', 'tata', '$2y$10$gFcEVZ3Bpj1DuHifSDbJoefIB3zEKhklJVdU4MFCgM/ftKcLXVYwm', 'tuteur'),
(62, 'dd', 'ddd', 'asd@gmail.com', '312312312', 'nunu', '$2y$10$Snu9FJrixWmk9/tvSKxt8.TjMMRAwmJYd8GGH5qS5vmDJxpAz8f2e', 'chefdept');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id_action`),
  ADD KEY `annee` (`annee`,`id_departement`,`num_semestre`,`id_etudiant`,`id_stage`),
  ADD KEY `id_type_action` (`id_type_action`),
  ADD KEY `id_pedagogique` (`id_pedagogique`),
  ADD KEY `id_tuteur_entreprise` (`id_tuteur_entreprise`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_administrateur`);

--
-- Indexes for table `annee`
--
ALTER TABLE `annee`
  ADD PRIMARY KEY (`annee`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`),
  ADD UNIQUE KEY `id_enseignant` (`id_enseignant`),
  ADD UNIQUE KEY `libelle` (`libelle`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_enseignant`);

--
-- Indexes for table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`);

--
-- Indexes for table `gere`
--
ALTER TABLE `gere`
  ADD PRIMARY KEY (`id_departement`,`num_semestre`,`id_secretaire`),
  ADD KEY `id_secretaire` (`id_secretaire`);

--
-- Indexes for table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`annee`,`id_departement`,`num_semestre`,`id_etudiant`),
  ADD KEY `id_departement` (`id_departement`,`num_semestre`),
  ADD KEY `id_etudiant` (`id_etudiant`);

--
-- Indexes for table `intervient`
--
ALTER TABLE `intervient`
  ADD PRIMARY KEY (`id_departement`,`id_enseignant`),
  ADD KEY `id_enseignant` (`id_enseignant`);

--
-- Indexes for table `secretaire`
--
ALTER TABLE `secretaire`
  ADD PRIMARY KEY (`id_secretaire`);

--
-- Indexes for table `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`id_departement`,`num_semestre`),
  ADD UNIQUE KEY `id_enseignant` (`id_enseignant`),
  ADD KEY `annee` (`annee`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id_stage`),
  ADD KEY `annee` (`annee`,`id_departement`,`num_semestre`,`id_etudiant`),
  ADD KEY `id_tuteur_entreprise` (`id_tuteur_entreprise`),
  ADD KEY `id_enseignant_1` (`id_enseignant_1`),
  ADD KEY `id_enseignant_2` (`id_enseignant_2`);

--
-- Indexes for table `tuteur_entreprise`
--
ALTER TABLE `tuteur_entreprise`
  ADD PRIMARY KEY (`id_tuteur_entreprise`),
  ADD KEY `id_entreprise` (`id_entreprise`);

--
-- Indexes for table `typeaction`
--
ALTER TABLE `typeaction`
  ADD PRIMARY KEY (`id_type_action`);

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
  MODIFY `id_action` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `id_departement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stage`
--
ALTER TABLE `stage`
  MODIFY `id_stage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `typeaction`
--
ALTER TABLE `typeaction`
  MODIFY `id_type_action` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `action_ibfk_1` FOREIGN KEY (`annee`,`id_departement`,`num_semestre`,`id_etudiant`,`id_stage`) REFERENCES `stage` (`annee`, `id_departement`, `num_semestre`, `id_etudiant`, `id_stage`),
  ADD CONSTRAINT `action_ibfk_2` FOREIGN KEY (`id_type_action`) REFERENCES `typeaction` (`id_type_action`),
  ADD CONSTRAINT `action_ibfk_3` FOREIGN KEY (`id_pedagogique`) REFERENCES `enseignant` (`id_enseignant`),
  ADD CONSTRAINT `action_ibfk_4` FOREIGN KEY (`id_tuteur_entreprise`) REFERENCES `tuteur_entreprise` (`id_tuteur_entreprise`),
  ADD CONSTRAINT `action_ibfk_5` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`id_administrateur`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`);

--
-- Constraints for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `gere`
--
ALTER TABLE `gere`
  ADD CONSTRAINT `gere_ibfk_1` FOREIGN KEY (`id_departement`,`num_semestre`) REFERENCES `semestre` (`id_departement`, `num_semestre`),
  ADD CONSTRAINT `gere_ibfk_2` FOREIGN KEY (`id_secretaire`) REFERENCES `secretaire` (`id_secretaire`);

--
-- Constraints for table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`id_departement`,`num_semestre`) REFERENCES `semestre` (`id_departement`, `num_semestre`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `inscription_ibfk_3` FOREIGN KEY (`annee`) REFERENCES `annee` (`annee`);

--
-- Constraints for table `intervient`
--
ALTER TABLE `intervient`
  ADD CONSTRAINT `intervient_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`),
  ADD CONSTRAINT `intervient_ibfk_2` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`);

--
-- Constraints for table `secretaire`
--
ALTER TABLE `secretaire`
  ADD CONSTRAINT `secretaire_ibfk_1` FOREIGN KEY (`id_secretaire`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `semestre`
--
ALTER TABLE `semestre`
  ADD CONSTRAINT `semestre_ibfk_1` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`),
  ADD CONSTRAINT `semestre_ibfk_2` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`),
  ADD CONSTRAINT `semestre_ibfk_3` FOREIGN KEY (`annee`) REFERENCES `annee` (`annee`);

--
-- Constraints for table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`annee`,`id_departement`,`num_semestre`,`id_etudiant`) REFERENCES `inscription` (`annee`, `id_departement`, `num_semestre`, `id_etudiant`),
  ADD CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`id_tuteur_entreprise`) REFERENCES `tuteur_entreprise` (`id_tuteur_entreprise`),
  ADD CONSTRAINT `stage_ibfk_3` FOREIGN KEY (`id_enseignant_1`) REFERENCES `enseignant` (`id_enseignant`),
  ADD CONSTRAINT `stage_ibfk_4` FOREIGN KEY (`id_enseignant_2`) REFERENCES `enseignant` (`id_enseignant`);

--
-- Constraints for table `tuteur_entreprise`
--
ALTER TABLE `tuteur_entreprise`
  ADD CONSTRAINT `tuteur_entreprise_ibfk_1` FOREIGN KEY (`id_tuteur_entreprise`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `tuteur_entreprise_ibfk_2` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- INSERTION POUR TUTEUR ENTREPRISE 

-- Ajout d'une entreprise
INSERT INTO entreprise (id_entreprise, adresse, code_postal, ville, indication_visite, tel)
VALUES (8, '123 rue de la Tech', 75000, 'Paris', 1, '0102030405');

-- Ajout du tuteur entreprise
INSERT INTO utilisateur (id, nom, prenom, email, telephone, login, password, role)
VALUES (66, 'Leroy', 'Julien', 'julien.leroy@entreprise.com', '0611223344', 'jleroy',
        '$2y$10$aXSzkmvVqZckzbl7sqyrSu1VpD213j/Jnlyd2Ch8I//qEIZ9ucyCW', 'tuteur');

INSERT INTO tuteur_entreprise (id_tuteur_entreprise, id_entreprise)
VALUES (66, 8);

-- Ajout du tuteur pédagogique
INSERT INTO utilisateur (id, nom, prenom, email, telephone, login, password, role)
VALUES (67, 'Roux', 'Camille', 'camille.roux@univ.fr', '0611223345', 'croux',
        '$2y$10$aXSzkmvVqZckzbl7sqyrSu1VpD213j/Jnlyd2Ch8I//qEIZ9ucyCW', 'pedagogique');

-- Ajout du tuteur pédagogique dans la table enseignant
INSERT INTO enseignant (id_enseignant, bureau)
VALUES (67, 'L107');

-- Ajout des deux étudiants
INSERT INTO utilisateur (id, nom, prenom, email, telephone, login, password, role)
VALUES 
(68, 'Tremblay', 'Alice', 'alice.tremblay@etu.univ.fr', '0699999991', 'alice',
     '$2y$10$aXSzkmvVqZckzbl7sqyrSu1VpD213j/Jnlyd2Ch8I//qEIZ9ucyCW', 'etudiant'),
(69, 'Nguyen', 'Léo', 'leo.nguyen@etu.univ.fr', '0699999992', 'leo',
     '$2y$10$aXSzkmvVqZckzbl7sqyrSu1VpD213j/Jnlyd2Ch8I//qEIZ9ucyCW', 'etudiant');

-- Insertion dans la table etudiant
INSERT INTO etudiant (id_etudiant)
VALUES (68), (69);

-- Inscription des étudiants (2025, Département 1 = INFO, Semestre 6)
INSERT INTO inscription (annee, id_departement, num_semestre, id_etudiant)
VALUES 
(2025, 1, 6, 68),
(2025, 1, 6, 69);

-- Ajout des stages fictifs liés au tuteur entreprise et au tuteur pédagogique
INSERT INTO stage (
  annee, id_departement, num_semestre, id_etudiant, id_stage,
  date_debut, date_fin, mission, id_tuteur_entreprise, id_enseignant_1
)
VALUES 
(2025, 1, 6, 68, 13, '2025-03-01', '2025-06-30', 'Développement mobile', 66, 67),
(2025, 1, 6, 69, 14, '2025-03-01', '2025-06-30', 'Analyse de données', 66, 67);

-- Mise à jour des dates limites pour les types d'action
UPDATE typeaction SET delai_limite = '2024-12-12' WHERE id_type_action = 7;
UPDATE typeaction SET delai_limite = '2025-02-02' WHERE id_type_action = 9;

