<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Enregistrement de la page</title>
</head>
<body>
<h3>Enregistrement de la page</h3>

<?php
	include ("util.php3");
	if (connexion() > 0)
	{
		$query = "SELECT * FROM sites WHERE site = '$site'";
		$data = mysql_query ($query);
		$rec = mysql_fetch_object ($data);
		if ($motdepasse != $rec->motdepasse)
			echo ("<p>Mot de passe incorrect.<p>");
		else
		{
		    if (($modif == "yes") && ($create != "on"))
		    {
			$query = "DELETE FROM pages WHERE site = '$site1' AND titre = '$titre1'";
			$r = mysql_query ($query);
			if (!$r)
				echo ("<p>Erreur dans la requ�te $query.<p>");
			else
				echo ("<p>Page $titre1 effac�e.<p>");
		    }
		    if (($modif != "yes") || ($delete != "on"))
		    {
			$query = "INSERT INTO pages (site, rubrique, position, titre, motscles, head, attributs, texte) VALUES ('$site', '$rubrique', $position, '$titre', '$motscles', '$head', '$attributs', '$texte')";
			/*echo ($query);*/
			$r = mysql_query ($query);
			if (! $r)
			{
				echo ("Requ�te invalide : ");
				echo ($query);
			}
			else
			{
				echo ("Page $titre enregistr�e.");
			}
		    }
		}
	}
?>

<p><a href=gestion.php3>Retour au sommaire</a>

</body>
</HTML>
