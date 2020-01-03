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
	global $cnx;
	$cnx = mysqli_connect (get_host(), get_user(), get_pass());
	if (! $cnx)
	{
		echo ("<p>Connexion à la base de données impossible<p>");
		return 0;
	}
	else
        {
	    /* echo ("<p>Connexion etablie"); */
	    $status = mysqli_select_db ($cnx, get_db());
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
  global $cnx;
  $r = mysqli_query ($cnx, $q);
  if (!$r)
  {
   echo "<p>Erreur dans la requ&ecirc;te:<p>" . $q;
   echo "<p>" . mysqli_error();
  }
  return $r;
 }

 function fetch_object ($data) 
 {
  if ($data)
   return mysqli_fetch_object ($data);
  else
   return 0;
 }

 function error ()
 {
  global $cnx;
  return mysqli_error($cnx);
 }

?>
