<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
	include("platform.php");
?>
<HTML>
<head>
<title>Cr�ation d'un site</title>
</head>
<body background=fond.gif>
<h3>Cr�ation d'un site</h3>
<p>
Choisissez le nom de votre site et un mot de passe que vous devrez retenir et
qui vous sera demand� pour toute modification de votre site. <p>
Tapez un texte de pr�sentation qui sera affich� en haut de la page d'accueil 
de votre site, puis cliquez sur le bouton Cr�er.
<p>

<form method=post action="enrsite.php3">
Nom du site : <input type=text name=site>
<p>
Mot de passe : <input type=text name=motdepasse>
<p>
Tapez le texte de pr�sentation ci-dessous puis cliquez sur ce bouton :
 &nbsp; &nbsp; &nbsp; 
<input type=submit value="Cr�er le site">
<p>
<textarea name=texte rows=20 cols=70>
</textarea>
<p>

</form>
</body>
</HTML>
