<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Categorie.php';

  $categorie = new Categorie();

  $res = $categorie->readAllCategorie();
  if($res){
      echo "succes";
  }else{
      echo 'error';
  }

 
//   if($num >0){
//       $res2 = $res->fetchAll(PDO::FETCH_ASSOC);
//       echo json_encode($res2);
//   }else{
//       echo json_encode(
//           array('message' => 'Aucune information à afficher')
//       );
//   }
