<?php

// r�cup�rer les �l�ments du formulaire
// et se prot�ger contre l'injection MySQL (plus de d�tails ici: http://us.php.net/mysql_real_escape_string)
$email=stripslashes($_POST['email']);
$password=stripslashes($_POST['password']);
$nom=stripslashes($_POST['nom']);
$prenom=stripslashes($_POST['prenom']);
$tel=stripslashes($_POST['tel']);
$website=stripslashes($_POST['website']);
$sexe='';
if (array_key_exists('sexe',$_POST)) {
    $sexe=stripslashes($_POST['sexe']);
}
$birthdate=stripslashes($_POST['birthdate']);
$ville=stripslashes($_POST['ville']);
$taille=stripslashes($_POST['taille']);
$couleur=stripslashes($_POST['couleur']);
$profilepic=stripslashes($_POST['profilepic']);

try {
    // Connect to server and select database.
    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');

    // V�rifier si un utilisateur avec cette adresse email existe dans la table.
    // En SQL: s�lectionner tous les tuples de la table USERS tels que l'email est �gal � $email.
    $sql = $dbh->query("SELECT * FROM users WHERE email = '$email'");
    if ($sql->rowCount() >= 1) {
		// rediriger l'utilisateur ici, avec tous les param�tres du formulaire plus le message d'erreur
		// utiliser � bon escient la m�thode htmlspecialchars http://www.php.net/manual/fr/function.htmlspecialchars.php          // et/ou la m�thode urlencode http://php.net/manual/fr/function.urlencode.php
  		header("Location: inscription.php?"
  			."&nom=".			htmlspecialchars($nom)
  			."&prenom=".		htmlspecialchars($prenom)
  			."&tel=".			htmlspecialchars($tel)
  			."&website=".		htmlspecialchars($website)
  			."&sexe=".			htmlspecialchars($sexe)
  			."&birthdate=".		htmlspecialchars($birthdate)
  			."&ville=".			htmlspecialchars($ville)
  			."&taille=".		htmlspecialchars($taille)
  			."&couleur=".		htmlspecialchars(str_replace('#', '', $couleur))
  			."&erreur=".		urlencode("L'utilisateur existe deja!")
  		);
  	}
    else {
        // Tenter d'inscrire l'utilisateur dans la base
        $sql = $dbh->prepare(
    			"INSERT INTO users (email, password, nom, prenom, tel, website, sexe, birthdate, ville, taille, couleur, profilepic) " .
                "VALUES (:email, :password, :nom, :prenom, :tel, :website, :sexe, :birthdate, :ville, :taille, :couleur, :profilepic)"
    		);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":password", $password);
        $sql->bindValue(":nom", empty($nom)?$nom:"NULL" );
        $sql->bindValue(":prenom", empty($prenom)?$prenom:"NULL");
        $sql->bindValue(":tel", empty($tel)?$tel:"NULL");
        $sql->bindValue(":website", empty($website)?$website:"NULL");
        $sql->bindValue(":sexe", empty($sexe)?$sexe:"NULL");
        $sql->bindValue(":birthdate", empty($birthdate)?$birthdate:"NULL");
        $sql->bindValue(":ville", empty($ville)?$ville:"NULL");
        $sql->bindValue(":taille", empty($taille)?$taille:"NULL");
        $sql->bindValue(":couleur", $couleur);
        $sql->bindValue(":profilepic", empty($profilepic)?$profilepic:"NULL");

        // n.b., notez: birthdate est au bon format ici, ce serait pas le cas pour un SGBD Oracle par exemple
        // idem pour la couleur, attention au format ici (7 caract�res, 6 caract�res attendus seulement)
        // idem pour le prenom, tel, website
        // idem pour le sexe, attention il faut �tre s�r que c'est bien 'H', 'F', ou ''

        // on tente d'ex�cuter la requ�te SQL, si la m�thode renvoie faux alors une erreur a �t� rencontr�e.
        if (!$sql->execute()) {
            echo "PDO::errorInfo():<br/>";
            $err = $sql->errorInfo();
            print_r($err);
        }
    		else {

          // ici d�marrer une session
    			session_start();

          // ensuite on requ�te � nouveau la base pour l'utilisateur qui vient d'�tre inscrit, et
          $sql = $dbh->query("SELECT u.id, u.email, u.nom, u.prenom, u.couleur, u.profilepic FROM USERS u WHERE u.email='".$email."'");

          if ($sql->rowCount()<1)
              header("Location: main.php?erreur=".urlencode("Un probl�me est survenu!"));
          else
			        $_SESSION["user"] =	serialize($sql->fetch());

          header("Location: main.php");
        }
        $dbh = null;
    }
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $dbh = null;
    die();
}
?>
