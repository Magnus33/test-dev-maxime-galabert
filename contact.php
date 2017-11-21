<?php
include 'connectbdd.php';

if( isset($_POST['tel']) && isset($_POST['email']) ){
	$tel = $_POST['tel'];
	$email = $_POST['email'];

	if (isset($_POST['message'])) {
		$message = $_POST['message'];
	} else {
		$message = 'Pas de message';
	}

	if (isset($_POST['nom'])) {
		$nom = $_POST['nom'];
	} else {
		$nom = 'Anonyme';
	}

	// Test format email (redondant avec le javascript)
	/*
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Cet email est correct.';
	} else {
		echo 'Cet email a un format non adapté.';
	}
	*/

	// Test format téléphone
	/*
	if (preg_match('#^0[0-9]{9}$#', $tel)) {
	    echo 'Cet numéro de téléphone est correct.';
	} else {
	    echo 'Cet numéro de téléphone a un format non adapté.';
	}
	*/

	// Inscription du message en base de données
	$nom = $_POST['nom'];
	$tel = $_POST['tel'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$req = $con->prepare("INSERT INTO message (
							nom,
							tel,
							email,
							message
							)

						VALUES (
							:nom,
							:tel,
							:email,
							:message
							)")
						or die(mysql_error());

	$req->execute(array(
		'nom' => $nom,
		'tel' => $tel,
		'email' => $email,
		'message' => $message
		));


	// Envoi du mail

	$mail_destinataire = "info@bulko.net";

	//=====Vérification de l'adresse de destination.
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail_destinataire)) $passage_ligne = "\r\n"; else $passage_ligne = "\n";

	//=====Récupération du mail, du nom de l'expéditeur et du sujet.
	$mail_expediteur = $_POST["email"];
	$nom_expediteur = $_POST["nom"];
	$sujet = "Test Bulko";
	$phone = $_POST["tel"];

	//=====Déclaration des messages au format texte et au format HTML.
	$message_txt = "Cet e-mail à été envoyé depuis un script PHP.";

	$msg_body  = "<font color='#666666'><p>Mail de l'expéditeur : </font><strong>".$mail_expediteur."</strong><br>";
	$msg_body .= "<font color='#666666'>Nom de l'expéditeur : </font><strong>".$nom_expediteur."</strong><br>";
	$msg_body .= "<font color='#666666'>Telephone de l'expéditeur : </font><strong>".$phone."</strong></p>";
	$msg_body .= "<p><font color='#666666'>La personne ci-dessus à écrit un message sur le formulaire de contact de votre site.<br> Si vous désirez lui répondre, il vous suffit de répondre à ce message.<br> Voici le contenu de son message :</font></p><br>";

	$message_tape = htmlspecialchars($_POST["message"], ENT_QUOTES);
	$retourligne   = array("\r\n", "\n", "\r");
	$remplace = '<br/>';
	$msg_body .= "<p>".str_replace($retourligne, $remplace, $message_tape)."</p>";
	$msg_body = utf8_decode(stripslashes($msg_body));

	$message_html = "<html><head></head><body>".$msg_body."</body></html>";

		//=====Création de la boundary.
	$boundary = "-----=".md5(rand());
	$boundary_alt = "-----=".md5(rand());

		//=====Création du header de l'e-mail.
	$header = utf8_decode("From: ".$nom_expediteur." <".$mail_expediteur.">".$passage_ligne);
	$header.= "Reply-To: ".$nom_expediteur." <".$mail_expediteur.">".$passage_ligne;
	$header .= "MIME-Version: 1.0".$passage_ligne;
	$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

		//=====Création du message.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
	$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		//=====Ajout du message au format texte.
	$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;
		//==========

	$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

		//=====Ajout du message au format HTML.
	$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;
		//==========

		//=====On ferme la boundary alternative.
	$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
		//==========
	$message.= $passage_ligne."--".$boundary.$passage_ligne;

		//=====Envoi de l'e-mail.
		mail($mail_destinataire,$sujet,$message,$header);
		//==========
	echo "Success";
} else{
    echo "Failed";
}

?>
