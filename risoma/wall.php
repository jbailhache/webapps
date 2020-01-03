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

  $name = $_GET['name'];
  $name1 = treat_string($name);

  echo "<p><a href=menu.php>Retour au menu principal</a>";

  echo "<p><h4>Mur $name</h4>";

  $q = "SELECT * FROM " . $prefix . "walls WHERE fnick = '$fnick' AND name = '$name1'";
  if (trace()) echo "<p>$q";
  $d = query ($q);
  $r = fetch_object ($d);
  if ($r)
  {
?>

<form method=post action=modify_wall.php>
<input type=hidden name=name value="<?php echo $name; ?>">
<p>
<textarea name=content rows=10 cols=60>
<?php echo $r->content; ?>
</textarea>
<p>Visibilit&eacute; 
<input type=text name=visible size=30 value=<?php echo $r->visible; ?>>
 Modifiabilit&eacute; 
<input type=text name=modifiable size=30 value=<?php echo $r->modifiable; ?>>
<p>(10=moi, 30=amis, 50=membres inscrits sur le m&ecirc;me site, 70: tous sauf ind&eacute;sirables, 90: tous)
<p><input type=submit value="Modifier">
</form>   

<?php
  }




 }
?>
</body>
</html>

