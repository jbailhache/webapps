<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Journal</title>
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
  echo " <a href=menu.php>Retour au menu principal</a>";
  $mynick = $_SESSION['nick'];
  $s = connexion();
  $myfnick = get_fnick ($mynick);

  $from = sprintf("%04d",$_POST['fromyear'])."-".sprintf("%02d",$_POST['frommonth'])."-".sprintf("%02d",$_POST['fromday']);
  $until = sprintf("%04d",$_POST['untilyear'])."-".sprintf("%02d",$_POST['untilmonth'])."-".sprintf("%02d",$_POST['untilday']);

  echo "<h3>Journal du $from au $until :</h3>";

  $q = "SELECT * FROM " . $prefix . "diary WHERE date >= '$from' AND date <= '$until'";
 
  $d = query ($q);
  echo "<ul>";
  while ($r = fetch_object($d))
  {
   $dist1 = get_distance ($myfnick, $r->fnick);
   $dist2 = get_distance ($r->fnick, $myfnick);
   /* echo "<p>" . $_POST['search'] . "/" . $r->message . "/" . strpos($r->message,$_POST['search']); */
   /* if ($dist1 <= $_POST['distance'] && $dist2 <= $r->visible && */
   if (is_visible ($_POST['distance'], $dist1) && is_visible ($r->visible, $dist2) && 
    ($_POST['search']=="" || strpos($r->message,$_POST['search']) ))
   {
    echo "<li> " . $r->date . " : " . $r->message;
   } 
  }
  echo "</ul>";

 }
?>
</body>
</html>
 
