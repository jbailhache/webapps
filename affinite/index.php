<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Affinit�</title>
<meta name=keywords content="rencontre,amour,affinit�">
</head>
<body>
<h3>Affinit�</h3>
<ul>
<p><li> <a href="present.htm">Pr�sentation</a>
<p><li> <a href="inscrip.php">Inscription</a>
<p><li> <a href="modinscr.php">Modification de vos informations</a>
<p><li> <a href="ident.php">Identification</a>
<p><li> <a href="affinite.php?action=inscription">D�crivez votre profil personnel</a>
<p><li> <a href="affinite.php?action=recherche">D�crivez le profil que vous recherchez</a>
<p><li> 
<?php
	include ("util.php");
	include ("utilaf.php");
	echo ("<form method=post action=modpro.php>");
	echo ("<input type=hidden name=action value=inscription>");
	echo ("<input type=submit value=Modifier>");
	echo (" votre description personnelle (nom du profil ");
	echo ("<input type=text name=profil>");
	echo (" le cas �ch�ant) pour ");
	selectbut();
	echo ("</form>");
	echo ("<p><li>");
 	echo ("<form method=post action=modpro.php>");
	echo ("<input type=hidden name=action value=recherche>");
	echo ("<input type=submit value=Modifier>");
	echo (" le profil que vous recherchez (nom du profil ");
	echo ("<input type=text name=profil>");
	echo (" le cas �ch�ant) pour ");
	selectbut();
	echo ("</form>");
?> 
<p><li> <a href="formrecn.php">Recherche de partenaires</a> -
<a href="formrech.php">(ancienne interface)</a>
<p><li> <a href="formaf.php">Calcul de l'affinit� entre deux profils</a>
<p><li> 
	<form method=post action=afinscr.php>
	<input type=submit value=Afficher>
	les informations concernant 
	<input type=text name=pseudo value='<?php echo ($afpseudo); ?>'>
	</form>
<p><li> <a href="list.php">Liste des inscrits</a>
<p><li> email : <a href=mailto:teledev@multimania.com>teledev@multimania.com</a>
<p><li> <a href="cv.rtf">CV de l'auteur</a>
<p><li> <a href="http://www.chez.com/log/affinite">Sources PHP</a>
</ul>
<p>
<a href="http://teledev.multimania.com/log/"><b>log</b></a> - 
Ne passez pas � c�t� des choses compliqu�es !
</body>
</HTML>
