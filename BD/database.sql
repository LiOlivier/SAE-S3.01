-- Drop tables with proper syntax for MySQL
DROP TABLE IF EXISTS Action;
DROP TABLE IF EXISTS Stage;
DROP TABLE IF EXISTS Inscription;
DROP TABLE IF EXISTS gere;
DROP TABLE IF EXISTS Intervient;
DROP TABLE IF EXISTS Semestre;
DROP TABLE IF EXISTS Departement;
DROP TABLE IF EXISTS annee;
DROP TABLE IF EXISTS Tuteur_Entreprise;
DROP TABLE IF EXISTS Administrateur;
DROP TABLE IF EXISTS Enseignant;
DROP TABLE IF EXISTS Secretaire;
DROP TABLE IF EXISTS Etudiant;
DROP TABLE IF EXISTS Entreprise;
DROP TABLE IF EXISTS TypeAction;
DROP TABLE IF EXISTS Utilisateur;

-- Create tables
CREATE TABLE Utilisateur (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    telephone VARCHAR(50),
    login VARCHAR(255) NOT NULL UNIQUE,
    motdepasse VARCHAR(255) NOT NULL,
    role ENUM('etudiant', 'enseignant', 'administrateur', 'tuteur', 'pedagogique') NOT NULL
);



CREATE TABLE Entreprise (
    Id_Entreprise INT AUTO_INCREMENT PRIMARY KEY,
    adresse VARCHAR(255),
    code_postal INT,
    ville VARCHAR(255),
    indicationVisite BOOLEAN,
    tel VARCHAR(50)
);

CREATE TABLE Etudiant (
    Id_Etudiant INT PRIMARY KEY,
    FOREIGN KEY (Id_Etudiant) REFERENCES Utilisateur(Id)
);

CREATE TABLE Secretaire (
    Id_Secretaire INT PRIMARY KEY,
    Bureau VARCHAR(255),
    FOREIGN KEY (Id_Secretaire) REFERENCES Utilisateur(Id)
);

CREATE TABLE Enseignant (
    Id_Enseignant INT PRIMARY KEY,
    Bureau VARCHAR(255),
    FOREIGN KEY (Id_Enseignant) REFERENCES Utilisateur(Id)
);

CREATE TABLE Administrateur (
    Id_Administrateur INT PRIMARY KEY,
    FOREIGN KEY (Id_Administrateur) REFERENCES Utilisateur(Id)
);

CREATE TABLE Tuteur_Entreprise (
    Id_Tuteur_Entreprise INT PRIMARY KEY,
    Id_Entreprise INT NOT NULL,
    FOREIGN KEY (Id_Tuteur_Entreprise) REFERENCES Utilisateur(Id),
    FOREIGN KEY (Id_Entreprise) REFERENCES Entreprise(Id_Entreprise)
);

CREATE TABLE annee (
    annee INT PRIMARY KEY
);

CREATE TABLE Departement (
    Id_Departement INT AUTO_INCREMENT PRIMARY KEY,
    Libelle VARCHAR(255) UNIQUE,
    Id_Enseignant INT NOT NULL UNIQUE,
    FOREIGN KEY (Id_Enseignant) REFERENCES Enseignant(Id_Enseignant)
);

CREATE TABLE TypeAction (
    Id_TypeAction INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255),
    Executant VARCHAR(255),
    Destinataire VARCHAR(255),
    delaiEnJours INT,
    ReferenceDelai INT,
    requiertDoc VARCHAR(255),
    LienModeleDoc VARCHAR(255)
);

CREATE TABLE Semestre (
    Id_Departement INT,
    numSemestre INT,
    Id_Enseignant INT NOT NULL UNIQUE,
    annee INT NOT NULL,
    PRIMARY KEY (Id_Departement, numSemestre),
    FOREIGN KEY (Id_Departement) REFERENCES Departement(Id_Departement),
    FOREIGN KEY (Id_Enseignant) REFERENCES Enseignant(Id_Enseignant),
    FOREIGN KEY (annee) REFERENCES annee(annee)
);

CREATE TABLE Intervient (
    Id_Enseignant INT,
    Id_Departement INT,
    specialise VARCHAR(255),
    PRIMARY KEY (Id_Departement, Id_Enseignant),
    FOREIGN KEY (Id_Enseignant) REFERENCES Enseignant(Id_Enseignant),
    FOREIGN KEY (Id_Departement) REFERENCES Departement(Id_Departement)
);

CREATE TABLE gere (
    Id_Departement INT,
    numSemestre INT,
    Id_Secretaire INT,
    PRIMARY KEY (Id_Departement, numSemestre, Id_Secretaire),
    FOREIGN KEY (Id_Secretaire) REFERENCES Secretaire(Id_Secretaire),
    FOREIGN KEY (Id_Departement, numSemestre) REFERENCES Semestre(Id_Departement, numSemestre)
);

