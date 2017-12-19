<?php
session_start();
if(!isset($_SESSION['id'])) {
    header("Location: main.php");
} else {
 // ici, récupérer la liste des commandes dans la table DRAWINGS avec l'identifiant $_GET['id']
 // l'enregistrer dans la variable $commands
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
    <canvas id="myCanvas"></canvas>
  </body>
</html>
