<?php
 include ("config.php");
/*
 $platform = "lifebook";

 $prefix = "resa_";

 function get_local_url ()
 {
  return 'http://89.156.169.227/site/resa/';
 }
*/

 $platform = "platform";

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
	$cnx = mysql_connect (get_host(), get_user(), get_pass());
	if (! $cnx)
	{
		echo ("<p>Connexion à la base de données impossible<p>");
		return 0;
	}
	else
        {
	    /* echo ("<p>Connexion etablie"); */
	    $status = mysql_select_db (get_db());
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
   echo "<p>Erreur dans la requ&ecirc;te:<p>" . $q;
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
