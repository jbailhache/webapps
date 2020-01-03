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
?>

<p><a href=menu.php>Retour au menu principal</a>

<p><h4>Cr&eacute;er un mur</h4>
<form method=post action=create_wall.php>
<p>Nom: <input type=text name=name size=60 value="">
<p>Visibilit&eacute;: <input type=text size=30 name=visible value="70">
Modifiabilit&eacute;: <input type=text size=30 name=modifiable value="30">
<p>(10=moi, 30=amis, 50=membres inscrits sur le m&ecirc;me site, 70: tous sauf ind&eacute;sirables, 90: tous) 
<p>Texte:
<p><textarea name=content rows=10 cols=60>
</textarea>
<p><input type=submit value="Cr&eacute;er le mur">
</form>

<p><h4>Mes murs</h4>
<?php
 $q = "SELECT * from " . $prefix . "walls WHERE fnick = '$fnick'";
 $d = query ($q);
 echo "<ul>";
 while ($r = fetch_object($d))
 {
  echo "<li> <a href=wall.php?name=" . urlencode($r->name) . ">" . $r->name . "</a>";
 }
 echo "</ul>";

 }
?>
</body>
</html>

