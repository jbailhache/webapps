<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Modification d'un utilisateur</title>
</head>
<!--
<body>
<h2>Modification</h2>
-->

<?php
    include ("util.php3");
    include ("look.php3");
    if (connexion() > 0)
    {
      formheader ("Modification", "enruser.php3");
	if ($rweb_nomuser == "" || !$rweb_nomuser)
	{
		echo ("<a href=ident.php3>Identifiez-vous</a> d'abord si vous êtes inscrit, sinon <a href=inscrip.php3>inscrivez-vous</a>.");
	}
	else
	{
		$query = "SELECT * FROM users WHERE nomuser = '$rweb_nomuser'";
		$data = mysql_query ($query);
		$rec = mysql_fetch_object ($data);				

		/*echo ("<form method=post action=enruser.php3>");*/

		echo ("<input type=hidden name=op value=\"modif\">");

		echo ("<input type=hidden name=nomuser value=\"$rweb_nomuser\">");

		echo ("<p>Votre nom : ");
		echo ($rweb_nomuser);
		echo ("<p>Choisissez un mot de passe :");
		echo ("<input type=text name=password value=\"");
		echo ($rec->password);
		echo ("\">");
		echo ("<p>Votre adresse email : ");
		echo ("<input type=text name=email value=\"");
		echo ($rec->email);
		echo ("\">");
		echo ("<p>URL de votre site web : ");
		echo ("<input type=text name=urlsite value=\"");
		echo ($rec->urlsite);
		echo ("\" size=30>");

		echo ("<p><input type=submit value=Valider>");
		/*echo ("</form>");*/
		formend();
	}
    }
?>

<!--/body-->
</HTML>
