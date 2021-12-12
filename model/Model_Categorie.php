<?php
require_once('Database.php');

class Model_Categorie
{
    public static function getAll()
    {
        $db = new Database();
        $sql = "SELECT * from categorie";
        $resultat = $db->execute_query($sql);
        if (!$resultat) {
            $erreur = $db->getPDO()->errorInfo();
            echo "Lecture impossible, code", $db->getPDO()->errorCode(), $erreur[2];
        } else {
            return $resultat->fetchAll(PDO::FETCH_OBJ);
            //return $result->fetchAll(PDO::FETCH_CLASS, 'Produit'); 
        }
    }
}
