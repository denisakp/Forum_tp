<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Categorie.php';

  $categorie = new Categorie($id, $nom);

  $res = $categorie->readAllCategorie();
  if($res){
      echo "succes";
  }else{
      echo 'error';
  }