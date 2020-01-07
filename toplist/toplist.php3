<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?><HTML>
<head> 
<title>Toplist</title>
</head>

<?php
    include ("util.php3");
    if (connexion() > 0)
    { 
        $query = "SELECT * FROM paramlists WHERE nomlist = '$nomlist'";
	  /* echo ($query); */
        $data = mysql_query ($query);
	$param = mysql_fetch_object ($data);

 	echo ("<body bgcolor=");
	echo ($param->couleurfond);
	echo (" link=");
	echo ($param->couleurlien);
	echo (" vlink=");
	echo ($param->couleurlienvis);
	echo (">");

	echo ("<font color=");
	echo ($param->couleurtexte);
	echo (" size=");
	echo ($param->tailletexte);
	echo (" face=");
	echo ($param->fonte);
	echo (">");

	echo ("<h2>Toplist $nomlist</h2><p>");
	echo ("<a href=\"inscrip.php3?nomlist=$nomlist\">Webmasters, inscrivez votre site dans cette toplist</a>");
	echo ("<p><a href=\"modifi.php3?nomlist=$nomlist\">Modifiez votre inscription</a>");
      /* echo ("<p><a href=\"index.php3\">Vous aussi créez votre toplist</a>"); */
	echo ("<p><a href=\"index.php3\"><img src=image.gif alt=\"Vous aussi créez votre toplist\"></a>"); 

	echo ("<p><table border=1>");
	echo ("<tr><td>");
	echo ("<font color=");
        echo ($param->couleurtexte);
        echo (" size=");
        echo ($param->tailletexte);
        echo (" face=");
        echo ($param->fonte);
        echo (">");
	echo ("Site</td><td>");
	echo ("<font color=");
        echo ($param->couleurtexte);
        echo (" size=");
        echo ($param->tailletexte);
        echo (" face=");
        echo ($param->fonte);
        echo (">");
	echo ("Entrées</td><td>");
	echo ("<font color=");
        echo ($param->couleurtexte);
        echo (" size=");
        echo ($param->tailletexte);
        echo (" face=");
        echo ($param->fonte);
        echo (">");
        echo ("Sorties</td></tr>");

        $query = "SELECT * FROM toplist WHERE nomlist = '$nomlist' ORDER BY position";
        /* echo ($query); */
        $data = mysql_query ($query);
        while ($rec = mysql_fetch_object ($data))
        {
	    echo ("<tr><td>");

            /*
	    echo ("<tr><td bgcolor=");
            echo ($rec->couleurfond);
            echo (">");
            */
	    echo ("<font color=");
            echo ($param->couleurtexte);
            echo (" size=");
            echo ($param->tailletexte);
            echo (" face=");
            echo ($param->fonte);
            echo (">");
            
	    /*
	    echo ($rec->numero);
	    echo (" ");
	    echo ($rec->position);
	    echo (" ");
	    */
	    echo ("<a href=out.php3?numero=");
            echo ($rec->numero);
            echo (">");
            echo ("<img src=");
            echo ($rec->urlbanniere);
	    if ($rec->largeurbanniere > 0)
            {
		echo (" width=");
            	echo ($rec->largeurbanniere);
	    }
	    if ($rec->hauteurbanniere > 0)
	    {
            	echo (" height=");
            	echo ($rec->hauteurbanniere);
            }
            echo ("><br>");
       	
            /*echo ($rec->urlsite);*/
	    echo ($rec->titre);
            echo ("</a>");

            echo ("<br>");
            echo ($rec->description);
          
            echo ("</td>");
            echo ("<td>");
	    echo ("<font color=");
            echo ($param->couleurtexte);
            echo (" size=");
            echo ($param->tailletexte);
            echo (" face=");
            echo ($param->fonte);
            echo (">");
            echo ($rec->entrees);
            echo ("</td><td>");
	    echo ("<font color=");
            echo ($param->couleurtexte);
            echo (" size=");
            echo ($param->tailletexte);
            echo (" face=");
            echo ($param->fonte);
            echo (">");
            echo ($rec->sorties);
            echo ("</td></tr>");

        }

	echo ("</table>");

 	echo ("<p>");
	echo ("<a href=\"");
	echo ($param->urlsite);
	echo ("\">");
	echo ("<img src=");
	echo ($param->urlbanniere);
	if ($param->largeurbanniere > 0)
	{
		echo (" width=");
        	echo ($param->largeurbanniere);
	}
	if ($param->hauteurbanniere > 0)
	{
		echo (" height=");
        	echo ($param->hauteurbanniere);
        }
        echo ("></a>");

    }    

?>

</body>
</HTML>
