<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Modification d'une toplist</title>
</head>
<!--
<body>

<form method=post action=modilist.php3>
-->

<?php
	include ("util.php3");
	include ("look.php3");
	if (connexion() > 0)
	{
		formheader ("Modification d'une toplist", "modilist.php3");
		if ($rweb_nomuser == "" || !$rweb_nomuser)
		{
			echo ("<a href=ident.php3>Identifiez-vous</a> d'abord si vous êtes inscrit, sinon <a href=inscrip.php3>inscrivez-vous</a>.");
		}
		else
		{
			$query = "SELECT * FROM paramlists WHERE nomuser = '$rweb_nomuser' ORDER BY nomlist";
			$data = mysql_query ($query);

			echo ("<select name=nomlist>");
			echo ("<option selected>Sélectionnez la liste à modifier");
			while ($rec = mysql_fetch_object ($data))
			{
				echo ("<option>");
				echo ($rec->nomlist);
			}
			echo ("</select>");
			echo ("<p><input type=submit value=Valider>");
		}
		formend ();
	}

?> 

</form>
</body>
</HTML>
