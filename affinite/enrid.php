<?php
 include ("util.php");
 $titre = "<HTML><head><title>Contr�le de l'identification</title></head><body>";
 //$cnx = mysql_connect ("localhost", "login", "password");
 connexion();
 //if (! $cnx)
 //               echo ("<p>Connexion impossible<p>");
 //else
 {
	//mysql_select_db ("teledev_db")
	//        or die ("Impossible d'acc�der � la base teledev");
	$req = mysql_query ("SELECT * FROM afinscr WHERE pseudo ='$pseudo' AND motdepasse ='$motdepasse'");
	$rec = mysql_fetch_object ($req);
	if (!$rec)
		{
			echo ($titre);
			echo ("Identification incorrecte<p>");
			echo ("<a href=ident.php>Recommencer</a>");
		}
	else
		{
			setcookie ("afpseudo");
			setcookie ("afmotdepasse");
			setcookie ("afpseudo", $pseudo);
			setcookie ("afmotdepasse", $motdepasse);
			echo ($titre);
			echo ("Identification correcte");
			echo ("<p><a href=affinite.php?action=inscription>D�crivez votre profil personnel</a>");
			echo ("<p><a href=affinite.php?action=recherche>D�crivez le profil que vous recherchez</a>");
			echo ("<p><a href=index.php>Retour au sommaire</a>");
			echo ("<p><a href=http://teledev.multimania.com/log/><b>log</b></a> - Ne passez pas � c�t� des choses compliqu�es ! ");

		}
 }
?>
</body>
</HTML>
