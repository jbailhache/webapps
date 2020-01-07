
<?php
	include ("util.php");
	if (connexion() > 0)	
	{
		$query = "CREATE TABLE test6 (   numero int(11) NOT NULL auto_increment,   
nomuser varchar(120) NOT NULL,   password varchar(60) NOT NULL,   email varchar(60) NOT NULL,   urlsite varchar(120) NOT NULL,   KEY numero (numero, nomuser, password, email, urlsite))";
		$query1 = "CREATE TABLE test3 (numero int(11) NOT NULL, nom varchar(40) NOT NULL, key numero (numero, nom))";
		echo ($query);
		$r = mysql_query ($query);
		if (!$r)
			echo (" Erreur ");

	}
?>
