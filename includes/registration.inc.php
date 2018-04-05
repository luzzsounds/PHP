<h1>Inscription</h1>
<?php

if (isset($_POST['frmRegistration'])) {
    // Syntaxe classique
    // if (isset($_POST['nom'])) {
    //   $nom = $_POST['nom'];
    // }

    // else {
    //   $nom = "";

    // }
    // Opérateur ternaire
    // $nom = isset($_POST['nom']) ? $_POST['nom'] : "" ;       //operateur ternaire

    // Opérateur NULL coalescent PHP7
    $nom = $_POST['nom'] ?? "";
    $prenom = $_POST['prenom'] ?? "";
    $mail = $_POST['mail'] ?? "";
    $mdp = $_POST['mdp'] ?? "";

    $erreurs = array();

    if($nom == "") array_push($erreurs, "Veuillez saisir votre nom");
    if($prenom == "") array_push($erreurs, "Veuillez saisir votre prenom");
    if($mail == "") array_push($erreurs, "Veuillez saisir votre mail");
    if($mdp == "") array_push($erreurs, "Veuillez saisir votre mot de passe");

    if (count($erreurs) > 0 ) {
        $message = "<ul>";

        foreach($erreurs as $ligneMessage) {
         $message .= "<li>";
         $message .= $ligneMessage;
         $message .= "</li>" ;
       }

       $message .="<ul>";

       echo $message;

       include "frmRegistration.php";

    }

    else {
        $connection = mysqli_connect("localhost", "ludwig", "WEBFORCE3", "phpdieppe" );
        // permet de ce connecter a la base de donne (adresse, utilisateur, mot de passe, base de donné )

    }
}

else{
  echo "je ne viens pas du formulaire";
  include "frmRegistration.php";
}


