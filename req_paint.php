<?PHP
$drawingCommands=stripslashes($_POST['drawingCommands']);
$picture=stripslashes($_POST['picture']);

try {
    // Connect to server and select database.
    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');

    session_start();
    $user = unserialize($_SESSION['user']);
    if(isset($user['prenom'])) {
      $sql = $dbh->prepare(
        "INSERT INTO drawings (id_user, drawingCommands, picture) " .
        "VALUES (:id_user, :drawingCommands, :picture)"
      );
      $sql->bindValue(":id_user", $user['id']);
      $sql->bindValue(":drawingCommands", !empty($drawingCommands)?$drawingCommands:"NULL" );
      $sql->bindValue(":picture", !empty($picture)?$picture:"NULL");
      if (!$sql->execute()) {
          echo "PDO::errorInfo():<br/>";
          $err = $sql->errorInfo();
          print_r($err);
      }
      else
        header("Location: main.php");
    }
    else
      header("Location: main.php");

}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $dbh = null;
    die();
}
?>
