<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Murs</title>
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
  $fnick = get_fnick ($nick);

  $name = $_POST['name'];
  $content = $_POST['content'];
  $visible = $_POST['visible'];
  $modifiable = $_POST['modifiable'];

  $name1 = treat_string ($name);
  $content1 = treat_string ($content);

  $q = "UPDATE " . $prefix . "walls SET content = '$content1', visible = $visible, modifiable = $modifiable WHERE fnick = '$fnick' AND name = '$name1'";
  if (trace()) { echo "<p>$q"; }
  $s = query ($q);
  echo "<p>Modification enregistr&eacute;e";

 }
?>
<p>
<a href=walls.php>Retour aux murs</a> -
<a href=menu.php>Retour au menu principal</a>

</body>
</html>

