<HTML>
<head>
<title>Enregistrement d'un caract�re</title>
</head>
<body>
<?php
 include ("util.php");
 if (connexion() > 0)
 {
  $query = "INSERT INTO afcarac (categorie, caractere) VALUES ('$categorie', '$caractere')";
  $r = mysql_query ($query);
  if (!$r)
   echo ("Requ�te $query invalide");
  else
   echo ("$categorie $caractere enregistr�.");
 }
 echo ("<p><a href=affinite.php?action=$action>Retour</a>");
?>
<p>
 
</body>
</html>
