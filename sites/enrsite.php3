<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Enregistrement du site</title>
</head>
<body>
<h3>Enregistrement du site</h3>

<?php
	include ("util.php3");
	if (connexion() > 0)
	{
		$query = "INSERT INTO sites (site, motdepasse, texte) VALUES ('$site', '$motdepasse', '$texte')";
		$r = mysql_query ($query);
		if (! $r)
		{
			echo ("Requ�te invalide : ");
			echo ($query);
		}
		else
		{
			echo ("Site $site cr��.");
		}
	}
?>

<p><a href=gestion.php3>Retour au sommaire</a>

</body>
</HTML>
