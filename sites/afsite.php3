<?php
	header('Content-Type: text/html; charset=ISO-8859-15');

function list_pages ($site, $rubrique1, $afpos)
{		
			$site1 = slashback ($site);
			$rubrique = backslash ($rubrique1);
			$pquery = "SELECT * FROM pages WHERE site = '$site' AND rubrique = '$rubrique' ORDER BY position";
			/*echo ($pquery); */
			$pdata = mysql_query ($pquery);
			echo ("<ul>");
			while ($prec = mysql_fetch_object ($pdata))
			{
				echo ("<li> ");
				if ($afpos == "on")
					echo ("$prec->position ");
				echo ("<a href=afpage.php3?site=");
				echo (urlencode($site1));
				echo ("&titre=");
				echo (urlencode($prec->titre));
				echo (">");
				echo ($prec->titre);
				echo ("</a>");				
			}
			echo ("</ul>");
}

	include ("util.php3");
	if (connexion() > 0)
	{
		echo ("<HTML><head><title>$site</title>");
		$query = "SELECT * FROM sites WHERE site = '$site'";
		/* echo ($query); */
		$data = mysql_query ($query);
		$rec = mysql_fetch_object ($data);
		echo ("<meta name=keywords content=\"");
		echo ($rec->motscles);
		echo ("\"></head>\n");
		echo ($rec->texte);
		/* echo (" afpos=$afpos "); */
		echo ("<p><ul>");
		$query = "SELECT * FROM rubriques WHERE site = '$site' ORDER BY position";
		$data = mysql_query ($query);
		while ($rec = mysql_fetch_object ($data))
		{
			echo ("<p><li> ");
			if ($afpos == "on")
				echo ("$rec->position ");
			$rubrique = $rec->rubrique;
			echo ($rubrique);			
			list_pages ($site, $rubrique, $afpos);
		}
		echo ("</ul>");
		echo ("</body></HTML>");
	}
?>

 
