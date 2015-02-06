<?php
// Si le formulaire a été soumis
if (isset($_POST["submit"])){ 
	// On initialise notre etat à erreur, il sera changé à "ok" si la vérification du formulaire est un succès, sinon il reste à erreur
	$etat = "erreur"; 
	// On récupère les champs du formulaire, et on arrange leur mise en forme
	// trim()  enlève les espaces en début et fin de chaine
	// stripslashes()  retire les backslashes ==> \' devient '

	if (isset($_POST["nom"])) $_POST["nom"]=trim(stripslashes($_POST["nom"]));

	if (isset($_POST["prenom"])) $_POST["prenom"]=trim(stripslashes($_POST["prenom"]));

	if (isset($_POST["email"])) $_POST["email"]=trim(stripslashes($_POST["email"])); 
	
	elseif (empty($_POST["nom"])) {
		$erreur="Nous avons besoin de votre Nom pour vous r&eacute;pondre...";
	}

	if (empty($_POST["prenom"])) {
		$erreur="Nous avons besoin de votre Prénom pour vous r&eacute;pondre...";
	}elseif (empty($_POST["email"])) {
		$erreur="Nous avons besoin de votre e-mail pour vous r&eacute;pondre...";
	}elseif (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$",$_POST["son_email"])){ 
		$erreur="Votre adresse e-mail n'est pas valide...";
	}else { 
		$etat="ok";
	}	
}
// Sinon le formulaire n'a pas été soumis
else { 
	// On passe donc dans l'état attente
	$etat="attente"; 
}

if ($etat!="ok"){ 
	// Cas où le formulaire a été soumis mais il y a des erreurs
	if ($etat=="erreur"){ 
		// On affiche le message correspondant à l'erreur
		echo "<span style=\"color:red\">".$erreur."</span><br /><br />\n"; 
	}
}
// Sinon l'état est ok donc on envoie le mail
else { 
	$nom = $_POST["nom"]; 
	$prenom= $_POST["prenom"];
	$email = $_POST["email"];

	$mon_email = "***"; 
	$mon_pseudo = "Projet RED";

	$son_objet = "Inscription aux projet RED";

	$mon_url="Http://dfskdf.fr"
	

	$msg_pour_moi = "- Son Nom : ".$nom." \n 
	- Son Prénom : ".$prenom."  \n	
	- Son E-mail : ".$email." \n \n" 	

	// On prépare l'entête du message
	$entete = "From: " . $mon_pseudo . " <" . $mon_email . ">\n"; 
	$entete .='Content-Type: text/plain; charset="iso-8859-1"'."\n"; 
	$entete .='Content-Transfer-Encoding: 8bit';

	// Si le mail a été envoyé
	if (@mail($mon_email,$son_objet,$msg_pour_moi,$entete)){ 
		// On affiche un message de confirmation
		echo "<p style=\"text-align:center\">Votre message a &eacute;t&eacute; envoy&eacute;, vous recevrez une confirmation par mail.<br /><br />\n"; 
		// Avec un lien de retour vers l'accueil du site
		echo "<a href=\"" . $url_site . "\">Retour</a></p>\n"; 
	}
	// Sinon il y a eu une erreur lors de l'envoi
	else { 
		echo "<p style=\"text-align:center\">Un problème s'est produit lors de l'envoi du message.\n";
		// On propose un lien de retour vers le formulaire
		echo "<a href=\"" . $url_site. "\">Réessayez...</a></p>\n"; 
	}
}



	?>