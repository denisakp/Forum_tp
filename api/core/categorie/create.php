<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Categorie.php';

if(isset($_POST)){
    $libelle = $_POST["libelle_cat"];
    $categorie = new Categorie($libelle);
    if($categorie->ajouter($categorie)){
        echo json_encode(
            array('message' => 'succes',)
        );
        //echo "success";
    }else{
        echo json_encode(array(
            'message' => 'Erreur'
        ));
    }

}
