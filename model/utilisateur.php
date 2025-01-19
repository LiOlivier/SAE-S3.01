<?php
$chemin='..\config\database.php';//a modifier pour chaque personne
require_once($chemin);


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

    public function getEleveParTuteur($idTuteur)
{
    $sql = "SELECT u.nom, u.prenom, u.telephone, u.email, d.Libelle AS departement
            FROM utilisateur u
            INNER JOIN stage s ON s.Id_Etudiant = u.id
            INNER JOIN departement d ON s.Id_Departement = d.Id_Departement
            WHERE s.Id_Tuteur_Entreprise = :idTuteur";

    $query = $this->db->prepare($sql);
    $query->execute(['idTuteur' => $idTuteur]);
    return $query->fetchAll(PDO::FETCH_ASSOC); // Retourne un tableau contenant les informations des élèves
}

    public function getEnseignantParTuteur($idTuteur)
    {
        $sql = "SELECT u.nom, u.prenom, u.telephone, u.email
                FROM utilisateur u
                INNER JOIN enseignant e ON u.id = e.Id_Enseignant
                INNER JOIN stage s ON s.Id_Enseignant_1 = e.Id_Enseignant
                WHERE s.Id_Tuteur_Entreprise = :idTuteur";

        $query = $this->db->prepare($sql);
        $query->execute(['idTuteur' => $idTuteur]);
        return $query->fetch(PDO::FETCH_ASSOC); // Retourne une seule ligne (enseignant)
    }

    public function getTuteurByUserId($userId)
    {
        // Requête SQL pour récupérer l'id_Tuteur_Entreprise à partir de la table utilisateur
        $sql = "SELECT id_Tuteur
                FROM utilisateur
                WHERE id = :userId";

        // Préparation et exécution de la requête
        $query = $this->db->prepare($sql);
        $query->execute(['userId' => $userId]);

        // Récupération du résultat (id_Tuteur_Entreprise) ou null si pas trouvé
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Retourne l'id_Tuteur_Entreprise ou null si non trouvé
        return $result ? $result['id_Tuteur'] : null;
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
