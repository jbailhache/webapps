<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
?>
<HTML>
<head>
<title>Enregistrement de l'inscription</title>
</head>
<body>
<?php
 include ("util.php");
 if (connexion() > 0)
 {
  $query = "SELECT * FROM afinscr WHERE pseudo = '$pseudo'";
  $data = mysql_query ($query);
  if ($rec = mysql_fetch_object ($data))
  {
	echo ("<p>Le pseudo $pseudo existe d�ja.<p><a href=inscrip.php>Choisissez-en un autre.</a>");
  }
  else
  {
  	$query = "INSERT INTO afinscr (pseudo, motdepasse, prenom, nom, adresse, telephone, email, web, photo, autre) VALUES ('$pseudo', '$motdepasse', '$prenom', '$nom', '$adresse', '$telephone', '$email', '$web', '$photo', '$autre')";
  	$r = mysql_query ($query);
  	if (!$r)
   		echo ("Requ�te $query incorrecte");
  	else
   		echo ("Inscription enregistr�e.");
  }
 }
?>
<p>
<a href=index.php>Retour au sommaire</a>
</body>
</HTML>
