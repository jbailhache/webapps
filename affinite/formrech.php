<HTML>
<head>
<title>Recherche de partenaire</title>
</head>
<body>
<h3>Recherche de partenaire</h3>

Ceci permet d'obtenir une liste de profils tri�s par affinit� (en fonction du but indiqu�) d�croissante par rapport � un profil de r�f�rence 
(normalement le v�tre mais vous pouvez aussi en indiquer un autre).
<p>
<form method=post action=recherch.php>
But :
<?php
   include ("util.php");
   if (connexion () > 0)
   {
    echo ("<select name=but>");
    $query = "SELECT * FROM afbut";
    $data = mysql_query ($query);
    while ($rec = mysql_fetch_object ($data))
    {
     $butvar = varencode ($rec->but);
     /*echo ("<li><input type=checkbox name=$butvar value=yes> $rec->but");*/
     echo ("<option>$rec->but");
    }
   }
 echo ("</select><p>Profil de r�f�rence : ");
 echo ("<br>Pseudo : <input type=text name=pseudo value=\"$afpseudo\">");
 echo ("<br>Nom du profil (le cas �ch�ant) : <input type=text name=profil>");
 echo ("<br><input type=radio name=action value=inscription> description personnelle ou ");
 echo (    "<input type=radio name=action value=recherche checked> profil recherch� ");
 echo ("<p>Profils tri�s : ");
 echo ("<br><input type=radio name=actiont value=inscription checked> description personnelle ou ");
 echo (    "<input type=radio name=actiont value=recherche> profil recherch� ");
 echo ("<p><ul><li>Pour chercher celles ou ceux qui vous plaisent, indiquez profil de r�f�rence profil recherch� et profils tri�s description personnelle.");
 echo ("<li>Pour chercher celles ou ceux � qui vous plaisez, indiquez profil de r�f�rence description personnelle et profils tri�s profil recherch�.");
 echo ("<li>Pour chercher celles ou ceux qui vous ressemblent, indiquez description personnelle dans les 2 cas.");
 echo ("<li>Pour chercher celles ou ceux qui ont les m�mes go�ts que vous, indiquez profil recherch� dans les 2 cas.");
 echo ("</ul>"); 
?>
<input type=submit value=Rechercher>
</form>
</body>
</HTML>
