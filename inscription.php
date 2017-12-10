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
		<h2>Inscrivez-vous</h2>  
		<?PHP
		if(isset($_GET['erreur']) && !empty($_GET['erreur'])){
		?>
		<div id="erreur">
			<?PHP echo $_GET['erreur']; ?>
		</div>
		<?PHP
		}
		?>
		<form class="inscription" action="req_inscription.php" method="post" name="inscription">  
			<span class="required_notification">Les champs obligatoires sont indiqués par *</span>  
			<ul>  
				</li>  
				<li>  
					<label for="email">E-mail :</label>  
					<input type="email" name="email" id="email" autofocus required />            
					<span class="form_hint">Format attendu "name@something.com"</span>  
				</li>  
				<li>  
					<label for="prenom">Prénom :</label>  
					<input type="text" name="prenom" id="prenom" placeholder="votre prénom" required <?PHP if(isset($_GET['prenom']) && !empty($_GET['prenom'])) echo " value=\"".htmlspecialchars($_GET['prenom'])."\""; ?> />  
				</li>
				<li>  
					<label for="nom">Nom :</label>  
					<input type="text" name="nom" id="nom" required <?PHP if(isset($_GET['nom']) && !empty($_GET['nom'])) echo " value=\"".htmlspecialchars($_GET['nom'])."\""; ?> />  
				</li>
				<li>  
					<label for="tel">Téléphone :</label>  
					<input type="tel" name="tel" id="tel" <?PHP if(isset($_GET['tel']) && !empty($_GET['tel'])) echo " value=\"".htmlspecialchars($_GET['tel'])."\""; ?> />  
				</li>
				<li>  
					<label for="siteWeb">Site Web :</label>  
					<input type="url" name="website" id="website" <?PHP if(isset($_GET['website']) && !empty($_GET['website'])) echo " value=\"".htmlspecialchars($_GET['website'])."\""; ?> />  
				</li>
				<li>  
					<label for="sexe">Sexe :</label><br />
					<ul>  
						<li><input type="radio" name="sexe" value="F" id="genre" <?PHP  if(isset($_GET['sexe']) && $_GET['sexe'] == htmlspecialchars("F") ) echo "checked=checked"; ?> /> Female</li>
						<li><input type="radio" name="sexe" value="H" id="genre" <?PHP  if(isset($_GET['sexe']) && $_GET['sexe'] == htmlspecialchars("H") ) echo "checked=checked"; ?> /> Homme</li>
						
					</ul>
				</li>
				<li>  
					<label for="birthdate">Date de naissance :</label>
					<input type="date" name="birthdate" id="birthdate" placeholder="JJ/MM/AAAA" required onchange="computeAge()" <?PHP if(isset($_GET['birthdate']) && !empty($_GET['birthdate'])) echo " value=\"".htmlspecialchars($_GET['birthdate'])."\""; ?> />  
					
					<span class="form_hint">Format attendu "JJ/MM/AAAA"</span>  
				</li>  
				<li>  
					<label for="age">Age :</label>  
					<input type="number" name="age" id="age" disabled />               
				</li>  
				<li>  
					<label for="ville">Ville :</label>  
					<input type="text" name="ville" id="ville" <?PHP if(isset($_GET['ville']) && !empty($_GET['ville'])) echo " value=\"".htmlspecialchars($_GET['ville'])."\""; ?> />  
				</li>
				<li>  
					<label for="taille">Taille en mètre :</label>  
					<input type="range" name="taille" id="taille" min="0" max="2.5" step="0.1" <?PHP if(isset($_GET['taille']) && $_GET['taille'] >= 0) echo " value=\"".htmlspecialchars($_GET['taille'])."\""; ?> />  
				</li>
				<li>  
					<label for="couleur">Couleur préférée :</label>  
					<input type="color" name="couleur" id="couleur" value="#<?PHP if(isset($_GET['couleur']) && !empty($_GET['couleur'])) echo htmlspecialchars($_GET['couleur']); ?>" /> 
				</li>
				<li>  
					<label for="profilepicfile">Photo de profil :</label>  
					<input type="file" id="profilepicfile" onchange="loadProfilePic(this)"/>  
					<span class="form_hint">Choisissez une image.</span>  
					<input type="hidden" name="profilepic" id="profilepic"/>  
					<!-- l'input profilepic va contenir l'image redimensionnée sous forme d'une data url -->   
					<!-- c'est cet input qui sera envoyé avec le formulaire, sous le nom profilepic -->  
					<canvas id="preview" width="0" height="0"></canvas>  
					<!-- le canvas (nouveauté html5), c'est ici qu'on affichera une visualisation de l'image. -->  
					<!-- on pourrait afficher l'image dans un élément img, mais le canvas va nous permettre également   
					de la redimensionner, et de l'enregistrer sous forme d'une data url-->  
				</li>  
				<li>
					<label for="mdp1">Mot de passe :</label>  
					<input type="password" name="password" id="mdp1" pattern="\w{6,8}" onkeyup="validateMdp2()" placeholder = "votre mot de passe" title = "Le mot de passe doit contenir de 6 à 8 caractères alphanumériques." required>  
				   
					 <span class="form_hint">De 6 à 8 caractères alphanumériques.</span>  
				</li>  
				<li>  
					<label for="mdp2">Confirmez mot de passe :</label>  
					<input type="password" id="mdp2" required onkeyup="validateMdp2()" placeholder="retapez le mot de passe" required>   
					<span class="form_hint">Les mots de passes doivent être égaux.</span>  
				</li> 
				<li>  
					<input id="submit" type="submit" value="Soumettre Formulaire">  
				</li>  
			</ul>  
		</form>  
	</body>  
</html>  