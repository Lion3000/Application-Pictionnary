<?php  
  
// récupérer les éléments du formulaire  
// et se protéger contre l'injection MySQL (plus de détails ici: http://us.php.net/mysql_real_escape_string)  
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
  
    // Vérifier si un utilisateur avec cette adresse email existe dans la table.  
    // En SQL: sélectionner tous les tuples de la table USERS tels que l'email est égal à $email.  
    $sql = $dbh->query("SELECT * FROM users WHERE email = '$email'");  
    if ($sql->rowCount() >= 1) {  
		$params = $sql->fetch(PDO::FETCH_BOTH);
		$paramsString = "";
		foreach($params as $param)
			//$paramsString .= 
			var_dump($param);
		//header("Location: main.php?".$params."erreur=".urlencode("L'utilisateur existe déjà!"));  
        // rediriger l'utilisateur ici, avec tous les paramètres du formulaire plus le message d'erreur  
        // utiliser à bon escient la méthode htmlspecialchars http://www.php.net/manual/fr/function.htmlspecialchars.php          // et/ou la méthode urlencode http://php.net/manual/fr/function.urlencode.php  
		
	}  
    else {  
        // Tenter d'inscrire l'utilisateur dans la base  
        $sql = $dbh->prepare("INSERT INTO users (email, password, nom, prenom, tel, website, sexe, birthdate, ville, taille, couleur, profilepic) "  
                . "VALUES (:email, :password, :nom, :prenom, :tel, :website, :sexe, :birthdate, :ville, :taille, :couleur, :profilepic)");  
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
        // idem pour la couleur, attention au format ici (7 caractères, 6 caractères attendus seulement)  
        // idem pour le prenom, tel, website  
        // idem pour le sexe, attention il faut être sûr que c'est bien 'H', 'F', ou ''  
  
        // on tente d'exécuter la requête SQL, si la méthode renvoie faux alors une erreur a été rencontrée.  
        if (!$sql->execute()) {  
            echo "PDO::errorInfo():<br/>";  
            $err = $sql->errorInfo();  
            print_r($err);  
        } 
		else {  
  
            // ici démarrer une session  
			session_start();
  
            // ensuite on requête à nouveau la base pour l'utilisateur qui vient d'être inscrit, et   
            $sql = $dbh->query("SELECT u.id, u.email, u.nom, u.prenom, u.couleur, u.profilepic FROM USERS u WHERE u.email='".$email."'");  
			
            if ($sql->rowCount()<1) 
                header("Location: main.php?erreur=".urlencode("un problème est survenu"));  
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