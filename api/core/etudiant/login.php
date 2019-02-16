<?php
session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Etudiant.php';

  $pseudo = $_POST['pseudo'];
  $motdp = $_POST['motdepasse'];

  $etudiant = new Etudiant($pseudo, $motdp);
  if($etudiant->loginEtudiant($etudiant)){
      echo 'succes';
  }else{
      echo 'err';
  }


