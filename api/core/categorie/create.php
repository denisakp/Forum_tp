<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Categorie.php';

// if(isset($_POST['creer'])){
//     if(!empty($_POST['libelle_cat'])){
//         $libelle = $_POST["libelle_cat"];

//         $categorie = new Categorie($libelle);
//         if($categorie->addCategorie($categorie)){
//             echo 'success';
//         }else{
//             echo 'error';
//         }
//     }
// }
$libelle = $_POST["libelle_cat"];
$categorie = new Categorie("",$libelle);
if($categorie->addCategorie($categorie)){
    echo 'success';
}else{
    echo 'error';
}