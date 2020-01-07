
<?php

/*
# PHP4u/admin MySQL-Dump
# http://www.multimania.fr/general/membre/php4u/admin/
#
# Basé sur PHPMyAdmin : http://phpwizard.net/phpMyAdmin/
# Base de données : teledev_db
# --------------------------------------------------------

#
# Structure de la table 'toplist'
#
*/

	include ("util.php3");
	if (connexion() > 0)
	{
		$query = "
CREATE TABLE toplist (
   numero int(11) NOT NULL  ,
   position int(11) DEFAULT '0' NOT NULL,
   nom varchar(120) NOT NULL,
   email varchar(60) NOT NULL,
   password varchar(60) NOT NULL,
   nomsite varchar(120) NOT NULL,
   urlsite varchar(120) NOT NULL,
   urlbanniere varchar(120) NOT NULL,
   largeurbanniere int(11) DEFAULT '0' NOT NULL,
   hauteurbanniere int(11) DEFAULT '0' NOT NULL,
   urllogo varchar(120) NOT NULL,
   largeurlogo int(11) DEFAULT '0' NOT NULL,
   hauteurlogo int(11) DEFAULT '0' NOT NULL,
   description text NOT NULL,
   couleurfond varchar(20) NOT NULL,
   couleurtexte varchar(20) NOT NULL,
   tailletexte varchar(4) NOT NULL,
   fonte varchar(60) NOT NULL,
   remarques varchar(120) NOT NULL,
   ext int(11) DEFAULT '0' NOT NULL,
   entrees int(11) DEFAULT '0' NOT NULL,
   sorties int(11) DEFAULT '0' NOT NULL,
   nomlist varchar(60) NOT NULL,
   titre varchar(120) NOT NULL,
   PRIMARY KEY (numero)
)";
		echo ($query);
		$r = mysql_query ($query);
		if (!$r)
			echo ("<p>Erreur");

	$query = "ALTER TABLE toplist CHANGE numero numero INT (11) DEFAULT '0' not null AUTO_INCREMENT ";
	echo ("<p>$query");
	$r = mysql_query ($query);
	if (!$r)
		echo ("<p>Erreur");

	}

?>
