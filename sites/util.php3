<?php

//include ("../Php/connex.php3");

include("platform.php");

function connexion1 ()
{
	$cnx = mysql_connect ("localhost", "login", "password");
	if (! $cnx)
	{
		echo ("Connexion � la base de donn�es impossible<p>");
		return 0;
	}
	else
        {
	    echo ("<!--Connexion �tablie-->");
	    $status = mysql_select_db ("teledev_db");
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

function verif_motdepasse ()
{
		$query = "SELECT * FROM sites WHERE site = '$site'";
		$data = mysql_query ($query);
		$rec = mysql_fetch_object ($data);
		if ($motdepasse != $rec->motdepasse)
		{
			echo ("<p>Mot de passe incorrect.<p>");
			return false;
		}
		else
		{	
			echo ("<p>Mot de passe correct. $motdepasse = $rec->motdepasse <p>");
			return true;
		}

}

function select_site ()
{
	if (connexion() > 0)
	{
		echo ("<select name=site>");
		echo ("<option selected>S�lectionnez le site");
		$query = "SELECT * FROM sites ORDER BY site";
		$data = mysql_query ($query);
		while ($rec = mysql_fetch_object ($data))
		{
			echo ("<option>$rec->site");
		}
		echo ("</select>");		
		echo (" &nbsp; Mot de passe : <input type=password name=motdepasse> ");
                echo ("<br>Si le site que vous venez de cr�er n'appara�t pas dans la liste, cliquez sur le bouton Actualiser ou R�afficher ou Refresh de votre navigateur.");
	}	
}

function select_rubrique ()
{
	if (connexion() > 0)
	{
		echo ("<select name=rubrique>");
		echo ("<option selected>S�lectionnez la rubrique");
		$query = "SELECT * FROM rubriques ORDER BY rubrique";
		$data = mysql_query ($query);
		while ($rec = mysql_fetch_object ($data))
		{
			echo ("<option>$rec->rubrique");
		}
		echo ("</select>");		
	        echo ("<br>S�lectionnez une rubrique que vous avez cr��e dans votre site. Si la rubrique que vous venez de cr�er n'appara�t pas dans la liste, cliquez sur le bouton Actualiser ou R�afficher ou Refresh de votre navigateur.");

	}
}

function select_titre ()
{
	if (connexion() > 0)
	{
		echo ("<select name=titre>");
		echo ("<option selected>S�lectionnez le titre de la page");
		$query = "SELECT * FROM pages ORDER BY titre";
		$data = mysql_query ($query);
		while ($rec = mysql_fetch_object ($data))
		{
			echo ("<option>$rec->titre");
		}
		echo ("</select>");		
	}
}
function mydate ()
{
	$date = date ("D d M Y, H:i");
	return $date;
}

function logevt ($typ, $message)
{
	/* $date = date ("D d M Y, H:i"); */
	$date = mydate();
	$query = "INSERT INTO log (date, typ, message) VALUES ('$date', '$typ', '$message')";
	$status = mysql_query ($query);	
}

function echopart ($nom)
{
	$nomurl = urlencode ($nom);
	echo ("<a href=detpart.php3?nom=$nomurl>");
	echo ($nom);
	echo ("</a>");
}

function slashback ($s)
{
 return str_replace ("\\", "", $s);
}

function backslash ($s)
{
 return str_replace ("'", "\\'", $s);
}

?>
