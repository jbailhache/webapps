
<?php

	$cnx = mysql_connect ("sql.free.fr", "servicetoplist", "ptqsd211");
	if (! $cnx)
 	{
 		echo ("Connexion � la base de donn�es impossible<p>");
 		return 0;
 	}
 	else
      	{
 	    	echo ("Connexion �tablie");
	
		$status = mysql_select_db ("servicetoplist");
 	    	if ($status)
 	    	{
 		  	echo ("<p>Base de donn�es s�lectionn�e");
 	        }
 	    	else
 	    	{
 		  	echo ("<p>Impossible d acceder a la base de donnees.");
 		 
          	}
	}  	

 
?>
