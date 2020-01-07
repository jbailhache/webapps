<HTML>
<head>
<title>Accès à un site</title>
</head>
<body>
<?php
    include ("util.php3");
    if (connexion() > 0)
    {
        $query = "SELECT * FROM toplist WHERE numero = $numero";
        $data = mysql_query ($query);
        $rec = mysql_fetch_object ($data);
        if (! $rec)
            echo ("Erreur : site $numero non trouvé");
        else
        {
            $sorties = $rec->sorties + 1;
		$entrees = $rec->entrees;
            $position = - (10 * $entrees + $sorties);
            $query = "UPDATE toplist SET sorties = $sorties WHERE numero = $numero";
            $r = mysql_query ($query);
            $query = "UPDATE toplist SET position = $position WHERE numero = $numero";
            $r = mysql_query ($query);

            echo ("<script language=JavaScript>");
            echo ("document.location = \"");
            echo ($rec->urlsite);
            echo ("\";");
            echo ("</script>");

        
        }
    }
?>
</body>
</HTML>
