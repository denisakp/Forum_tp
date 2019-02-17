<?php
/**
 * Class Discution
 */

 class Discussion{
     private $table = "discussion";

     private $id_disc;
     private $titre_disc;
     private $contenu_disc;
     private $date_disc;
     private $etat_disc;
     private $matricule;
     private $id_cat;

     public function __construct(){
        $args = func_get_args(); //Toute fonction qui appelle cette méthode peut prendre arbitrairemrnt un nombre de paramètres définis
        
        switch(func_num_args())
        {
            case 0:
                $this->construct0();
            break;
            case 1:
                $this->construct1($args[0]);
            break;
            case 5:
                $this->construct2($args[0], $args[1], $args[2], $args[3], $args[4]);
            break;
            default:
                trigger_error('Nombre d\'arguments incorrect pour la classe Etudiant::__construct', E_USER_WARNING);
        }
     }

     private function construct0(){ } //utilisé pour les méthodes read
 
     private function construct1($mot_cle) //utilisé pour rechercher des discussions
     {
         $this->titre_disc = $mot_cle;
     }
  
     private function construct2($titre, $contenu, $date, $matricule,$id_cat) //pour crer une discussion
     {
        $this->titre_disc = $titre;
        $this->contenu_disc = $contenu;
        $this->date_disc = $date;
        $this->matricule = $matricule;
        $this->id_cat = $id_cat;
     }
 
     public function __get($property){
         return $this->$property;
     }
 
     public function __set($property, $value){
         $this->$property = $value;
     }

     public function getId_disc(){return $this->$id_cat;}
     public function getTitre_disc(){return $this->$titre_disc;}
     public function getContenu_disc(){return $this->contenu_disc;}
     public function getDate_disc(){return $this->date_disc;}
     public function getId_cat(){return $this->id_cat;}

     public function readDisc(){
         $con = Database::connect();
         $sql = 'SELECT * FROM '.$this->table.' ';
         $stmt = $con->query($sql);
         if($stmt){
             $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
             echo json_encode($data);
             return true;
         }else{
            print_r($con->errorInfo());
             return false;
         }
     }
 }