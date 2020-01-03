<?php

 include ("platform.php");

 function head()
 {
  echo "
<html>
<head>
<title>Menu principal</title>
</head>
<body>
";
 }

 session_start();
 if(!isset($_SESSION['nick'])) 
 {
  head();
  echo "<p>Vous n'&ecirc;tes pas identifi&eacute;<p><a href=index.php>Cliquez ici pour vous identifier</a>";
  /* print_r($_SESSION); */
 }
 else
 {
  head();
  echo "<p><h3>Je suis " . $_SESSION['nick'] . "</h3>";
  $nick = $_SESSION['nick'];

  $s = connexion();

  $q = "SELECT * FROM " . $prefix . "members WHERE nick = '$nick'";
  $d = query ($q);
  $r = fetch_object ($d);
  $fnick = $r->fnick;

  $date = $_GET['date'] . " " . $_GET['time'];

  $q = "DELETE FROM " . $prefix . "wall WHERE fnick = '$fnick' AND date = '$date'";
  $s = query ($q);
  if (!$s)
  {
   echo "<p>Erreur dans la suppression du message";
  }
  else
  {
   echo "<p>Message supprim&eacute: <p>" . $message . "<p><a href=menu.php>Retour au menu principal</a>";
  }
 }
?>
</body>
</html>

