<?php

class Database{

    public static function connect(){
        try {
        $db = new PDO("mysql:host=localhost;dbname=forum_db", "error504", "admin1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erreur de connexion à la BDD ' .$e->getMessage();
        }
        return $db;
    }
}
