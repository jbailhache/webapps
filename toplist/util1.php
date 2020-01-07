<?php
  
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

function mydate () 
{ 	
	$date = date ("D d M Y, H:i");
 	return $date;
 
}  

function logevt ($typ, $message) 
{ 	/* $date = date ("D d M Y, H:i"); */ 	
	$date = mydate(); 	
	$query = "INSERT INTO log (date, typ, message) VALUES ('$date', '$typ', '$message')";
 	$status = mysql_query ($query);
}  

function echopart ($nom) 
{ 	
	$nomurl = urlencode ($nom);
 	echo ("<a href=detpart.php?nom=$nomurl>");
 	echo ($nom);
 	echo ("</a>");
 
}  

function urlsite ()
{
	return "http://teledev.multimania.com/ressource-web/";
}



?>