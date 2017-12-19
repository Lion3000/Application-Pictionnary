<?php
// on démarre la session, si l'utilisateur n'est pas connecté alors on redirige vers la page main.php.
session_start();
$user = unserialize($_SESSION['user']);
if(!isset($user['prenom'])) {
    header("Location: main.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset=utf-8 />
      <title>Pictionnary</title>
      <link rel="stylesheet" media="screen" href="css/styles.css" >
      <script src="js/paint.js"></script>
  </head>
  <body>
    <canvas id="myCanvas"></canvas>

    <form name="tools" action="req_paint.php" method="post">
        <!-- ici, insérez un champs de type range avec id="size", pour choisir un entier entre 0 et 4) -->
        <input type="range" name="size" id="size" min="0" max="4" step="1" />
        <!-- ici, insérez un champs de type color avec id="color", et comme valeur l'attribut  de session couleur (à l'aide d'une commande php echo).) -->
        <input type="color" name="color" id="color" value="#<?PHP echo $user['couleur']; ?>" />

        <input id="restart" type="button" value="Recommencer"/>
        <input type="hidden" id="drawingCommands" name="drawingCommands"/>
        <input type="hidden" id="picture" name="picture"/>
        <input id="validate" type="submit" value="Valider"/>
    </form>
  </body>
</html>
