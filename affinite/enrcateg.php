<HTML>
<head>
<title>Enregistrement d'une cat�gorie</title>
</head>
<body>
<?php
 include ("util.php");
 if (connexion() > 0)
 {
  $query = "INSERT INTO afcateg (categorie, position) VALUES ('$categorie', 1000)";
  $r = mysql_query ($query);
  if (!$r)
   echo ("Requ�te $query incorrecte");
  else
   echo ("Question $categorie cr��e.");
 }
 echo ("<p>Cr�ez les r�ponses possibles � cette question en cliquant sur \"autre\" dans le formulaire.");
 echo ("<p><a href=affinite.php?action=$action>Retour</a>");
?>
<p>
</body>
</HTML>

