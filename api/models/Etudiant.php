<?php

class Etudiant {

    private $table = 'etudiant';

    private $matricule;
    private $nom;
    private $prenom;
    private $pseudo;
    private $motdepasse;
    private $filiere;

    public function __construct($nom, $prenom, $pseudo, $motdepasse, $filiere){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
        $this->motdepasse = $motdepasse;
        $this->filiere = $filiere;
    }

    public function __get($property){
        return $this->$property;
    }

    public function __set($property, $value){
        $this->$property = $value;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getPseudo(){
        return $this->pseudo;
    }

    public function getMotdepasse(){
        return $this->motdepasse;
    }

    public function getFiliere(){
        return $this->filiere;
    }
    
        /**
     * Fonction lire
     * Cette fonction permet d'afficher la liste des etudiants
     * 
     * $con:il s'agit de la valeur retournée par la méthode connect de la classe Database
     * 
     * $sql: est la requete SQL qui sera exécuté
     * 
     * Si aucune erreur, elle retourne true, sinon elle retourne false
     * @return boolean
     */
    public function readAllEtudiant(){
        $con = Database::connect();
        $sql = 'SELECT * FROM '.$this->table.' ';
        $stmt = $con->query($sql);
        if($stmt){
            return true;
        }else{
            return false;
        }
    } 

    public function addEtudiant(Etudiant $etudiant){
        $con = Database::connect();
        $sql = 'INSERT INTO '.$this->table.' SET matricule = :matricule, nom = :nom, prenom = :prenom, pseudo = :pseudo, motdepasse = :motdepasse, filiere = :filiere ';
        $stmt = $con->prepare($sql);

       //Pour eviter l'erreur de only variables should passed by reference
    // $mat = NULL; 
       $nm = NULL; $pr = NULL; $ps = NULL; $mdp = NULL; $fil = NULL;

    //  $stmt->bindParam('matricule', $mat);
        $stmt->bindParam('nom', $nm);
        $stmt->bindParam('prenom', $pr);
        $stmt->bindParam('pseudo', $ps);
        $stmt->bindParam('motdepasse', $mdp);
        $stmt->bindParam('filiere', $fil);

        $nm = $etudiant->getNom();
        $pre = $etudiant->getPrenom();
        $ps = $etudiant->getPseudo();
        $mdp = $etudiant->getMotdepasse();
        $fil = $etudiant->getFiliere();

        if($stmt->execute($sql)){
            return true;
        }else{
            printf("Erreur: $s.\n", $stmt->error);
            return false;
        }




        $res = $stmt->execute();
        if($res){
            return true;
        }else{
            echo 'Erreur lors de la creation: ' . $stmt->error;
        }
    }
}