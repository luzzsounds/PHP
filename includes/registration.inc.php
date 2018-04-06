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

    // Opérateur NULL coalescent PHP7           permet de recuperer les champ input
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
        // nom de domaine / id de la bdd / mdp / nom de la base de donne
        $mdp = sha1($mdp);


        $token = uniqid(sha1(date('Y-m-d|H:m:s')), false);



        // permet de ce connecter a la base de donne : mysqli_connect( adresse, utilisateur, mot de passe, base de donné )
        $requete = "INSERT INTO T_USERS
                    (USERNAME, USEFIRSTNAME, USERMAIL, USEPASSWORD, ID_ROLE, USETOKEN)
                    VALUE ('$nom', '$prenom','$mail', '$mdp', 3, '$token')";





        if(!$connection) {
          die("erreur MySQL" . mysqli_connect_errno() . " | " . mysqli_connect_error());
        }

        else{
            if(mysqli_query($connection, $requete)) {

              echo "Données enregistrée";

              $id = mysqli_insert_id($connection);

              $messageMail = "<h1> Wunderbar !!!!!</h1>";
              $messageMail .= "<p>Vous etes inscript !</p>";
              $messageMail .= "<p>Mais vous devez valider votrre inscription.</p>";
              $messageMail .="<p><a href='http://localhost/php/index.php?page=mailValidation&amp;id=$id&amp;token=$token'>";
              $messageMail .= "Clique-moi grand fou !";
              $messageMail .= "</a></p>";







              $headers = "From: manu@elysees.fr" . "\r\n" .
                          "Reply-to: doudou@matignon.com" . "\r\n" .
                          "X-Mailer: PHP/" . phpversion();

              mail($mail, 'Inscription compte', $messageMail, $headers);







            }
            else {
                echo "Erreur";
                include "frmRegistration.php";
            }
          mysqli_close($connection);
        }
    }
}

else{
  echo "je ne viens pas du formulaire";
  include "frmRegistration.php";
}


