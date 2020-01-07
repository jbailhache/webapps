<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Gestion des sites</title>
</head>
<body background=fond.gif>
<h2>Gestion des sites</h2>
<p>
Ce service permet de cr�er facilement des sites web contenant plusieurs rubriques.
La page d'accueil de chaque site contient un texte de pr�sentation suivi des diff�rentes rubriques.
Sous chaque rubrique est affich�e la liste des pages rattach�es � cette rubrique.
Les liens permettant d'afficher les pages en cliquant sur le titre sont g�r�s automatiquement.

<p><a href="../sites6/gestion.php3">Ancienne version</a>
<p><a href="cresite.php3"><h4>Cr�ation d'un site</h4></a>
<p><h3>Modification d'un site :</h3>
<form method=post action=modsite.php3>
Nom du site : 
<?php
	include ("util.php3");
	select_site ();
?>
 &nbsp; 
<input type=submit value=Modifier>
</form>
<p><a href="crerub.php3"><h4>Cr�ation d'une rubrique</h4></a>
<p>Suppression d'une rubrique :
<form method=post action=suprub.php3>
Site :
<?php
 	select_site ();
	echo ("<br>Rubrique : ");
	select_rubrique ();	 
?>
 &nbsp; 
<input type=submit value=Supprimer>
</form>
<p><a href="crepage.php3"><h4>Cr�ation d'une page</h4></a>

<p>
<h3>Modification d'une page :</h3>
<form method=post action=modpage.php3>
Nom du site : <!--input type=text name=site-->
<?php
 	select_site();
?> 
<br>Titre de la page : <!--input type=text name=titre-->
<?php select_titre(); ?>
 &nbsp; 
<input type=submit value=Modifier>
</form>

<p>
<h3>Affichage d'un site :</h3>

<form method=post action=afsite.php3>

Afficher les positions
<input type=checkbox name=afpos> 
 &nbsp; 
Site :
<?php select_site (); ?> &nbsp; 
<input type=submit value=Afficher>
</form>

<p>

<?php
	/*include ("util.php3");*/
	if (connexion() > 0)
	{
		$query = "SELECT * FROM sites ORDER BY site";
		$data = mysql_query ($query);
		echo ("Liste des sites :<ul>");
		while ($rec = mysql_fetch_object ($data))
		{
			echo ("<li><a href=afsite.php3?site=");
			echo (urlencode($rec->site));
			echo (">");
			echo ($rec->site);
			echo ("</a>");
		}
		echo ("</ul>");
                echo ("Si le site que vous venez de cr�er n'appara�t pas dans cette liste, cliquez sur le bouton Actualiser, R�afficher ou Refresh de votre navigateur.");
	
	}
?>

<p>
<a href="http://www.chez.com/log/sites/sources.htm"><h4>Sources PHP</h4></a>
<p>
<a href="http://fr.dir.yahoo.com/Informatique_et_Internet/Information_et_documentation/Formats_de_donnees/HTML/Guides_et_didacticiels/">
<h4>Sites web pour apprendre le langage HTML</h4>
</a>

<h3>Remarques, questions et suggestions</h3>
<form method=post action=enrem.php3>
<textarea name=texte rows=10 cols=60>
</textarea>
<br>
<input type=submit value=Envoyer>
</form>



</body>
</HTML>


