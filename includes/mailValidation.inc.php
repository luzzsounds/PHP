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


      if ($resultatRequete = mysqli_query($connection, $requeteVerif)) {
            $nbrResultats = mysqli_num_rows($resultatRequete);
            mysqli_free_result($resultatRequete);
            if ($nbrResultats > 0) {
                $requeteUpdate = "UPDATE T_USERS
                                SET USEVERIF=1
                                WHERE ID_USER=$id";
                if (mysqli_query($connection, $requeteUpdate)) {
                    echo "Inscription validée";
                }
                else {
                    echo "Inscription pas validée, mais alors pas validée du tout";
                }
            }
            else {
                echo "<h1>Bien tenté, mais essaie encore</h1>";
            }
        }
        else {
            echo "Erreur";
        }
        mysqli_close($connection);
    }
}
else {
    echo "<h1>Bien tenté, mais essaie encore</h1>";
}
