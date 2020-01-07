
<?php

/*
# PHP4u/admin MySQL-Dump
# http://www.multimania.fr/general/membre/php4u/admin/
#
# Basé sur PHPMyAdmin : http://phpwizard.net/phpMyAdmin/
# Base de données : teledev_db
# --------------------------------------------------------

#
# Structure de la table 'paramlists'
#
*/

	include ("util.php3");
	if (connexion() > 0)
	{
		$query = "
CREATE TABLE paramlists (
   numero int(11) NOT NULL auto_increment,
   nomlist varchar(120) NOT NULL,
   nomuser varchar(120) NOT NULL,
   urllogo varchar(120) NOT NULL,
   largeurlogo int(11) DEFAULT '0' NOT NULL,
   hauteurlogo int(11) DEFAULT '0' NOT NULL,
   urlbanniere varchar(120) NOT NULL,
   largeurbanniere int(11) DEFAULT '0' NOT NULL,
   hauteurbanniere int(11) DEFAULT '0' NOT NULL,
   couleurfond varchar(30) NOT NULL,
   couleurtexte varchar(30) NOT NULL,
   tailletexte int(11) DEFAULT '0' NOT NULL,
   fonte varchar(60) NOT NULL,
   ext tinyint(4) DEFAULT '0' NOT NULL,
   urlsite varchar(120) NOT NULL,
   couleurlien varchar(30) NOT NULL,
   couleurlienact varchar(30) NOT NULL,
   couleurlienvis varchar(30) NOT NULL,
   PRIMARY KEY (numero)
)";
		echo ($query);
		$r = mysql_query ($query);
		if (!$r)
			echo ("<p>Erreur");
	}

?>
