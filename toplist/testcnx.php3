 
<?php
	include ("util.php3");
	if (connexion() > 0)
		echo ("Connexion établie");
	else
		echo ("Connexion impossible");
?>
