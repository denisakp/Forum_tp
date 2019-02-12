<?php

/**
 * Class Categorie
 */

class Categorie{
    /**
     * @var int Identifiant d'une categorie
     */
    private $id_cat;

    /**
     * @var string Non d'une catégorie
     */
    private $libelle;

    /**
     * @param $nom string Non de la categorie à manipuler
     */
    public function __construct($nom){
        $this->libelle = $nom;
    }

    public function getLibelle(){
        return $this->libelle;
    }

    public function __get($property){
        return $this->$property;
    }

    public function __set($property, $value){
        $this->$property = $value;
    }


    /**
     * Fonction Liste: Permet d'afficher la liste des catégorie
     * @return string
     */
    public function liste(){
        $con = Database::connect();
        $sql = "SELECT libelle_cat FROM categorie_disc";
        $stmt = $con->query($sql);
        if($stmt){
            return $stmt;
        }else{
            return false;
        }
    }

    /**
     * Fonction uneCategorie: Permet d'afficher une categorie
     * @return boolean
     */
    public function uneCategorie(){
        $con = Database::connect();
        $sql = "SELECT id_cat FROM category_disc WHERE id_cat = ? ";

        $stmt = $con->prepare($sql);
        $smt-> binParam(1, $this->id_cat);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id_cat = $row['id_cat'];
        $this->libelle = $row['libelle_cat'];

        return true;
    }


    /**
     * Fonction ajouter: Permet d'ajouter une caatégorie
     * @return boolean
     */
    public function ajouter(Categorie $categorie){
        $con = Database::connect();
        $sql = "INSERT INTO categorie_disc SET libelle_cat = :libelle ";
        $stmt = $con->prepare($sql);

        $lib = NULL; //Pour eviter l'erreur de only variables should passed by reference
        $stmt->bindParam(':libelle', $lib);
        $lib = $categorie->getLibelle();

        if($stmt->execute()){
            return true;
        }else{ 
           printf("Erreur: $s.\n", $stmt->error);
            return false;
        }
    }

    /**
     * Fonction miseAjour: Permet de mettre à jour une categorie
     * @return boolean
     */
    public function miseAjour(){
        $con = Database::connect();
        $sql = "UPDATE categorie_disc SET libelle_cat = ? WHERE id_cat = ?";
        $stmt = $con->prepare($sql);
        $stmt-> bindParam(1, $this->libelle);
        $stmt-> bindParam(2, $this->id_cat);

        if($stmt->execute()){
            return true;
        }else{
            printf("Erreur: $s.\n", $stmt->error);
            return false;
        }
    }

        /**
         * Fonction supprimer: Permet de supprimer une categorie
         * @return boolean
         */
    public function supprimer(){
        $con = Database::connect();
        $sql = "DELETE FROM categorie_disc WHERE id_cat = ?";
        $stmt = $con->prepare($sql);
        $stmt-> bindParam(1, $this->id_cat);

        if($stmt->execute()){
            return true;
        }else{
            printf("Erreur: $s.\n", $stmt->error);
            return false;
        }

    }
}