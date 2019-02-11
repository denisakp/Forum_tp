<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/Database.php';
  include_once '../models/Etudiant.php';

  $bdd = new Database();
  $db = $bdd->connect();

  $etudiant = new Etudiant($db);

  $data = json_decode(file_get_contents("php://input"));
  
  $etudiant->matricule = $data->matricule;
  $etudiant->nom = $data->nom;
  $etudiant->prenom = $data->prenom;
  $etudiant->pseudo = $data->pseudo;
  $etudiant->motdepasse = $data->motdepasse;
  $etudiant->filiere = $data->filiere;

  if($etudiant->ajouter()){
      echo json_encode(array(
          'message' => 'Etudiant ajouter avec succes'
      ));
  }else{
      echo json_encode(array(
          'message' => 'Etudiant non ajoutee'
      ));
  }