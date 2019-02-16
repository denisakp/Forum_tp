<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Etudiant.php';

  $etudiant = new Etudiant();

  $res = $etudiant->readAllEtudiant();
  if($res){
    echo 'succes';
  }else{
      echo 'error';
  }
