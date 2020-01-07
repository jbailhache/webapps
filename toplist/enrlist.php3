<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Enregistrement d'une toplist</title>
</head>
<!--body-->

<?php
	include ("util.php3");
	include ("look.php3");
	if (connexion() > 0)
	{
	    pageheader ("Enregistrement de votre toplist");

	    $query = "SELECT * FROM paramlists WHERE nomlist = '$nomlist'";
	    $data = mysql_query ($query);
	    $rec = mysql_fetch_object ($data);
	    $ok = 0;

	    if ($rec)
	    {
		if ($op != modif)
			echo ("La liste $nomlist exixte déja. Choisissez un autre nom.");
		else
		{
			$ok = 1;
			$query = "DELETE FROM paramlists WHERE nomlist = '$nomlist' AND nomuser = '$rweb_nomuser'";
			$r = mysql_query ($query);
			if (!$r)
				echo ("Erreur dans la requête $query.");
		}
	    }
	    else
	    {
			if ($op == "modif")
				echo ("Erreur : liste $nomlist non trouvée.");
			else
			{
				$ok = 1;
			}
	    }
	    if ($ok)
	    {
		$query = "SELECT * FROM users WHERE nomuser = '$rweb_nomuser'";
		$data = mysql_query ($query);
		$rec = mysql_fetch_object ($data);
		if (!$rec)
		{
			echo ("<a href=ident.php3>Identifiez-vous</a> d'abord.");
	        }
		else
		{
			$urlsite = $rec->urlsite;

                        if ($largeurlogo == "")
                            $largeurlogo = "0";
                        if ($hauteurlogo == "")
                            $hauteurlogo = "0";
                        if ($largeurbanniere == "")
                            $largeurbanniere = "0";
                        if ($hauteurbanniere == "")
                            $hauteurbanniere = "0";
                        
			$query = "INSERT INTO paramlists (nomlist, nomuser, urlsite, urllogo, largeurlogo, hauteurlogo, urlbanniere, largeurbanniere, hauteurbanniere, couleurfond, couleurtexte, tailletexte, fonte, couleurlien, couleurlienvis) VALUES ('$nomlist', '$rweb_nomuser', '$urlsite', '$urllogo', $largeurlogo, $hauteurlogo, '$urlbanniere', $largeurbanniere, $hauteurbanniere, '$couleurfond', '$couleurtexte', $tailletexte, '$fonte', '$couleurlien', '$couleurlienvis')";
			$r = mysql_query ($query);
			if (!$r)
				echo ("Erreur dans la requête $query.");
			else
			{
	                    echo ("Votre toplist est enregistrée.");
                            echo ("<p><a href=index.php3>Retour au sommaire</a>");
                        }
  		}
	    }
	    pageend ();	
	}
?>

</body>
</HTML>
