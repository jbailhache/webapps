
<?php

/*
# PHP4u/admin MySQL-Dump
# http://www.multimania.fr/general/membre/php4u/admin/
#
# Basé sur PHPMyAdmin : http://phpwizard.net/phpMyAdmin/
# Base de données : teledev_db
# --------------------------------------------------------

#
# Structure de la table 'users'
#
*/

	include ("util.php3");
	if (connexion() > 0)
	{
		$query = "
CREATE TABLE users (
   numero int(11) NOT NULL auto_increment,
   nomuser varchar(120) NOT NULL,
   password varchar(60) NOT NULL,
   email varchar(60) NOT NULL,
   urlsite varchar(120) NOT NULL,
   KEY numero (numero, nomuser, password, email, urlsite)
)";
		echo ($query);
		$r = mysql_query ($query);
		if (!$r)
			echo ("<p>Erreur");
	}

?>
