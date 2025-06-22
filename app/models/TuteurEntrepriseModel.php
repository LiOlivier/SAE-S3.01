<?php

class TuteurEntrepriseModel
{
    private $bd;
    private static $instance = null;

    private function __construct()
    {
        require_once(__DIR__ . "/../../config/database.php");
        $this->bd = Database::getConnexion();
    }

    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getTuteursPedagogiquesByTuteurEntreprise($idTuteurEntreprise)
    {
        $requete = $this->bd->prepare('
            SELECT DISTINCT u.id, u.nom, u.prenom, u.email, u.telephone
            FROM utilisateur u
            JOIN utilisateur etu ON etu.id_Pedagogique = u.id
            WHERE etu.id_Tuteur = :idTuteurEntreprise AND u.role = "pedagogique"
        ');
        $requete->bindParam(':idTuteurEntreprise', $idTuteurEntreprise, PDO::PARAM_INT);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEtudiantsByTuteurEntreprise($idTuteurEntreprise)
{
    $requete = $this->bd->prepare('
        SELECT u.id AS id_etudiant, u.nom, u.prenom, u.email, u.telephone
        FROM utilisateur u
        JOIN stage s ON u.id = s.id_etudiant
        WHERE u.role = "etudiant" AND s.id_tuteur_entreprise = :idTuteurEntreprise
    ');
    $requete->bindParam(':idTuteurEntreprise', $idTuteurEntreprise, PDO::PARAM_INT);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

    
    
}