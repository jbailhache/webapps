<HTML>
<head>
<title>Enregistrement de l'inscription</title>
</head>
<body>
<?php
 include ("util.php");
 if (connexion() > 0)
 {
  /*$query = "INSERT INTO afinscr (pseudo, motdepasse, prenom, nom, adresse, telephone, email, web, photo, autre) VALUES ('$pseudo', '$motdepasse', '$prenom', '$nom', '$adresse', '$telephone', '$email', '$web', '$photo', '$autre')";*/
  $query = "UPDATE afinscr SET motdepasse = '$motdepasse', prenom = '$prenom', nom = '$nom', adresse = '$adresse', telephone = '$telephone', email = '$email', web = '$web', photo = '$photo', autre = '$autre' WHERE pseudo = '$afpseudo'";
  $r = mysql_query ($query);
  if (!$r)
   echo ("Requ�te $query incorrecte");
  else
   echo ("Inscription modifi�e.");
 }
?>
<p>
<a href=index.php>Retour au sommaire</a>
</body>
</HTML>