CREATE TABLE Inscription (
    annee INT,
    Id_Departement INT,
    numSemestre INT,
    Id_Etudiant INT,
    PRIMARY KEY (annee, Id_Departement, numSemestre, Id_Etudiant),
    FOREIGN KEY (Id_Departement, numSemestre) REFERENCES Semestre(Id_Departement, numSemestre),
    FOREIGN KEY (Id_Etudiant) REFERENCES Etudiant(Id_Etudiant),
    FOREIGN KEY (annee) REFERENCES annee(annee)
);

CREATE TABLE Stage (
    annee INT,
    Id_Departement INT,
    numSemestre INT,
    Id_Etudiant INT,
    Id_Stage INT AUTO_INCREMENT,
    date_debut DATE,
    date_fin DATE,
    mission VARCHAR(255),
    date_soutenance VARCHAR(255),
    salle_soutenance VARCHAR(255),
    Id_Enseignant_1 INT,
    Id_Tuteur_Entreprise INT NOT NULL,
    Id_Enseignant_2 INT NOT NULL,
    PRIMARY KEY (Id_Stage),  -- Use Id_Stage as the primary key
    FOREIGN KEY (annee, Id_Departement, numSemestre, Id_Etudiant) REFERENCES Inscription(annee, Id_Departement, numSemestre, Id_Etudiant),
    FOREIGN KEY (Id_Tuteur_Entreprise) REFERENCES Tuteur_Entreprise(Id_Tuteur_Entreprise),
    FOREIGN KEY (Id_Enseignant_1) REFERENCES Enseignant(Id_Enseignant),
    FOREIGN KEY (Id_Enseignant_2) REFERENCES Enseignant(Id_Enseignant)
);

CREATE TABLE Action (
    Id_Action INT AUTO_INCREMENT,  
    annee INT,
    Id_Departement INT,
    numSemestre INT,
    Id_Etudiant INT,
    Id_Stage INT,
    date_realisation DATE,
    lienDocument VARCHAR(255),
    Id_TypeAction INT NOT NULL,
    Id INT NOT NULL,
    PRIMARY KEY (Id_Action), 
    FOREIGN KEY (annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage) REFERENCES Stage(annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage),
    FOREIGN KEY (Id_TypeAction) REFERENCES TypeAction(Id_TypeAction),
    FOREIGN KEY (Id) REFERENCES Utilisateur(Id)
);


INSERT INTO Utilisateur (nom, prenom, email, telephone, login, motdepasse, role) VALUES
-- Etudiant
('Essafa', 'Yassine', 'yassineessafa49@gmail.com', '0102030405', '12302332', '090709756JF', 'etudiant'),
('Vuong', 'Denis', 'vuong.denis.p@gmail.com', '0607080910', 'denisv', 'pass123Denis', 'etudiant'),
('Rattina', 'Bharani', 'bharanirattina@gmail.com', '1009080706', 'bharani', 'sdfghrYUGGrhs', 'etudiant'),
('Lointier', 'Maxime', 'lointier.maxime@gmail.com', '0504030201', 'maxlointier', 'strongPass4Max', 'etudiant'),
('Pham', 'Huy', 'phamhuy110205@gmail.com', '0698456326', 'huypham', '455985cecfe', 'etudiant'),
('Li', 'Olivier', 'liolivier98@gmail.com', '0700012345', 'oli98', 'YUEFUvfb8484', 'etudiant'),
('Jeremias', 'Sherwin', 'sherwinfrance18@gmail.com', '0880088008', 'jeremias', 'gojgoirssssss', 'etudiant'),
-- Enseignant
('Audibert', 'Laurent', 'laurent.audibert@univ-paris13.fr', '0999999999', 'laudibert', 'lplflel', 'enseignant'),
('Charnois', 'Thierry', 'thierry.charnois@example.com', '0123456789', 'tcharnois', 'password1', 'enseignant'),
('Dubacq', 'Jean-Christophe', 'jean-christophe.dubacq@example.com', '0123456791', 'jdubacq', 'password2', 'enseignant'),
('Finta', 'Lucian', 'lucian.finta@example.com', '0123456792', 'lfinta', 'password3', 'enseignant'),
('Butelle', 'Franck', 'franck.butelle@example.com', '0123456793', 'fbutelle', 'password4', 'enseignant'),
('Buscaldi', 'Davide', 'davide.buscaldi@example.com', '0123456794', 'dbuscaldi', 'password5', 'enseignant'),
('Bacher', 'Axel', 'axel.bacher@example.com', '0123456795', 'abacher', 'password6', 'enseignant'),
-- Administrateur (Secretaire)
('Preteseille', 'Christine', 'christine.preteseille@gmail.com', '0194516774', 'cpreteseille', 'jujuujjuju', 'administrateur'),
('Abbas', 'Fatima', 'abbas.Fatima@gmail.com', '0194528774', 'abbasfatima', 'jswldkvhjkq', 'administrateur'),
-- Tuteur
('Martin', 'Paul', 'paul.martin@example.com', '0123456780', 'pmartin', 'tuteur123', 'tuteur'),
('Dupont', 'Marie', 'marie.dupont@example.com', '0123456781', 'mdupont', 'tuteur456', 'tuteur'),
('Lemoine', 'Jacques', 'jacques.lemoine@example.com', '0123456782', 'jlemoine', 'tuteur789', 'tuteur'),
('Boulanger', 'Emma', 'emma.boulanger@example.com', '0123456783', 'eboulanger', 'tuteur101', 'tuteur'),
('Durand', 'Esther', 'esther.durand@example.com', '0123456784', 'sdurand', 'tuteur202', 'tuteur');

