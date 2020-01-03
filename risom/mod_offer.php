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

  $number = $_GET['number'];

  $q = "SELECT * FROM " . $prefix . "offers WHERE number = $number";
  $d = query ($q);
  $r = fetch_object($d);
  if (!$r)
  {
   echo "<p>Offre non trouv&eacute;e";
  }
  else
  {
?>
<form method=post action=save_offer.php>
<p><h4>Modifier une offre</h4>
<input type=hidden name=number value=<?php echo $number; ?>>
<p><textarea name=descr rows=10 cols=60>
<?php echo $r->descr; ?>
</textarea>
<p><input type=submit value=Enregistrer>
</form>

<?php
  }
 }
?>
</body>
</html>
