
CREATE TABLE Utilisteur(
    Id SERIAL PRIMARY KEY,
    nom VARCHAR,
    prenom VARCHAR,
    email VARCHAR UNIQUE,
    telephone VARCHAR,
    login VARCHAR NOT NULL UNIQUE,
    motdepasse VARCHAR NOT NULL UNIQUE
);

CREATE TABLE TypeAction(
    Id_TypeAction SERIAL PRIMARY KEY,
    libelle VARCHAR,
    Executant VARCHAR,
    Destinataire VARCHAR,
    delaiEnJours INT,
    ReferenceDelai INT,
    requiertDoc VARCHAR,
    LienModeleDoc VARCHAR
);

CREATE TABLE Entreprise(
    Id_Entreprise SERIAL PRIMARY KEY,
    adresse VARCHAR,
    code_postal INT,
    ville VARCHAR,
    indicationVisite BOOLEAN,
    tel VARCHAR
);

CREATE TABLE Etudiant(
    Id_Etudiant INT PRIMARY KEY,
    FOREIGN KEY(Id_Etudiant) REFERENCES Utilisteur(Id)
);

CREATE TABLE Secretaire(
    Id_Secretaire INT PRIMARY KEY,
    Bureau VARCHAR,
    FOREIGN KEY(Id_Secretaire) REFERENCES Utilisteur(Id)
);

CREATE TABLE Enseignant(
    Id_Enseignant INT PRIMARY KEY,
    Bureau VARCHAR,
    FOREIGN KEY(Id_Enseignant) REFERENCES Utilisteur(Id)
);

CREATE TABLE Administrateur(
    Id_Administrateur INT PRIMARY KEY,
    FOREIGN KEY(Id_Administrateur) REFERENCES Utilisteur(Id)
);

CREATE TABLE Tuteur_Entreprise(
    Id_Tuteur_Entreprise INT PRIMARY KEY,
    Id_Entreprise INT NOT NULL,
    FOREIGN KEY(Id_Tuteur_Entreprise) REFERENCES Utilisteur(Id),
    FOREIGN KEY(Id_Entreprise) REFERENCES Entreprise(Id_Entreprise)
);

CREATE TABLE annee(
    annee INT PRIMARY KEY
);

CREATE TABLE Departement(
    Id_Departement SERIAL PRIMARY KEY,
    Libelle VARCHAR UNIQUE,
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

CREATE TABLE Intrevient(
    Id_Enseignant INT,
    Id_Departement INT,
    specialise VARCHAR,
    PRIMARY KEY(Id_Departement, Id_Enseignant),
    FOREIGN KEY(Id_Enseignant ) REFERENCES Enseignant(Id_Enseignant ),
    FOREIGN KEY(Id_Departement) REFERENCES Departement(Id_Departement)
);

CREATE TABLE gere(
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
    annee INT,
    Id_Departement INT,
    numSemestre INT,
    Id_Etudiant INT,
    Id_Stage SERIAL,
    date_debut INT,
    date_fin INT,
    mission VARCHAR,
    date_soutenance VARCHAR,
    salle_soutenance VARCHAR,
    Id_Enseignant_1 INT,
    Id_Tuteur_Entreprise INT NOT NULL,
    Id_Enseignant_2 INT NOT NULL,
    PRIMARY KEY(annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage),
    FOREIGN KEY(annee, Id_Departement, numSemestre, Id_Etudiant) REFERENCES Inscription(annee, Id_Departement, numSemestre, Id_Etudiant),
    FOREIGN KEY(Id_Tuteur_Entreprise) REFERENCES Tuteur_Entreprise(Id_Tuteur_Entreprise),
    FOREIGN KEY(Id_Enseignant_1) REFERENCES Enseignant(Id_Enseignant),
    FOREIGN KEY(Id_Enseignant_2) REFERENCES Enseignant(Id_Enseignant)
);

CREATE TABLE Action(
    annee INT,
    Id_Departement INT,
    numSemestre INT,
    Id_Etudiant INT,
    Id_Stage INT,
    Id_Action SERIAL,
    date_realisation INT,
    lienDocument VARCHAR,
    Id_TypeAction INT NOT NULL,
    Id INT NOT NULL,
    PRIMARY KEY(annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage, Id_Action),
    FOREIGN KEY(annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage) REFERENCES Stage(annee, Id_Departement, numSemestre, Id_Etudiant, Id_Stage),
    FOREIGN KEY(Id_TypeAction) REFERENCES TypeAction(Id_TypeAction),
    FOREIGN KEY(Id) REFERENCES Utilisteur(Id)
);
