INSERT INTO Utilisateur(nom,prenom,email,telephone,login,motdepasse) VALUES
  ('Essafa','Yassine','yassineessafa49@gmail.com','0102030405','12302332','090709756JF'),
  ('Vuong','Denis','vuong.denis.p@gmail.com','0607080910','48944444','gb59etffffre'),
  ('Rattina','Bharani','bharanirattina@gmail.com','1009080706','4895615649','sdfghrYUGGrhs'),
  ('Lointier','Maxime','lointier.maxime@gmail.com','0504030201','rvrj444rvrseq','motdepasse'),
  ('Pham','Huy','phamhuy110205@gmail.com','6984563269','L0gIn','455985cecfe'),
  ('Li','Olivier','liolivier98@gmail.com','0700000000','grr955efefef','YUEFUvfb8484'),
  ('Jeremias','Sherwin','sherwinfrance18@gmail.com','0880088008','XxgoatxX','gojgoirssssss'),
  ('Audibert','Laurent','laurent.audibert@univ-paris13.fr','9999999999','szdLPLSZ89','lplflel'),
  ('Preteseille','Christine','christine.preteseille@gmail.com','19451677411','siuuujxjjqj7','jujuujjuju');

INSERT INTO TypeAction(libelle,Executant,Destinataire,delaiEnJours,ReferenceDelai,requiertDoc,LienModeleDoc) VALUES
  ('Rapport d’installation', 'Etudiant', 'Tuteur Pédagogique', 7, 1, 'Oui', 'lien_modele_rapport_installation.pdf'),
  ('Contact Entreprise', 'Tuteur Pédagogique', 'Entreprise', 14, 1, 'Non', NULL),
  ('Entretien Mi-Stage', 'Tuteur Pédagogique', 'Entreprise', 30, 1, 'Non', NULL),
  ('Planification Soutenance', 'Tuteur Pédagogique', 'Etudiant', 90, 2, 'Oui', 'lien_modele_planification.pdf'),
  ('Dépôt Rapport de Stage', 'Etudiant', 'Tuteur Pédagogique', 100, 2, 'Oui', 'lien_modele_rapport_stage.pdf');

INSERT INTO Entreprise(adresse,code_postal,ville,indicationVisite,tel) VALUES
  ('16 rue Jean Courtois',72400,'La Ferté-Bernard',true,'0500813500'),
  ('8 rue Jean Morgon',01000,'Bourg-en-Bresse',true,'0184986414'),
  ('32 rue Paul Eluard',27140,'Gisors',false,'9900115577'),
  ('7 rue de la Roche',79360,'Les Fosses',true,'0123456789'),
  ('21 rue Pascal',18000,'Bourges',false,'9876543210'),
  ('39 rue Baron Louis',54200,'Toul',true,'0000000000'),
  ('26 rue Saint-Julien',33112,'Saint-Laurent-Médoc',false,'6666666666');

INSERT INTO Etudiant(id_Etudiant) VALUES
  (0),(1),(2),(3),(4),(5),(6);

INSERT INTO Secretaire(id_Secretaire,Bureau) VALUES
  (8,'L100');

INSERT INTO Enseignant(id_Enseignant,Bureau) VALUES
  (7,'L105');

INSERT INTO Administrateur(id_Administrateur) VALUES
  (7),
  (8);

INSERT INTO Tuteur_Entreprise(id_Tuteur_Entreprise,Id_Entreprise) VALUES
  (7, 1),
  (8, 3);

INSERT INTO annee(annee) VALUES
  (2023),
  (2024),
  (2025);

INSERT INTO Departement(Libelle,Id_Enseignant) VALUES
  ('INFO',7);

INSERT INTO Semestre(id_Departement,numSemestre,Id_Enseignant,annee) VALUES
  (0,4,7,2024);

INSERT INTO Intervient(Id_Enseignant,Id_Departement,specialise) VALUES
  (7,0,'BD');

INSERT INTO gere(Id_Departement,numSemestre,Id_Secretaire) VALUES
  (0,4,8);

INSERT INTO Inscription(annee,Id_Departement,numSemestre,Id_Etudiant) VALUES
  (2024,0,4,0),
  (2024,0,4,1),
  (2024,0,4,2),
  (2024,0,4,3),
  (2024,0,4,4),
  (2024,0,4,5),
  (2024,0,4,6);

INSERT INTO Stage(annee,Id_Departement,numSemestre,Id_Etudiant,date_debut,date_fin,mission,date_soutenance,salle_soutenance,Id_Enseignant_1,
Id_Tuteur_Entreprise,Id_Enseignant_2) VALUES
  (2024, 0, 4, 0, '2024-04-01', '2024-06-30', 'Développement d’une application web', '2024-07-15', 'Salle A1', 7, 5, 7),
  (2024, 0, 4, 1, '2024-05-01', '2024-07-31', 'Analyse des données clients', '2024-08-20', 'Salle B2', 7, 6, 7);

INSERT INTO Action(annee,Id_Departement,numSemestre,Id_Etudiant,Id_Stage,date_realisation,lienDocument,Id_TypeAction,Id) VALUES
  (2024, 0, 4, 0, 1, '2024-04-05', 'lien_rapport_1.pdf', 0, 5),
  (2024, 0, 4, 0, 1, '2024-05-15', NULL, 1, 7),
  (2024, 0, 4, 1, 2, '2024-05-10', 'lien_rapport_2.pdf', 0, 6),
  (2024, 0, 4, 1, 2, '2024-05-20', NULL, 1, 7);