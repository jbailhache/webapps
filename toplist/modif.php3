<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Modification</title>
</head>
<body>
<h2>Modification d'un site sur la toplist</h2>

<form method="post" action="enreg.php3">

<input type=hidden name=nomlist value=<?php echo($nomlist); ?>>

<?php
	include ("util.php3");
	if (connexion() > 0)
	{
		$query = "SELECT * FROM toplist WHERE nomlist = '$nomlist' AND titre = '$titre' AND password = '$password'";
		$data = mysql_query ($query);
		$rec = mysql_fetch_object ($data);
		if (!$rec)
		{
			echo ("Mot de passe incorrect");
		}
		else
		{
			echo ("<input type=hidden name=titre1 value=\"$titre\">");

			echo ("Votre nom :");
			echo ("<input type=text name=nom value=\"");
			echo ($rec->nom);
			echo ("\"><p>Mot de passe :");
			echo ("<input type=text name=password value=\"");
			echo ($rec->password);
			echo ("\"><p>Adresse email :");
			echo ("<input type=text name=email value=\"");
			echo ($rec->email);
			echo ("\"><p>Titre du site :");
			echo ("<input type=text name=titre value=\"");
			echo ($rec->titre);
			echo ("\"><p>URL du site :");
			echo ("<input type=text name=urlsite value=\"");
			echo ($rec->urlsite);
			echo ("\"><p>Bannière publicitaire : URL ");
			echo ("<input type=text name=urlbanniere value=\"");
			echo ($rec->urlbanniere);
			echo ("\"> largeur ");
			echo ("<input type=text name=largeurbanniere value=");
			echo ($rec->largeurbanniere);
			echo ("> hauteur ");
			echo ("<input type=text name=hauteurbanniere value=");
			echo ($rec->hauteurbanniere);
			echo ("><p>Description du site :<br>");
			echo ("<textarea name=description rows=6 cols=40>");
			echo ($rec->description);
			echo ("</textarea>");
			echo ("<p><input type=submit value=Valider>");
		}
	}
?>

</form>
</body>
</HTML>


 
