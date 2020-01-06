<?php

 $platform = "multimania";

 function init ($vars)
 {
  foreach ($vars as $var)
  {
   $instr = '$GLOBALS[\'' . $var . '\'] = $_POST[\'' .  $var . '\'];';
   echo "<li>eval [" . $instr . "]";
   eval ($instr);
  }
 }

 function connexion ()
 {
	$cnx = mysql_connect ("localhost", "login", "password");
	if (! $cnx)
	{
		echo ("Connexion à la base de données impossible<p>");
		return 0;
	}
	else
        {
	    echo ("<!--Connexion établie-->");
	    $status = mysql_select_db ("teledev_db");
	    if ($status)
	    {
		echo ("<!--Base de données sélectionnée-->");
	        return 1;
            }
	    else
	    {
		echo ("Impossible d acceder a la base de donnees.");
		return 0;            
	    }
 	}

 }

 function query ($q)
 {
  return mysql_query ($q);
 }

 function fetch_object ($data) 
 {
  return mysql_fetch_object ($data);
 }

 function error ()
 {
  return mysql_error();
 }

?>
