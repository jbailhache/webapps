<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Enregistrement d'un utilisateur</title>
</head>
<!--body-->

<?php
	include ("util.php3");
	include ("look.php3");

	if (connexion () > 0)
	{
	    pageheader ("Enregistrement de votre inscription");
	    $query = "SELECT * FROM users WHERE nomuser = '$nomuser'";
	    $data = mysql_query ($query);
	    $rec = mysql_fetch_object ($data);
          $ok = 0;
          if ($rec)
	    {
            if ($op != "modif")
			echo ("Ce nom est d�ja enregistr�. Choisissez-en un autre.");
            else
		{
			$ok = 1;
			$query = "DELETE FROM users WHERE nomuser = '$nomuser'";
			$r = mysql_query ($query);
			if (!$r)
				echo ("Erreur dans la requ�te $query.");
		}
 	    }
	    else
	    {
		if ($op == "modif")
			echo ("Erreur : Utilisateur $nomuser non trouv�");
		else
		{
			$ok = 1;		
		}
	    }
		
          if ($ok > 0)
          {
		$query = "INSERT INTO users (nomuser, password, email, urlsite) VALUES ('$nomuser', '$password', '$email', '$urlsite')";
 		$r = mysql_query ($query);
		if (! $r)
		{
			echo ("Erreur dans la requete $query.");
		}
		else
		{
			echo ("Votre inscription est enregistr�e.");
			echo ("<p><a href=index.php3>Retour au sommaire</a>");
		}
	    }	    
	    pageend ();
	}
?>

</body>
</HTML>
