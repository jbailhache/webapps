<HTML>
<head>
<title>Identification</title>
</head>

<!--
<body>
<h2>Identification</h2>

<p>
Si vous n'êtes pas inscrit, <a href=insuser.php3>inscrivez-vous</a>.<p>

<form type="post" action="enrid.php3">

Nom :
<select name=nomuser>
-->
<?php
	include ("util.php3");
	include ("look.php3");
	if (connexion() > 0)
	{
		formheader ("Identification", "enrid.php3");

		echo ("Si vous n'etes pas encore inscrit, <a href=insuser.php3>inscrivez-vous</a>.<p>");

		/*
		echo ("Nom : <select name=nomuser>");
		echo ("<option selected>Sélectionnez votre nom");
	    	$req = mysql_query ("SELECT * FROM users ORDER BY nomuser");
 	    	while ($rec = mysql_fetch_object ($req))
	    	{
			echo ("<option>");
                 	echo ($rec->nomuser);
		}
		echo ("</select>");
		*/

		echo ("Nom : <input type=text name=nomuser value=\"\">");

		echo ("<p>Mot de passe : <input type=password name=password value=\"\"><p><input type=submit value=Valider>");
		formend ();
		
	}	
?>

<!--
</select>

<p>
Mot de passe :
<input type="password" name="password" value="">

<p>

<input type="submit" value="Valider">

</form>

</body>
-->
</HTML>
