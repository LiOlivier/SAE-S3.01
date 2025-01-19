<?php
$chemin_relatif='..\config\database.php';//a modifier pour chaque personne
require_once($chemin_relatif);


class Utilisateur
{
    protected $table = "utilisateur";
    protected $db;

    public function __construct($dbType = 'mysql')
    {
        $this->db = Database::getConnexion($dbType);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function login($login)
    {
        $sql = "SELECT * FROM $this->table WHERE login = :login";
        $query = $this->db->prepare($sql);
        $query->execute(['login' => $login]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function register($data)
    {
        $sql = "INSERT INTO $this->table (nom, prenom, login, password, email, telephone) 
                    VALUES (:nom, :prenom, :login, :password, :email, :tel)";
        $query = $this->db->prepare($sql);
        $query->execute($data);

        return $this->db->lastInsertId();
    }

    public function getPedagogiqueByEtudiant($idEtudiant)
    {
        $sql = "SELECT u.prenom, u.nom, u.email, u.telephone
            FROM $this->table u
            INNER JOIN stage s ON u.id = s.Id_Enseignant_1
            WHERE s.id_Etudiant = :idEtudiant";
        $query = $this->db->prepare($sql);
        $query->execute(['idEtudiant' => $idEtudiant]);
        return $query->fetchAll(PDO::FETCH_ASSOC); // Retourne un tableau d'enseignants
    }
    
    public function getTuteursByEtudiant($idEtudiant)
    {
        $sql = "SELECT u.prenom, u.nom, u.email, u.telephone
            FROM $this->table u
            INNER JOIN tuteur_entreprise t ON u.id = t.id_Tuteur_Entreprise
            WHERE t.id_Etudiant = :idEtudiant";
        $query = $this->db->prepare($sql);
        $query->execute(['idEtudiant' => $idEtudiant]);
        return $query->fetchAll(PDO::FETCH_ASSOC); // Retourne un tableau de tuteur
    }


    public function getPedagogiqueById($id)
    {
        $sql = "SELECT id_Pedagogique FROM $this->table WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function cleanXSS($value)
    {

        $first = strpos($value, '<', 0);
        $last = strrpos($value, '>', 0);

        if ($first && $last) {

            $cleaner = substr($value, $first, $last - $first + 1);
            $cleanString = str_replace($cleaner, "", $value);

            return $cleanString;
        } elseif ($first && !$last) {

            $cleaner = substr($value, $first);
            $cleanString = str_replace($cleaner, "", $value);

            return $cleanString;
        } elseif (!$first && $last) {

            $cleaner = substr($value, 0, $last - $first + 1);
            $cleanString = str_replace($cleaner, "", $value);

            return $cleanString;
        } else {

            return $value;
        }
    }

    public function getEleveParTuteur($idTuteur) {
        // Requête pour récupérer les informations de l'élève et du département lié au tuteur dans la table 'stage'
        // On fait une jointure entre 'stage', 'utilisateur' et 'departement'
        $query = "SELECT utilisateur.nom, utilisateur.prenom, utilisateur.telephone, utilisateur.email, departement.nom AS departement
                  FROM stage 
                  JOIN utilisateur ON stage.Id_Etudiant = utilisateur.id
                  JOIN departement ON stage.Id_Departement = departement.Id_Departement
                  WHERE stage.Id_Tuteur_Entreprise = :idTuteur";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idTuteur', $idTuteur, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnseignantParTuteur($idTuteur) {
        // Requête pour récupérer les informations de l'enseignant lié au tuteur dans la table 'stage'
        // On fait une jointure entre 'stage', 'enseignant', et 'utilisateur'
        $query = "SELECT utilisateur.nom, utilisateur.prenom, utilisateur.telephone, utilisateur.email
                  FROM stage 
                  JOIN enseignant ON stage.Id_Enseignant_1 = enseignant.Id_Enseignant 
                  JOIN utilisateur ON enseignant.Id_Enseignant = utilisateur.id
                  WHERE stage.Id_Tuteur_Entreprise = :idTuteur";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idTuteur', $idTuteur, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUtilisateur($id, $nom = null, $prenom = null, $email = null, $telephone = null)
    {
        $fieldsToUpdate = [];
        $parameters = ['id' => $id];
    
        if ($nom !== null) {
            $fieldsToUpdate[] = "nom = :nom";
            $parameters['nom'] = $nom;
        }
    
        if ($prenom !== null) {
            $fieldsToUpdate[] = "prenom = :prenom";
            $parameters['prenom'] = $prenom;
        }
    
        if ($email !== null) {
            $fieldsToUpdate[] = "email = :email";
            $parameters['email'] = $email;
        }
    
        if ($telephone !== null) {
            $fieldsToUpdate[] = "telephone = :telephone";
            $parameters['telephone'] = $telephone;
        }
    
        if (empty($fieldsToUpdate)) {
            return 0;
        }
    
        $sql = "UPDATE utilisateur SET " . implode(", ", $fieldsToUpdate) . " WHERE id = :id";
    
        echo "Requête SQL : " . $sql . "<br>";
    
        echo "<pre>";
        print_r($parameters);
        echo "</pre>";
    
        $pdo = Database::getConnexion();
        if ($pdo === null) {
            echo "Erreur de connexion à la base de données";
            return 0;
        }
    
        try
        {
            $query = $pdo->prepare($sql);
            $query->execute($parameters);
            $affectedRows = $query->rowCount();
            echo "Lignes affectées : " . $affectedRows . "<br>";
            return $affectedRows;
        } 
        catch (PDOException $e)
        {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
            return 0;
        }
    }
    
}