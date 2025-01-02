INSERT INTO Utilisateur(nom,prenom,email,telephone,login,motdepasse) VALUES (

);

INSERT INTO TypeAction(libelle,Executant,Destinataire,delaiEnJours,ReferenceDelai,requiertDoc,LienModeleDoc) VALUES (
  
);

INSERT INTO Entreprise(adresse,code_postal,ville,indicationVisite,tel) VALUES (

);

INSERT INTO Etudiant(id_Etudiant) VALUES (
  
);

INSERT INTO Secretaire(id_Secretaire,Bureau) VALUES (

);

INSERT INTO Enseignant(id_Enseignant,Bureau) VALUES (

);


INSERT INTO Administrateur(id_Administrateur,id_Entreprise) VALUES (

);


INSERT INTO Tuteur_Entreprise(id_Tuteur_Entreprise) VALUES (

);

INSERT INTO annee(annee) VALUES
  (2023),
  (2024),
  (2025);

INSERT INTO Departement(Libelle,Id_Enseignant) VALUES (

);

INSERT INTO Semestre(id_Departement,numSemestre,Id_Enseignant,annee) VALUES (

);

INSERT INTO Intervient(Id_Enseignant,Id_Departement,specialise) VALUES (

);

INSERT INTO gere(Id_Departement,numSemestre,Id_Secretaire) VALUES (

);

INSERT INTO Inscription(annee,Id_Departement,numSemestre,Id_Etudiant) VALUES (

);

INSERT INTO Stage(annee,Id_Departement,numSemestre,Id_Etudiant,Id_Stage,date_debut,date_fin,mission,date_soutenance,salle_soutenance,Id_Enseignant_1,
Id_Tuteur_Entreprise,Id_Enseignant_2) VALUES (

);

INSERT INTO Action(annee,Id_Departement,numSemestre,Id_Etudiant,Id_Stage,Id_Action,date_realisation,lienDocument,Id_TypeAction,Id) VALUES (

);

