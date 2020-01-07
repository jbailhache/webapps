<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Modification d'une toplist</title>
</head>
<!--
<body>
<h2>Modification d'une toplist</h2>
-->

<?php
    include ("util.php3");
    include ("look.php3");
    if (connexion() > 0)
    {
      
	if ($rweb_nomuser == "" || !$rweb_nomuser)
	{
		echo ("<body><a href=ident.php3>Identifiez-vous</a> d'abord si vous êtes inscrit, sinon <a href=inscrip.php3>inscrivez-vous</a>.</body>");
	}
	else
	{
	  formheader ("Modification d'une toplist", "enrlist.php3");

        $query = "SELECT * FROM paramlists WHERE nomlist = '$nomlist' AND nomuser = '$rweb_nomuser'";
        $data = mysql_query ($query);
        $rec = mysql_fetch_object ($data);

        if (!$rec)
        {
         echo ("Erreur : liste $nomlist non trouvée");
        }
        else
        {

		/*echo ("<form method=post action=enrlist.php3>");*/
            echo ("<input type=hidden name=op value=\"modif\">");
		echo ("<p>Nom de la toplist : <input type=text name=nomlist value=\"$nomlist\">");
		echo ("<p>Logo : URL : <input type=text name=urllogo value=\"");
		echo ($rec->urllogo);
		echo ("\" size=30>");
		echo (" Largeur <input type=text name=largeurlogo value=\"");
		echo ($rec->largeurlogo);
		echo ("\" size=5>");
		echo (" Hauteur : <input type=text name=hauteurlogo value=\"");
		echo ($rec->hauteurlogo);
		echo ("\" size=5>");
		echo ("<p>URL de la bannière : <input type=text name=urlbanniere value=\"");
		echo ($rec->urlbanniere);
		echo ("\" size=30>");
		
		echo (" Largeur : <input type=text name=largeurbanniere value=\"");
		echo ($rec->largeurbanniere);
		echo ("\" size=5>");
		echo (" Hauteur : <input type=text name=hauteurbanniere value=\"");
		echo ($rec->hauteurbanniere);
		echo ("\" size=5>");
		
		echo ("<p>Couleur du fond : <input type=text name=couleurfond value=\"");
		echo ($rec->couleurfond);
		echo ("\">");
		echo ("<p>Couleur du texte : <input type=text name=couleurtexte value=\"");
		echo ($rec->couleurtexte);
		echo ("\">");
		echo (" Taille du texte : <input type=text name=tailletexte value=\"");
		echo ($rec->tailletexte);
		echo ("\" size=5>");
		echo (" Fonte : <input type=text name=fonte value=\"");
		echo ($rec->fonte);
		echo ("\">");
		echo ("<p>Couleur des liens non visités : <input type=text name=couleurlien value=\""); 
		echo ($rec->couleurlien);
		echo ("\">");
		echo (" visités : <input type=text name=couleurlienvis value=\"");
		echo ($rec->couleurlienvis); 
		echo ("\">");

		echo ("<p><input type=submit value=Valider>");
		
		formend();
 
        } 
	}
     
    }
?>

<!--/body-->
</HTML>
