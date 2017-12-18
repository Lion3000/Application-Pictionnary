<?PHP
$email=stripslashes($_POST['email']);
$password=stripslashes($_POST['password']);

try {
    // Connect to server and select database.
    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
    // V�rifier si un utilisateur avec cette adresse email existe dans la table.
    // En SQL: s�lectionner tous les tuples de la table USERS tels que l'email est �gal � $email.
    $sql = $dbh->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    if ($sql->rowCount() >= 1) {
      // ici d�marrer une session
      session_start();
      // on enregistre les paramètres importants et on redirige vers main.php
      $_SESSION["user"] =	serialize($sql->fetch());
      header("Location: main.php");
    }
    else{
      header("Location: main.php?"
  			."&erreur=".	urlencode("Le login ou mot de passe est incorrect!")
  		);
    }
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $dbh = null;
    die();
}
?>
