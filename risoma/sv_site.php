<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Gestion des sites</title>
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
 else if ($_SESSION['nick'] != 'webmaster')
 {
  head();
  echo "<p>Cette page est r&eacute;serv&eacute;e au webmaster.<p><a href=index.php>Cliquez ici pour vous identifier</a>";
 }
 else 
 {
  head();
  echo "<p><h3>Gestion des sites</h3>";
  echo "<p><h3>Je suis " . $_SESSION['nick'] . "</h3>";
  $nick = $_SESSION['nick'];

  $s = connexion();

  $url = $_POST['url'];
  $url1=treat_string($url);
  $q = "INSERT INTO " . $prefix . "sites (url) VALUES ('$url1')";
  $s = query ($q);

  echo "<p>Site enregistr&eacute;";

 }
?>
<p>
<a href=sites.php>Retour &agrave; la gestion des sites</a> -
<a href=menu.php>Retour au menu principal</a>
<p>
</body>
</html>

