<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Categorie.php';

$id = $_POST['id_cat'];
$libelle = NULL;

$categorie = new Categorie($id, $libele);

$res = $categorie->deleteCategorie($categorie);
if($res){
    echo "succes";
}else{
    echo 'error';
}