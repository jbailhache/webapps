<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Enregistrement de la rubrique</title>
</head>
<body>
<h3>Enregistrement de la rubrique</h3>

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
			$query = "INSERT INTO rubriques (site, rubrique, position) VALUES ('$site', '$rubrique', $position)";
			$r = mysql_query ($query);
			if (! $r)
			{
				echo ("Requ�te invalide : ");
				echo ($query);
			}
			else
			{
				echo ("Rubrique $rubrique cr��e.");
			}
		}
	}
?>

<p><a href=gestion.php3>Retour au sommaire</a>

</body>
</HTML>
