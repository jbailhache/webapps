
<?php

function list_pages ($site, $rubrique)
{		
			$pquery = "SELECT * FROM pages WHERE site = '$site' AND rubrique = '$rubrique' ORDER BY position";
			/* echo ($pquery); */
			$pdata = mysql_query ($pquery);
			echo ("<ul>");
			while ($prec = mysql_fetch_object ($pdata))
			{
				echo ("<li> $prec->position <a href=afpage.php3?site=");
				echo (urlencode($site));
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
		echo ("<p><ul>");
		$query = "SELECT * FROM rubriques WHERE site = '$site' ORDER BY position";
		$data = mysql_query ($query);
		while ($rec = mysql_fetch_object ($data))
		{
			echo ("<p><li> $rec->position ");
			$rubrique = $rec->rubrique;
			echo ($rubrique);			
			list_pages ($site, $rubrique);
		}
		echo ("</ul>");
		echo ("</body></HTML>");
	}
?>

 