<?php

 $platform = "olympe";

 function initv ($vars)
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
	$cnx = mysql_connect ("sql.olympe-network.com:3306", "philosophie", "sapientia");
	if (! $cnx)
	{
		echo ("<p>Connexion � la base de donn�es impossible<p>");
		return 0;
	}
	else
        {
	    /* echo ("<p>Connexion etablie"); */
	    $status = mysql_select_db ("philosophie");
	    if ($status)
	    {
		  /* echo ("<p>Base de donn�es selectionnee"); */
	        return 1;
            }
	    else
	    {
		echo ("<p>Impossible d acceder a la base de donnees.");
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
