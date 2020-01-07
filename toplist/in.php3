<HTML>
<head>
<title>Vote</title>
</head>
<body>

<?php
    include ("util.php3");
    if (connexion() > 0)
    {
        $query = "SELECT * FROM toplist WHERE numero = $site"; 
        $data = mysql_query ($query);
        $rec = mysql_fetch_object ($data);
        if (!$rec)
            echo ("Erreur, site $site non trouvé");
        else
        {
            echo ("Vous allez voter pour ");
            echo ($rec->titre);
            echo ("<p><a href=votein.php3?numero=$site>Cliquez ici pour voter</a>");
        
        }
    }
?>

</body>
</HTML>
