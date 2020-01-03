<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Rendez-vous</title>
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

  $myfnick = get_fnick ($mynick);

  $number = $_POST['number'];
  $body = $_POST['body'];
  $body1 = treat_string($body);

  $q = "INSERT INTO " . $prefix . "messages_events (event, fnick, body) VALUES ($number, '$myfnick', '$body1')";
  $s = query ($q);

  echo "<p>Message enregistr&eacute;";

 }
?>
<p>
<a href=events.php>Retour aux rendez-vous</a> -
<a href=menu.php>Retour au menu principal</a>
</body>
</html>

