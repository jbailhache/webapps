<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Cr�ation d'une rubrique</title>
</head>
<body background=fond.gif>
<h3>Cr�ation d'une rubrique</h3>
<p>
Chaque site contient un certain nombre de rubriques qui sont affich�es sur la page d'accueil
dans l'ordre des positions.
<p>

<form type=post action=enrrub.php3>
Nom du site : <!-- input type=text name=site-->

<?php
	include ("util.php3");
	select_site ();
?>
<p>
Nom de la rubrique : <input type=text name=rubrique size=40>
<p>
Num�ro de position de la rubrique dans la page d'accueil : <input type=text name=position>
<p>
<input type=submit value="Cr�er la rubrique">
</form>
</body>
</HTML>
