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
    public function __construct($id,$nom){
        $this->libelle = $nom;
        $this->id_cat = $id;
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
     * Fonction Liste
     * Cette fonction permet d'afficher la liste des catégories.
     * 
     * $con:il s'agit de la valeur retournée par la méthode connect de la classe Database
     * 
     * $sql: est la requete SQL qui sera exécuté
     * 
     * On affichera que les resultats dont l'état est à 1
     * 
     * Si aucune erreur, elle retourne true, sinon elle retourne false
     * @return boolean
     */
    public function readAllCategorie(){
        $con = Database::connect();
        $sql = "SELECT libelle_cat FROM categorie_disc WHERE etat = '1' ";
        $stmt = $con->query($sql);
        
        if($stmt){
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode ($data);
            return true;
        }else{
            return false;
        }
    }

    /**
     * Fonction Liste
     * Cette fonction permet d'afficher une seule categorie
     * 
     * $con:il s'agit de la valeur retournée par la méthode connect de la classe Database
     * 
     * $sql: est la requete SQL qui sera exécuté
     * 
     * On affichera le resultat que si l'état est à 1
     * 
     * Si aucune erreur, elle retourne true, sinon elle retourne false
     * @return boolean
     */
    public function readOneCategorie(Categorie $categorie, $id_cat){
        $con = Database::connect();
        $sql = "SELECT id_cat FROM category_disc WHERE id_cat = ? AND etat = '1' ";

        $stmt = $con->prepare($sql);
        $smt-> binParam(1, $this->id_cat);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id_cat = $row['id_cat'];
        $this->libelle = $row['libelle_cat'];

        return true;
    }


    /**
     * Fonction Liste
     * Cette fonction permet d'ajouter une catégorie
     * 
     * $con:il s'agit de la valeur retournée par la méthode connect de la classe Database
     * 
     * $sql: est la requete SQL qui sera exécuté
     * 
     * La fonction prend en paramètre un objet Categorie
     * Si aucune erreur, elle retourne true, sinon elle retourne false
     * @return boolean
     */
    public function addCategorie(Categorie $categorie){
        $con = Database::connect();
        $sql = "INSERT INTO categorie_disc SET libelle_cat = :libelle, etat = '1' ";
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
     * Fonction Liste
     * Cette fonction permet de mettre à jour une categorie
     * 
     * $con:il s'agit de la valeur retournée par la méthode connect de la classe Database
     * 
     * $sql: est la requete SQL qui sera exécuté
     * 
     * La fonction prend en paramètre un objet categorie et un id de la categorie à modifier
     * 
     * Si aucune erreur, elle retourne true, sinon elle retourne false
     * @return boolean
     */
    public function updateCategorie(Categorie $categorie){
        $con = Database::connect();
        $sql = "UPDATE categorie_disc SET libelle_cat = ? WHERE id_cat = ? AND etat = '1' ";
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
     * Fonction Liste
     * Cette fonction permet de supprimer une categorie
     * 
     * $con:il s'agit de la valeur retournée par la méthode connect de la classe Database
     * 
     * $sql: est la requete SQL qui sera exécuté
     * 
     * La fonction prend en paramètre un objet categorie et un id de la categorie à supprimer.
     * Pour des raisons de traçabilité, on modifie juste l'état de l'enregistrement qui passe à 0
     * 
     * Si aucune erreur, elle retourne true, sinon elle retourne false
     * @return boolean
     */
    public function deleteCategorie(Categorie $categorie){
        $con = Database::connect();
        $sql = "UPDATE categorie_disc SET etat = '0' WHERE id_cat = ?";
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