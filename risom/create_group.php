<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Groupes</title>
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

  $fnick = get_fnick($nick);

  $name = $_POST['name'];
  $desc = $_POST['desc'];
 
  $name1 = treat_string ($name);
  $desc1 = treat_string ($desc);

  $q = "INSERT INTO " . $prefix . "groups (name, descr, fnick) VALUES ('$name1', '$desc1', '$fnick')";
  echo $q;
  $s = query ($q);

  echo "<p>Groupe $name cr&eacute;&eacute;";
  echo "<p><a href=groups.php>Retour aux groupes</a> - <a href=menu.php>Retour au menu principal</a>";


 }
?>
</body>
</html>
