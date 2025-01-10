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

CREATE TABLE Utilisateur(
    Id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    telephone VARCHAR(255),
    login VARCHAR(255) NOT NULL UNIQUE,
    motdepasse VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE TypeAction(
    Id_TypeAction INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255),
    Executant VARCHAR(255),
    Destinataire VARCHAR(255),
    delaiEnJours INT,
    ReferenceDelai INT,
    requiertDoc VARCHAR(255),
    LienModeleDoc VARCHAR(255)
);

CREATE TABLE Entreprise(
    Id_Entreprise INT AUTO_INCREMENT PRIMARY KEY,
    adresse VARCHAR(255),
    code_postal INT,
    ville VARCHAR(255),
    indicationVisite BOOLEAN,
    tel VARCHAR(255)
);

CREATE TABLE Etudiant(
    Id_Etudiant INT PRIMARY KEY,
    FOREIGN KEY(Id_Etudiant) REFERENCES Utilisateur(Id)
);

CREATE TABLE Secretaire(
    Id_Secretaire INT PRIMARY KEY,
    Bureau VARCHAR(255),
    FOREIGN KEY(Id_Secretaire) REFERENCES Utilisateur(Id)
);

CREATE TABLE Enseignant(
    Id_Enseignant INT PRIMARY KEY,
    Bureau VARCHAR(255),
    FOREIGN KEY(Id_Enseignant) REFERENCES Utilisateur(Id)
);

CREATE TABLE Administrateur(
    Id_Administrateur INT PRIMARY KEY,
    FOREIGN KEY(Id_Administrateur) REFERENCES Utilisateur(Id)
);

CREATE TABLE Tuteur_Entreprise(
    Id_Tuteur_Entreprise INT PRIMARY KEY,
    Id_Entreprise INT NOT NULL,
    FOREIGN KEY(Id_Tuteur_Entreprise) REFERENCES Utilisateur(Id),
    FOREIGN KEY(Id_Entreprise) REFERENCES Entreprise(Id_Entreprise)
);

CREATE TABLE annee(
    annee INT PRIMARY KEY
);

CREATE TABLE Departement(
    Id_Departement INT AUTO_INCREMENT PRIMARY KEY,
    Libelle VARCHAR(255) UNIQUE,
    Id_Enseignant INT NOT NULL UNIQUE,
    FOREIGN KEY(Id_Enseignant) REFERENCES Enseignant(Id_Enseignant)
);

CREATE TABLE Semestre(
    Id_Departement INT,
    numSemestre INT,
    Id_Enseignant INT NOT NULL UNIQUE,
    annee INT NOT NULL,
    PRIMARY KEY(Id_Departement, numSemestre),
    FOREIGN KEY(Id_Departement) REFERENCES Departement(Id_Departement),
    FOREIGN KEY(Id_Enseignant) REFERENCES Enseignant(Id_Enseignant),
    FOREIGN KEY(annee) REFERENCES annee(annee)
);

CREATE TABLE Intervient(
    Id_Enseignant INT,
    Id_Departement INT,
    specialise VARCHAR(255),
    PRIMARY KEY(Id_Departement, Id_Enseignant),
    FOREIGN KEY(Id_Enseignant) REFERENCES Enseignant(Id_Enseignant),
    FOREIGN KEY(Id_Departement) REFERENCES Departement(Id_Departement)
);

CREATE TABLE Gere(
    Id_Departement INT,
    numSemestre INT,
    Id_Secretaire INT,
    PRIMARY KEY(Id_Departement, numSemestre, Id_Secretaire),
    FOREIGN KEY(Id_Secretaire) REFERENCES Secretaire(Id_Secretaire),
    FOREIGN KEY(Id_Departement, numSemestre) REFERENCES Semestre(Id_Departement, numSemestre)
);

CREATE TABLE Inscription(
    annee INT,
    Id_Departement INT,
    numSemestre INT,
    Id_Etudiant INT,
    PRIMARY KEY(annee, Id_Departement, numSemestre, Id_Etudiant),
    FOREIGN KEY(Id_Departement, numSemestre) REFERENCES Semestre(Id_Departement, numSemestre),
    FOREIGN KEY(Id_Etudiant) REFERENCES Etudiant(Id_Etudiant),
    FOREIGN KEY(annee) REFERENCES annee(annee)
);

CREATE TABLE Stage(
    Id_Stage INT AUTO_INCREMENT PRIMARY KEY,
    annee INT,
    Id_Departement INT,
    numSemestre INT,
    Id_Etudiant INT,
    date_debut DATE,
    date_fin DATE,
    mission VARCHAR(255),
    date_soutenance DATE,
    salle_soutenance VARCHAR(255),
    Id_Enseignant_1 INT,
    Id_Tuteur_Entreprise INT NOT NULL,
    Id_Enseignant_2 INT NOT NULL,
    UNIQUE (annee, Id_Departement, numSemestre, Id_Etudiant),
    FOREIGN KEY(annee, Id_Departement, numSemestre, Id_Etudiant) REFERENCES Inscription(annee, Id_Departement, numSemestre, Id_Etudiant),
    FOREIGN KEY(Id_Tuteur_Entreprise) REFERENCES Tuteur_Entreprise(Id_Tuteur_Entreprise),
    FOREIGN KEY(Id_Enseignant_1) REFERENCES Enseignant(Id_Enseignant),
    FOREIGN KEY(Id_Enseignant_2) REFERENCES Enseignant(Id_Enseignant)
);

CREATE TABLE Action(
    Id_Action INT AUTO_INCREMENT PRIMARY KEY,
    annee INT,
    Id_Departement INT,
    numSemestre INT,
    Id_Etudiant INT,
    Id_Stage INT,
    date_realisation INT,
    lienDocument VARCHAR(255),
    Id_TypeAction INT NOT NULL,
    Id INT NOT NULL,
    UNIQUE (annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage),
    FOREIGN KEY(annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage) REFERENCES Stage(annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage),
    FOREIGN KEY(Id_TypeAction) REFERENCES TypeAction(Id_TypeAction),
    FOREIGN KEY(Id) REFERENCES Utilisateur(Id)
);
