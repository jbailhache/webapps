<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Enregistrement du vote</title>
</head>
<body>

<?php
    include ("util.php3");
    if (connexion() < 0)
        echo ("Erreur connexion");
    else
    {
        $query = "SELECT * FROM toplist WHERE numero = $numero";
        $data = mysql_query ($query);
        $rec = mysql_fetch_object ($data);
        if (!$rec)
            echo ("Erreur : site $numero non trouvé");
        else
        {
            $entrees = $rec->entrees + 1;
            $position = - ($entrees * 10 + $rec->sorties);
            $query = "UPDATE toplist SET entrees = $entrees WHERE numero = $numero";
		/*echo ($query);*/
		echo ("<p>");
            $r = mysql_query ($query);
		if (!$r)
			echo ("Erreur dans la requete $query.");
            $query = "UPDATE toplist SET position = $position WHERE numero = $numero";
		/*echo ($query);*/
            $r = mysql_query ($query);
		if (!$r)
			echo ("Erreur dans la requete $query.");
            echo ("Votre vote est enregistré");  
            echo ("<p><a href=index.php3>Toplists</a>");
        }    
    }

?>

</body>
</HTML>
