<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Cr�ation d'une page</title>
</head>
<body background=fond.gif>
<h3>Cr�ation d'une page</h3>
<p>
Chaque rubrique contient un certain nombre de pages qui sont affich�es dans la page d'accueil sous
cette rubrique, dans l'ordre des positions.
<p>
<form method=post action=enrpage.php3>
Nom du site : <!--input type=text name=site-->
<?php 
	include ("util.php3");
	select_site();
?>
<p>
Rubrique : <!-- input type=text name=rubrique-->
<?php select_rubrique(); ?>
<p>
Num�ro de position de la page dans la rubrique : <input type=text name=position><p>
Titre de la page : <input type=text name=titre size=60><p>
Mots cl�s : <input type=text name=motscles><p>
Tapez le texte de la page ci-dessous puis cliquez sur le bouton : &nbsp; &nbsp; &nbsp; 
<input type=submit value="Cr�er la page">
<p>
<textarea name=texte rows=20 cols=70>
</textarea>
<p>
Pour formater le texte de votre page, vous pouvez utiliser le langage HTML.
Pour apprendre ce langage, 
<a href=http://fr.dir.yahoo.com/Informatique_et_Internet/Information_et_documentation/Formats_de_donnees/HTML/Guides_et_didacticiels/>
cliquez ici</a>.
<p>
</form>
</body>
</HTML>


