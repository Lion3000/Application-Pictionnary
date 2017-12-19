<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8 />
		<title>Pictionnary - Inscription</title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="css/styles.css" >
		<link rel="stylesheet" href="css/handheld.css" >
		<script src="js/source.js"></script>
	</head>
	<body <?PHP if(isset($_GET['birthdate']) && !empty($_GET['birthdate'])) echo "onload=\"computeAge()\""; ?>>
		<?PHP include("header.php"); ?>
		<h2>Page Main</h2>
		<?PHP
		if(isset($_GET['erreur']) && !empty($_GET['erreur'])){
		?>
		<div id="erreur">
			<?PHP echo $_GET['erreur']; ?>
		</div>
		<?PHP
		}
		?>
    <div>
			<ol>
				<?PHP
				if(isset($_SESSION['user'])){
					try {
					    // Connect to server and select database.
					    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
							$sql = $dbh->query("SELECT id, picture FROM drawings WHERE id_user='".$user['id']."'");
							while ($result = $sql->fetch())
								echo "<li><a href=\"guess.php?id=".$result['id']."\" class=\"w3-btn w3-blue\" ><img src=\"".$result['picture']."\" /></a></li>";
					} catch (PDOException $e) {
					    print "Erreur !: " . $e->getMessage() . "<br/>";
					    $dbh = null;
					    die();
					}
				}
				?>
			</ol>
			<a href="paint.php" class="w3-btn w3-blue" >Commencer un dessin</a>
		</div>
	</body>
</html>
