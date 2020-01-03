<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Informations concernant un membre</title>
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
  echo "<a href=menu.php>Retour au menu principal</a>";
  $mynick = $_SESSION['nick'];
  $s = connexion();
  $myfnick = get_fnick ($mynick);

  $q = "SELECT * FROM " . $prefix . "members";
  $d = query ($q);
  echo "<ul>";
  while ($r = fetch_object($d))
  {
   $dist = get_distance ($myfnick, $r->fnick);
   /* echo "<p>distance entre " . $myfnick . " et " . $r->fnick . " = " . $dist; */
   if (get_distance ($myfnick, $r->fnick) <= $_POST['distance'])
   {
    echo "<p><li><a href=member.php?nick=" . $r->nick . ">" . $r->nick . "</a>";
   }
  }
  echo "</ul>";

 }
?>
</body>
</html>
