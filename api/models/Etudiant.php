<?php

class Etudiant {
    /**
     * @var string Table utilisée pour effectuer les opérations avec la BDD
     */
    private $table = 'etudiant';

    /**
     * @var string le numéro matricule de l'etudiant
     */
    private $matricule;

    /**
     * @var string Le nom de l'étudiant
     */
    private $nom;

    /**
     * @var string le prenom de l'étudiant
     */
    private $prenom;

    /**
     * @var string le pseudo de l'étudiant
     */
    private $pseudo;

    /**
     * @var string le mot de passe de l'étudiant
     */
    private $motdepasse;

    /**
     * @var string La filiere de l'etudiant 
     */
    private $filiere;

    /**
     * Constructeur de la classe Etudiant
     */

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

    /**
     * Getter de la proprieté nom
     */
    public function getNom(){
        return $this->nom;
    }

    /**
     * Getter de la proprieté prenom
     */
    public function getPrenom(){
        return $this->prenom;
    }

    /**
     * Getter de la proprieté Pseudo
     */

    public function getPseudo(){
        return $this->pseudo;
    }

    /**
     * GEtter de la proprieté Motdepasse
     */
    public function getMotdepasse(){
        return $this->motdepasse;
    }


    /**
     * Getter de la proprieté filière
     */
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

    /**
     * Fonction Liste
     * Cette fonction permet d'afficher une seule categorie
     * 
     * $con:il s'agit de la valeur retournée par la méthode connect de la classe Database
     * 
     * $sql: est la requete SQL qui sera exécuté
     * 
     * Si aucune erreur, elle retourne true, sinon elle retourne false
     * @return boolean
     */
    public function readOneEtudiant(Etudiant $etudiant, $matricule){
        $con = Database::connect();
        $sql = 'SELECT * FROM '.$this->table.' WHERE matricule = ? ';

        $stmt = $con->prepare($sql);
        $smt-> binParam(1, $this->matricule);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->matricule = $row['matricule'];
        $this->nom = $row['nom'];
        $this->prenom = $row['prenom'];
        $this->pseudo = $row['pseudo'];
        $this->motdepasse = $row['motdepasse'];
        $this->filiere = $row['filiere'];

        return true;
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