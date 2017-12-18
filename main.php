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
    <div id="paint"></div>
	</body>
</html>
