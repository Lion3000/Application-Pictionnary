<?php
session_start();
$user = unserialize($_SESSION['user']);
if(!isset($user['prenom'])) {
    header("Location: main.php");
} else {
  // ici, récupérer la liste des commandes dans la table DRAWINGS avec l'identifiant $_GET['id']
  $id=stripslashes($_GET['id']);
  $commands="";
  try {
     // Connect to server and select database.
     $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
     $sql = $dbh->query("SELECT drawingCommands FROM drawings WHERE id='".$id."'");
     $result = $sql->fetch();
     // l'enregistrer dans la variable $commands
     if (isset($result['drawingCommands']) && !empty($result['drawingCommands']))
       $commands = $result['drawingCommands'];
  } catch (PDOException $e) {
     print "Erreur !: " . $e->getMessage() . "<br/>";
     $dbh = null;
     die();
  }

}

?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset=utf-8 />
      <title>Pictionnary</title>
      <link rel="stylesheet" media="screen" href="css/styles.css" >
      <script src="js/guess.js"></script>
  </head>
  <body>
    <div id="drawingCommands" style="display: none;"><?php echo $commands;?></div>
    <canvas id="myCanvas"></canvas>
  </body>
</html>
