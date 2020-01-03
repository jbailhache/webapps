<?php

 include ("platform.php");
 include ("util.php");

 function head ()
 {
  echo "
<html>
<head>
<title>Connexion</title>
</head>
<body>
";
 }

 if (connexion())
 {
  $nick = $_POST['nick'];
  $pass = $_POST['pass'];
  
  $nick1=treat_string($nick);
  $pass1=treat_string($pass);
  $q = "SELECT * FROM " . $prefix . "members WHERE nick = '$nick1' AND pass = '$pass1'";
  /* echo "<p>" . $q; */
  $data = query ($q);
  $r = fetch_object ($data);
  if (!$r)
  {
   head();
   echo "Identification incorrecte<p><a href=index.php>Cliquez ici pour recommencer</a>";
   echo "</body></html>";
  }
  else
  {
   $s = session_start();
   if (trace()) echo "<p>session_start -> ($s)";
   $_SESSION['nick'] = $nick;
   head();
   echo "Identification correcte<p><a href=menu.php>Cliquez ici pour acc&eacute;der &agrave; votre espace</a>";
   if (trace()) { echo "<p>"; print_r ($_SESSION); }
   echo "</body></html>";
  }
 }
?>

