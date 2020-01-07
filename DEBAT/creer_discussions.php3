
<?php

	include ("connexion.php3");

	if (connexion() > 0)
	{
		mysql_query ("CREATE TABLE discussions (numero INTEGER PRIMARY KEY autoincrement, statut INTEGER, discussion VARCHAR(45) not null, position FLOAT not null, reponsea FLOAT not null, date VARCHAR(30) not null, auteur VARCHAR(40) not null, texte TEXT not null)");
	}

?>
