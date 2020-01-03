<?php

 $platform = "lifebook";

 $prefix = "resc_";

 function get_local_url ()
 {
  return 'http://89.156.166.155/site/resc/';
 }

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
	/* $cnx = mysql_connect ("sql.olympe-network.com:3306", "philosophie", "weidosgnotis"); */
	$cnx = mysql_connect ("localhost", "root", "xanmo");
	if (! $cnx)
	{
		echo ("<p>Connexion à la base de données impossible<p>");
		return 0;
	}
	else
        {
	    /* echo ("<p>Connexion etablie"); */
	    $status = mysql_select_db ("res");
	    if ($status)
	    {
		  /* echo ("<p>Base de données selectionnee"); */
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
  $r = mysql_query ($q);
  if (!$r)
  {
   echo "<p>Erreur dans la requête:<p>" . $q;
   echo "<p>" . mysql_error();
  }
  return $r;
 }

 function fetch_object ($data) 
 {
  if ($data)
   return mysql_fetch_object ($data);
  else
   return 0;
 }

 function error ()
 {
  return mysql_error();
 }

?>
