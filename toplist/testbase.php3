
<?php

	$cnx = mysql_connect ("sql.free.fr", "servicetoplist", "ptqsd211");
	if (! $cnx)
 	{
 		echo ("Connexion à la base de données impossible<p>");
 		return 0;
 	}
 	else
      	{
 	    	echo ("Connexion établie");
	
		$status = mysql_select_db ("servicetoplist");
 	    	if ($status)
 	    	{
 		  	echo ("<p>Base de données sélectionnée");
 	        }
 	    	else
 	    	{
 		  	echo ("<p>Impossible d acceder a la base de donnees.");
 		 
          	}
	}  	

 
?>
