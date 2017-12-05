<!DOCTYPE html>  
<html>  
	<head>  
		<meta charset=utf-8 />  
		<title>Pictionnary - Inscription</title>
		<link rel="stylesheet" media="screen" href="css/styles.css" >		
		<script src="js/source.js"></script> 
	</head>  
	<body>
		<h2>Inscrivez-vous</h2>  
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
					<input type="text" name="prenom" id="prenom" placeholder="votre prénom" required />  
				</li>
				<li>  
					<label for="nom">Nom :</label>  
					<input type="text" name="nom" id="nom" required />  
				</li>
				<li>  
					<label for="nom">Téléphone :</label>  
					<input type="tel" name="tel" id="tel" />  
				</li>
				<li>  
					<label for="siteWeb">Site Web :</label>  
					<input type="url" name="siteWeb" id="siteWeb" />  
				</li>
				<li>  
					<label for="sexe">Sexe :</label><br />
					<ul>  
						<li><input type="radio" name="sexe" value="female" id="genre" > Female</li>
						<li><input type="radio" name="sexe" value="homme" id="genre" > Homme</li>
					</ul>
				</li>
				<li>  
					<label for="birthdate">Date de naissance :</label>  
					<input type="date" name="birthdate" id="birthdate" placeholder="JJ/MM/AAAA" required onchange="computeAge()"/>  
					<span class="form_hint">Format attendu "JJ/MM/AAAA"</span>  
				</li>  
				<li>  
					<label for="age">Age :</label>  
					<input type="number" name="age" id="age" disabled/>               
				</li>  
				<li>  
					<label for="ville">Ville :</label>  
					<input type="text" name="ville" id="ville" />  
				</li>
				<li>  
					<label for="taille">Taille en mètre :</label>  
					<input type="range" name="taille" id="taille" min="0" max="2.5" step="0.1"/>  
				</li>
				<li>  
					<label for="couleur">Couleur préférée :</label>  
					<input type="color" value="black" name="couleur" id="couleur" />  
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