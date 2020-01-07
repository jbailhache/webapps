<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Enregistrement de l'inscription</title>
</head>
<body>

<?php
    include ("util.php3");
    if (connexion() > 0)
    {
        $query = "SELECT * FROM paramlists WHERE nomlist = '$nomlist'";
        $data = mysql_query ($query);
	  $param = mysql_fetch_object ($data);

	  if ($titre1 != "")
	  {
		echo ("<p>Modification<p>");
		$query = "DELETE FROM toplist WHERE nomlist = '$nomlist' AND titre = '$titre1'";
		$r = mysql_query ($query);
		if (!$r)
		{
			echo ("Erreur dans la requête $query.");
		}
	  }

        $query = "INSERT INTO toplist (nomlist, nom, email, password, titre, urlsite, urlbanniere, largeurbanniere, hauteurbanniere, couleurfond, couleurtexte, tailletexte, fonte, description) VALUES ('$nomlist', '$nom', '$email', '$password', '$titre', '$urlsite', '$urlbanniere', $largeurbanniere, $hauteurbanniere, '$couleurfond', '$couleurtexte', '$tailletexte', '$fonte', '$description')";
        $r = mysql_query ($query);
        if (! $r)
        {
            echo ("Erreur dans la requete ");
            echo ($query);
        }
        else
        {
            echo ("Inscription enregistrée.");

            /*$query = "SELECT * FROM toplist WHERE email = '$email'";*/
		$query = "SELECT * FROM toplist WHERE nomlist = '$nomlist' AND titre = '$titre'"; 

            $data = mysql_query ($query);
            $rec = mysql_fetch_object ($data);

            echo ("Insérez le code suivant dans votre page :<br>");
            /*echo ("&lt;a href=http://teledev.multimania.com/ressource-web/in.php3?site=");*/
            echo ("&lt;a href=http://www.ressource-web.com/in.php3?site=");
            echo ($rec->numero);
            echo (" target=_blank&gt;<br>");
            /* echo ("&lt;img src=http://teledev.multimania.com/ressource-web/logo.gif border=0&gt;&lt;/a&gt;"); */
            echo ("&lt;img src=");
		echo ($param->urllogo);
		echo (" border=0&gt;&lt;/a&gt;");
	      echo ("<p><a href=index.php3>Retour au sommaire</a>");

        }    
    }
?>

</body>
</HTML>
