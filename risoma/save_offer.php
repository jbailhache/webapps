<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Echanges</title>
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
  $mynick = $_SESSION['nick'];
  $s = connexion();
  $myfnick = get_fnick($mynick);

  echo "<p><a href=exchanges.php>Retour aux &eacute;changes</a> - <a href=menu.php>Retour au menu principal</a>";

  $number = $_POST['number'];
  $descr = $_POST['descr'];
  $descr1 = treat_string ($descr);
  $q = "UPDATE " . $prefix . "offers SET descr = '$descr1' WHERE number = $number";
  $s = query ($q);
  echo "<p>Offre enregistr&eacute;e";

 }
?>
</body>
</html>

