<form method="post" action="#">
  <div>
      <label for="nom">Nom&nbsp;:</label>
      <input type="text" name="nom" value="<?php if(isset($nom)) echo $nom; ?>"/>
  </div>
  <br>
  <div>
      <label for="prenom">Prenom&nbsp;:</label>
      <input type="text" name="prenom" value="<?php if(isset($prenom)) echo $prenom; ?>"/>
  </div>
  <br>
  <div>
      <label for="mail">Mail&nbsp;:</label>
      <input type="text" name="mail" value="<?php if(isset($mail)) echo $mail; ?>"/>
  </div>
  <br>
  <div>
      <label for="mdp">Mot de passe&nbsp;:</label>
      <input type="password" name="mdp" />
  </div>
  <br>
  <div>
      <input type="reset" value="effacer"/>
      <input type="submit" value="envoyer"/>
  </div>
  <input type="hidden" name="frmRegistration"/>
</form>
