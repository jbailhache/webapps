<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
	include("platform.php");
?>
<HTML>
<head>
<title>Création d'une toplist</title>
</head>
<!--
<body>
<h2>Création d'une toplist</h2>
-->

<?php
	include ("look.php3");
	if ($rweb_nomuser == "" || !$rweb_nomuser)
	{
		echo ("<body><a href=ident.php3>Identifiez-vous</a> d'abord si vous êtes inscrit, sinon <a href=inscrip.php3>inscrivez-vous</a>.</body>");
	}
	else
	{
		formheader ("Création d'une toplist", "enrlist.php3");
		/*echo ("<form method=post action=enrlist.php3>");*/
		echo ("<p>Nom de la toplist : <input type=text name=nomlist value=\"\">");
		echo ("<p>Logo : URL : <input type=text name=urllogo value=\"http://\" size=30>");
		echo (" Largeur <input type=text name=largeurlogo value=\"\" size=5>");
		echo (" Hauteur : <input type=text name=hauteurlogo value=\"\" size=5>");
		echo ("<p>URL de la bannière : <input type=text name=urlbanniere value=\"http://\" size=30>");
		
		echo (" Largeur : <input type=text name=largeurbanniere value=\"468\" size=5>");
		echo (" Hauteur : <input type=text name=hauteurbanniere value=\"60\" size=5>");
		
		echo ("<p>Couleur du fond : <input type=text name=couleurfond value=\"white\">");
		echo ("<p>Couleur du texte : <input type=text name=couleurtexte value=\"black\">");
		echo (" Taille du texte : <input type=text name=tailletexte value=\"3\" size=5>");
		echo (" Fonte : <input type=text name=fonte value=\"Arial\">");
		echo ("<p>Couleur des liens non visités : <input type=text name=couleurlien value=\"blue\">");
		echo (" visités : <input type=text name=couleurlienvis value=\"purple\">");
		echo ("<p><input type=submit value=Valider>");
		formend ();
	}
?>

<!--/body-->
</HTML>
