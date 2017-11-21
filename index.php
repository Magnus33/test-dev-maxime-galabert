<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>TestBulko - 2017</title>
	<meta name="viewport" content="user-scalable=no, initial-scale = 1, minimum-scale = 1, maximum-scale = 1, width=device-width">
	<link rel="icon" type="image/vnd.microsoft.icon" href="http://www.bulko.net/templates/img/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="http://www.bulko.net/templates/img/favicon.ico" />
	<link rel="stylesheet" href="https://cdn.bootcss.com/meyer-reset/2.0/reset.min.css">
	<link rel="stylesheet" href="./asset/css/styles.css">
</head>
<body>
	<style type="text/css">
	/* Style par défaut du bouton submit, appliqué au bouton ordinaire */
	input[type="button"] {
		width: auto;
		padding: 0.7rem 3rem;
		margin-top: 1.8rem;
		margin-bottom: 0;
		background: none;
		text-shadow: none;
		-webkit-box-shadow: none;
		box-shadow: none;
		background-color: #B4CC93;
		color: white;
		font-size: 1.5rem;
		font-weight: 600;
		text-align: left;
		-webkit-border-radius: 0;
		border-radius: 0;
		border: none;
		z-index: 1;
		overflow: hidden;
		cursor: pointer;
	}
	</style>
	<header>
		<div class="wrapper">
			<a class="logo-bulko" href="http://www.bulko.net/" title="Logo Agence Bulko"><img src="./asset/img/logoBulko.png" alt="Logo Agence Bulko" ></a>
			<a class="logo-github" href="https://github.com/Bulko/test-dev-bulko/blob/master/README.md" title="Lire les consignes" target="_blank" rel="noopener">
				<img src="./asset/img/github-icon.png" alt="Logo github">README.md
			</a>
		</div>
	</header>
	<main>
		<div id="confirmation" class="form-ok" style="display:none">Message envoyé</div>
		<div id="erreur" class="form-error" style="display:none">Veuillez remplir correctement les champs Email et Téléphone</div>
		<div id="erreurconnexion" class="form-error" style="display:none">Erreur de connexion</div>

		<form id="contactform" method="post">
			<p>Contactez-nous</p>
			<div class="form-part-1">
				<div class="form-control">
					<input id="nom" type="text" name="nom" placeholder="Nom"/>
				</div>
				<div class="form-control">
					<input id="email" type="email" name="email" placeholder="Email*" required/>
				</div>
				<div class="form-control">
					<input id="tel" type="tel" name="tel" placeholder="Téléphone*" required/>
				</div>
			</div>
			<div class="form-part-2">
				<div class="form-control">
					<textarea id="message" name="message" placeholder="Message"></textarea>
				</div>
				<input id="submit" type="button" value="Envoyer" />
			</div>
		</form>
	</main>
	<footer>
		<p>© Bulko - 2017<br>🦄  GLHF - Thank you</p>
	</footer>

	<!-- Scripts -->
	<script src="jquery-3.2.1.js"></script>
	<script src="validation.js"></script>
</body>
</html>
