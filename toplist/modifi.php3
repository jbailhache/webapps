<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
	include ("util.php3");
?>
<HTML>
<head>
<title>Modification</title>
</head>
<body>
<h2>Modification d'un site</h2>
 
<form method="post" action="modif.php3">

<input type=hidden name=nomlist value=<?php echo($nomlist); ?>>

<?php

	if (connexion() > 0)
	{
		echo ("<select name=titre>");
		$query = "SELECT * FROM toplist WHERE nomlist = '$nomlist'";
		$data = mysql_query ($query);
		echo ("<option selected>Sélectionnez le site");
		while ($rec = mysql_fetch_object ($data))
		{
			echo ("<option>");
			echo ($rec->titre);
		} 
		echo ("</select>");
	}
?>

<p>Mot de passe : 
<input type=password name=password value="">

<p>
<input type=submit value=Valider>

</form>
</body>
</HTML>

 
 
