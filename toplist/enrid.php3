<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
	include ("util.php3");
	include ("look.php3");
	/*$titre = "<HTML><body background=fond.gif><h2>Contrôle de l'identification</h2><p>";*/
	$titre = "<HTML>";
	/*echo ("Nom ($nom), password ($password) ");*/
		/*$cnx = mysql_connect ("localhost", "login", "password");*/
	//	$cnx = mysql_connect ("sql.free.fr", "servicetoplist", "ptqsd211");
	//if (! $cnx)
	//	echo ("<p>Connexion impossible<p>");
	//else
        {
 		/*mysql_select_db ("teledev_db")*/
		//mysql_select_db ("servicetoplist")
		//	or die ("Impossible d'accéder à la base teledev");

	    	$query = "SELECT * FROM users WHERE nomuser='$nomuser' AND password='$password'";
		$data = mysql_query ($query);
 	    	$rec = mysql_fetch_object ($data);
		if (!$rec)
		{
			echo ($titre);
			pageheader ("Contrôle de l'identification");
			/*echo ($query);*/
			/*echo ("Mot de passe incorrect<p>");*/
			echo ("Identification incorrecte<p>");
			echo ("<a href=ident.php3>Recommencer</a>");
			pageend ();
		}
		else
		{
                  setcookie ("rweb_nomuser");
                  setcookie ("rweb_password");
			setcookie ("rweb_nomuser", $nomuser);
			setcookie ("rweb_password", $password);
			echo ($titre);
			pageheader ("Contrôle de l'identification");
 			echo ("Identification correcte");
			echo ("<p><a href=index.php3>Retour au sommaire</a>");
			/*logevt ("ident", $nom);*/
			pageend ();
		}
	}

		 
?>



<!--/body-->

</HTML>

