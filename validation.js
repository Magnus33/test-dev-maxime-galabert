$(document).ready(function(){

	// Surligne les champs mal remplis
	function surligne(champ, erreur){
		if(erreur)
	    	champ.style.backgroundColor = "#DE7575";
		else
	    	champ.style.backgroundColor = "#1A191E";
	}

	// Vérifie format email
	function verifMail(champ){
		var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
		if(!regex.test(champ.value)){
	    	surligne(champ, true);
	    	return false;
		} else{
	    	surligne(champ, false);
	    	return true;
		}
	}

	// Vérifie format téléphone
	function verifTel(champ){
		var regex = /^0[0-9]{9}$/;
		if(!regex.test(champ.value)){
	    	surligne(champ, true);
	    	return false;
		} else{
	    	surligne(champ, false);
	    	return true;
		}
	}

	// Vérifie le format du mail et du téléphone et exécute dynamiquement contact.php via Ajax
	function verifForm(f){
		var mailOk = verifMail(f.email);
		var telOk = verifTel(f.tel);
		var confirmation = document.getElementById('confirmation');
		var erreur = document.getElementById('erreur');
		var erreurconnexion = document.getElementById('erreurconnexion');

		if(mailOk && telOk){
			$.post(
				'contact.php',
				{
					email : $("#email").val(),
					nom : $("#nom").val(),
					tel : $("#tel").val(),
					message : $("#message").val()
				},

				function(data){
					if(data == 'Success'){
						confirmation.style.display = "block";
						erreur.style.display = "none";
						erreurconnexion.style.display = "none";
					}
					else{
						confirmation.style.display = "none";
						erreurconnexion.style.display = "block";
					}
				},
				'text'
			);
		}

		else{
			confirmation.style.display = "none";
			erreur.style.display = "block";
		}
	}

	$("#submit").click(function(){
		var contactform = document.getElementById('contactform')
	    verifForm(contactform);
	});

	$("#email").blur(function(){
	   verifMail(this);
	});

	$("#tel").blur(function(){
	   verifTel(this);
	});

});
