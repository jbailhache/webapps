<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
	include ("connexion.php3");
?>
<HTML>
<head>
<title>R�pondre</title>
</head>
<body>

<h3>R�pondre</h3>

<form method=post action=enreg.php3>

<input type=hidden name=table value="<?php echo ($table); ?>">

<input type=hidden name=discussion value="<?php
 $discussion1 = str_replace ("\\", "", $discussion); echo ($discussion1); ?>">

<input type=hidden name=position value=<?php echo ($position); ?>>

<input type=hidden name=possuiv value=<?php echo ($possuiv); ?>>

<?php
	/*echo ($texte);*/
	//include ("connexion.php3");
	if (connexion () > 0)
	{
		$query = "SELECT * FROM discussions WHERE discussion = '$discussion' AND position = $position";
		$data = mysql_query ($query);
		$rec = mysql_fetch_object ($data);
		if ($rec)
		{
			echo ("En r�ponse � ");
			echo ($rec->auteur);
			echo (" :<br>");
			echo ($rec->texte);
		}			
	}
?>

<p>Votre nom :
<input type=text name=auteur value="">



<p>Votre r�ponse :
<p>

<textarea name=texte rows=12 cols=60>
</textarea>

<p>
<input type=submit value=Valider>
</form>

</body>
</HTML>