INSERT INTO Entreprise (adresse, code_postal, ville, indicationVisite, tel) VALUES
('16 rue Jean Courtois', 72400, 'La Ferté-Bernard', 1, '0500813500'),
('8 rue Jean Morgon', 1000, 'Bourg-en-Bresse', 1, '0184986414'),
('32 rue Paul Eluard', 27140, 'Gisors', 0, '9900115577'),
('7 rue de la Roche', 79360, 'Les Fosses', 1, '0123456789'),
('21 rue Pascal', 18000, 'Bourges', 0, '9876543210'),
('39 rue Baron Louis', 54200, 'Toul', 1, '0000000000'),
('26 rue Saint-Julien', 33112, 'Saint-Laurent-Médoc', 0, '6666666666');

INSERT INTO Etudiant (Id_Etudiant) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

INSERT INTO Secretaire (Id_Secretaire, Bureau) VALUES
(15, 'L100'),
(16, 'L101');

INSERT INTO Enseignant (Id_Enseignant, Bureau) VALUES
(8, 'L105'),
(9, 'L106'),
(10, 'L107'),
(11, 'L108'),
(12, 'L109'),
(13, 'L110');

INSERT INTO Administrateur (Id_Administrateur) VALUES
(15),
(16);

INSERT INTO Tuteur_Entreprise (Id_Tuteur_Entreprise, Id_Entreprise) VALUES
(17, 1),
(18, 2),
(19, 3),
(20, 4),
(21, 5);

INSERT INTO annee (annee) VALUES
(2023),
(2024),
(2025),
(2026);

INSERT INTO Departement (Libelle, Id_Enseignant) VALUES
('INFO', 8);

INSERT INTO TypeAction (libelle, Executant, Destinataire, delaiEnJours, ReferenceDelai, requiertDoc, LienModeleDoc) VALUES
('Rapport d’installation', 'Etudiant', 'Tuteur Pédagogique', 7, 1, 'Oui', 'lien_modele_rapport_installation.pdf'),
('Contact Entreprise', 'Tuteur Pédagogique', 'Entreprise', 14, 1, 'Non', NULL),
('Entretien Mi-Stage', 'Tuteur Pédagogique', 'Entreprise', 30, 1, 'Non', NULL),
('Planification Soutenance', 'Tuteur Pédagogique', 'Etudiant', 90, 2, 'Oui', 'lien_modele_planification.pdf'),
('Dépôt Rapport de Stage', 'Etudiant', 'Tuteur Pédagogique', 100, 2, 'Oui', 'lien_modele_rapport_stage.pdf');

INSERT INTO Semestre (Id_Departement, numSemestre, Id_Enseignant, annee) VALUES
(1, 4, 8, 2024),
(1, 6, 9, 2024);

INSERT INTO Intervient (Id_Enseignant, Id_Departement, specialise) VALUES
(8, 1, 'BD');

INSERT INTO gere (Id_Departement, numSemestre, Id_Secretaire) VALUES
(1, 4, 15);

INSERT INTO Inscription (annee, Id_Departement, numSemestre, Id_Etudiant) VALUES
(2024, 1, 4, 1),
(2024, 1, 4, 2),
(2024, 1, 4, 3),
(2024, 1, 4, 4),
(2024, 1, 4, 5),
(2024, 1, 4, 6),
(2024, 1, 4, 7);


INSERT INTO Stage (annee, Id_Departement, numSemestre, Id_Etudiant, date_debut, date_fin, mission, date_soutenance, salle_soutenance, Id_Enseignant_1, Id_Tuteur_Entreprise, Id_Enseignant_2) VALUES
(2024, 1, 4, 1, '2024-04-01', '2024-06-30', 'Développement d’une application web', '2024-07-15', 'Salle A1', 8, 17, 9),
(2024, 1, 4, 2, '2024-05-01', '2024-07-31', 'Analyse des données clients', '2024-08-20', 'Salle B2', 8, 18, 9);

INSERT INTO Action (annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage, date_realisation, lienDocument, Id_TypeAction, Id) VALUES
(2024, 1, 4, 1, 1, '2024-04-05', 'lien_rapport_1.pdf', 1, 1),
(2024, 1, 4, 2, 2, '2024-05-15', NULL, 2, 2);
