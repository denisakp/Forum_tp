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
     * 
     * 
     */

    public function __construct(){
        $args = func_get_args(); //Toute fonction qui appelle cette méthode peut prendre arbitrairemrnt un nombre de paramètres définis
        
        switch(func_num_args())
        {
            case 0:
                $this->construct0(); //Aucun paramètre (utilisé pour les métodes read)
            break;
            case 1:
                $this->construct1($args[0]); //un seul paramètre (utilisé pour les méthodes de recherches)
            break;
            case 2:
                $this->construct3($args[0], $args[1]); //Deux paramètres (utilisé pour le login)
            break;
            case 6:
                $this->construct2($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]); //Tous les paramètres (utilisé pour les autres méthodes)
            break;
            default:
                trigger_error('Nombre d\'arguments incorrect pour la classe Etudiant::__construct', E_USER_WARNING);
        }
    }

    private function construct0(){ }
 
    private function construct1($matricule)
    {
        $this->matricule = $matricule;
    }
 
    private function construct2($matricule, $nom, $prenom, $pseudo, $motdepasse, $filiere)
    {
       $this->matricule = $matricule;
       $this->nom = $nom;
       $this->prenom = $prenom;
       $this->pseudo = $pseudo;
       $this->motdepasse = $motdepasse;
       $this->filiere = $filiere;
    }

    private function construct3($pseudo, $motdepasse){
        $this->pseudo = $pseudo;
        $this->motdepasse = $motdepasse;
    }

    public function __get($property){
        return $this->$property;
    }

    public function __set($property, $value){
        $this->$property = $value;
    }

    /**
     * Getter de la proprieté matricule
     * @return string $matricule
     */
    public function getMatricule(){return $this->matricule;}

    /**
     * Getter de la proprieté nom
     * @return string nom
     */
    public function getNom(){return $this->nom;}

    /**
     * Getter de la proprieté prenom
     * @return string prenom
     */
    public function getPrenom(){return $this->prenom;}

    /**
     * Getter de la proprieté Pseudo
     * @return string pseudo
     */

    public function getPseudo(){return $this->pseudo;}

    /**
     * Getter de la proprieté Motdepasse
     * @return string motdepasse
     */
    public function getMotdepasse(){return $this->motdepasse;}


    /**
     * Getter de la proprieté filière
     */
    public function getFiliere(){return $this->filiere;}
    
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
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data);
            return true;
        }else{
            return false;
        }
    } 

    /**
     * Fonction Liste
     * Cette fonction permet d'afficher un seul etudiant
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

    /**
     * Fonction addEtudiant
     * Cette fonction permet d'ajouter un nouvel étudiant
     * 
     * $con:il s'agit de la valeur retournée par la méthode connect de la classe Database
     * 
     * $sql: est la requete SQL qui sera exécuté
     * 
     * Si aucune erreur, elle retourne true, sinon elle retourne false
     * @return boolean
     */
    public function addEtudiant(Etudiant $etudiant){
        $con = Database::connect();
        $sql = 'INSERT INTO '.$this->table.' SET matricule = :matricule, nom = :nom, prenom = :prenom, pseudo = :pseudo, motdepasse = :motdepasse, filiere = :filiere, etat = 1 ';
        $stmt = $con->prepare($sql);

       //Pour eviter l'erreur de only variables should passed by reference
       $mat = NULL; $nm = NULL; $pr = NULL; $ps = NULL; $mdp = NULL; $fil = NULL;

        $stmt->bindParam(':matricule', $mat);
        $stmt->bindParam(':nom', $nm);
        $stmt->bindParam(':prenom', $pr);
        $stmt->bindParam(':pseudo', $ps);
        $stmt->bindParam(':motdepasse', $mdp);
        $stmt->bindParam(':filiere', $fil);

        $mat = $etudiant->getMatricule();
        $nm = $etudiant->getNom();
        $pr = $etudiant->getPrenom();
        $ps = $etudiant->getPseudo();
        $mdp = $etudiant->getMotdepasse();
        $fil = $etudiant->getFiliere();

        if($stmt->execute()){
            return true;
        }else{
            printf("Erreur: $s.\n", $stmt->error);
            return false;
        }
    }


    /**
     * Fonction updateEtudiant:
     * cette fonction permet de mettre à jour un étudiant
     * @return boolean 
     */
    public function updateEtudiant(Etudiant $etudiant){
        $con = Database::connect();
        $sql = 'UPDATE '.$this->table.' SET matricule = :matricule, nom = :nom, prenom = :prenom, pseudo = :pseudo, motdepasse = :motdepasse, filiere = :filiere ';
        $stmt = $con->prepare($sql);

        $stmt-> bindParam(':matricule', $this->matricule);
        $stmt-> bindParam(':nom', $this->nom);
        $stmt-> bindParam(':prenom', $this->prenom);
        $stmt-> bindParam(':pseudo', $this->pseudo);
        $stmt-> bindParam(':motdepasse', $this->motdepasse);
        $stmt-> bindParam(':filiere', $this->filiere);

        if($stmt->execute()){
            return true;
        }else{
            printf("Erreur: $s.\n", $stmt->error);
            return false;
        }
    }

    /**
     * Fonction deleteEtudiant:
     * cette fonction permet supprimer un étudiant
     * @return boolean 
     */

     public function deleteEtudiant(Etudiant $etudiant){
        $con = Database::connect();
        $sql = 'UPDATE '.$this->table.' SET etat = 0 WHERE matricule = ? ';

        $stmt = $con->prepare($sql);
        $stmt-> bindParam(1, $this->matricule);

        if($stmt->execute()){
            return true;
        }else{
            printf("Erreur: $s.\n", $stmt->error);
            return false;
        }
     }

     public function loginEtudiant(Etudiant $etudiant){
        $con = Database::connect();
        $sql = 'SELECT * FROM '.$this->table.' WHERE pseudo = :pseudo ';
        $stmt = $con->prepare($sql);

        $ps = NULL; $mdp = NULL;
        $stmt-> bindParam(':pseudo', $ps);
        
        $ps = $etudiant->getPseudo();
        $mdp = $etudiant->getMotdepasse();
        $stmt->execute();

        $etu = $stmt->fetch(PDO::FETCH_OBJ);
       
        if($etu && password_verify($mdp, $etu->motdepasse)){
            return true;
        }else{
            return false;
        }
     }
}