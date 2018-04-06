<?php
//  On vérifie si les parametre d'url 'id' et 'token' existent
if (isset($_GET['id']) && isset($_GET['token'])) {
  // s'ils existent, on les récupere pour les affecter a des variables plus simple a manipuler
    $id = $_GET['id'];
    $token = $_GET['token'];

    // Connexion a la base de donnes

    $connection = mysqli_connect("localhost", "ludwig", "WEBFORCE3", "phpdieppe");


    // On verifie si la connexion est OK. En cas de probleme, on affiche le numero d'erreurs
    if(!$connection) {
          die("erreur MySQL" . mysqli_connect_errno() . " | " . mysqli_connect_error());

}

    else {
      // REQUETE SQL
      $requeteVerif = " SELECT * FROM T_USERS
                        WHERE ID_USER=$id
                        AND USETOKEN='$token' ";


      die($requeteVerif);

    }


}

else {

}
