<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Categorie.php';

  $id = NULL;
  $nom = NULL;
  $categorie = new Categorie($id, $nom);

  $res = $categorie->readAllCategorie();
  if($res){
      echo json_encode($res);
  }else{
      echo 'error';
  }