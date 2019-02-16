<?php
/**
 * Class Commentaire
 */

 class commentaire{
    private $table = "commentaire";

     private $id_com;
     private $contenu_disc;
     private $date_com;
     private $matricule;
     private $id_disc;

     public function __construct(){
         
     }

     public function __set($property, $value){
        $this->$property = $value;
    }

     public function __get($property){
        return $this->$property;
    }

     public function getID_con(){
         return $this->getID_con;
     }

     public function getContenu_Disc(){
         return $this->contenu_disc;
     }

     public function getMatricule(){
         return $this->matricule;
     }

     public function getDate_com(){
         return $this->date_com;
     }

     public function getId_disc(){
         return $this->id_disc;
     }


     


     
 }