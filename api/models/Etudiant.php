<?php

class Etudiant {

    private $table = 'etudiant';

    private $matricule;
    private $nom;
    private $prenom;
    private $pseudo;
    private $motdepasse;
    private $filiere;
    
    public function lire(){
        $con = Database::connect();
        $sql = 'SELECT * FROM '.$this->table.' ';
        $stmt = $con->query($sql);
        if($stmt){
            return $stmt;
        }else{
            return false;
        }
    } 

    public function ajouter(){
        $con = Database::connect();
        $sql = 'INSERT INTO '.$this->table.' SET matricule = :matricule, nom = :nom, prenom = :prenom, pseudo = :pseudo, motdepasse = :motdepasse, filiere = :filiere ';
        $stmt = $con->prepare($sql);

        $stmt->bindParam('matricule', $this->matricule);
        $stmt->bindParam('nom', $this->nom);
        $stmt->bindParam('prenom', $this->prenom);
        $stmt->bindParam('pseudo', $this->pseudo);
        $stmt->bindParam('motdepasse', $this->motdepasse);
        $stmt->bindParam('filiere', $this->filiere);

        $res = $stmt->execute();
        if($res){
            return true;
        }else{
            echo 'Erreur lors de la creation: ' . $stmt->error;
        }
    }
}