<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Etudiant.php';

$matricule = $_POST['matricule'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$pseudo = $_POST['pseudo'];
$motdepasse= password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);
$filiere = $_POST['filiere'];

$etudiant = new Etudiant($matricule, $nom, $prenom, $pseudo, $motdepasse, $filiere);
if($etudiant->addEtudiant($etudiant)){
    echo 'succes';
}else{
    echo 'error';
}