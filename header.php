<header class="w3-card-4 w3-margin w3-container">
<?PHP
session_start();
if(isset($_SESSION['user'])){
	$user = unserialize($_SESSION['user']);
?>
	<div>
		<h2>Bonjour <?PHP echo $user['nom'] . " " . $user['prenom']; ?></h2>
		<img  class="w3-margin" src="<?PHP echo $user['profilepic']; ?>" />
	</div>
	<nav class="w3-container w3-margin">
		<a href="logout.php" class="w3-btn w3-blue" >Déconnexion</a>
	</nav>
<?PHP
}
else{
?>
	<h2>Connectez-vous:</h2>
	<nav class="w3-container w3-margin">
		<form method="post" action="req_login.php">
			<label>Login email</label>
			<input class="w3-input" type="email" name="email">
			<label>Pot de passe</label>
			<input class="w3-input" type="password" name="password">
			<button class="w3-btn w3-blue w3-margin">Connexion</button>
		</form>
		<a href="inscription.php" class="w3-btn w3-blue" >Inscription</a>
	</nav>
<?PHP
}
?>
</header>
