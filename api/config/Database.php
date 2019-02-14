<?php
include_once 'config.php';

/**
 * Class Database
 */

class Database{
    /**
    * Fonction Database
    * Cette fonction permet de créer une connexion à la base de données, en utilisant PDO.
    * Si la connexion est effective alors la fonction retourne $db, sinon elle nous retourne une erreur PDO
    * @return $db
    */

    public static function connect(){
        try {
        $db = new PDO("mysql:host=SERVER;dbname=DBNAME", USERNAME, PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erreur de connexion à la BDD ' .$e->getMessage();
        }
        return $db;
    }
}
