CREATE TABLE Utilisateur (
    Id SERIAL PRIMARY KEY,
    nom VARCHAR,
    prenom VARCHAR,
    email VARCHAR,
    telephone VARCHAR,
    login VARCHAR,
    motdepasse VARCHAR
);

CREATE TABLE TypeAction (
    Id_TypeAction SERIAL PRIMARY KEY,
    libelle VARCHAR,
    Executant VARCHAR,
    Destinataire VARCHAR,
    delaiEnJours INTEGER,
    ReferenceDelai VARCHAR,
    requiertDoc BOOLEAN,
    LienModeleDoc VARCHAR
);

CREATE TABLE Entreprise (
    Id_Entreprise SERIAL PRIMARY KEY,
    adresse VARCHAR,
    code_postal VARCHAR,
    Ville VARCHAR,
    indicationVisite VARCHAR,
    tel VARCHAR
);

CREATE TABLE Etudiant (
    Id_Etudiant INT PRIMARY KEY REFERENCES Utilisateur(Id)
);

CREATE TABLE Secretaire (
    Id_Secretaire INT PRIMARY KEY REFERENCES Utilisateur(Id),
    Bureau VARCHAR
);

CREATE TABLE Enseignant (
    Id_Enseignant INT PRIMARY KEY REFERENCES Utilisateur(Id),
    Bureau VARCHAR
);

CREATE TABLE Administrateur (
    Id_Administrateur INT PRIMARY KEY REFERENCES Utilisateur(Id)
);

CREATE TABLE Tuteur_entreprise (
    Id_TuteurEntreprise INT PRIMARY KEY REFERENCES Utilisateur(Id),
    Id_Entreprise INT REFERENCES Entreprise(Id_Entreprise)
);
