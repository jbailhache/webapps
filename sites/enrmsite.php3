<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Enregistrement de la modification du site</title>
</head>
<body>
<h3>Enregistrement de la modification du site</h3>
<p>

<?php
	include ("util.php3");
	if (connexion() > 0)
	{
		$query = "UPDATE sites SET motdepasse = '$motdepasse', texte = '$texte' WHERE site = '$site'";
 		$r = mysql_query ($query);
		if ($r)
			echo ("Site $site modifi�.");
		else
			echo ("Erreur dans la requ�te $query.");
	}
?>
 
<p><a href=gestion.php3>Retour au sommaire</a>

</body>
</HTML>
