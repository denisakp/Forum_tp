<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Categorie.php';

$id = NULL;
$nom = NULL;
$categorie = new Categorie($id, $nom);

$res = $categorie->deleteCategorie();
if($res){
    echo "succes";
}else{
    echo 'error';
}