<?php
 
//include ("../Php/connex.php3");

include ("platform.php");

function connexion1 ()
{
	$cnx = mysql_connect ("sql.free.fr", "teledev", "123s7sn1");
	if (! $cnx)
	{
		echo ("Connexion � la base de donn�es impossible<p>");
		return 0;
	}
	else
        {
	    echo ("<!--Connexion �tablie-->");
	    $status = mysql_select_db ("teledev");
	    if ($status)
	    {
		echo ("<!--Base de donn�es s�lectionn�e-->");
	        return 1;
            }
	    else
	    {
		echo ("Impossible d acceder a la base de donnees.");
		return 0;            
	    }
 	}
}

?>
