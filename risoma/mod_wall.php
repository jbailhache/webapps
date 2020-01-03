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
  $mynick = $_SESSION['nick'];
  $s = connexion();
  $myfnick = get_fnick ($mynick);

  $hisfnick = $_POST['hisfnick'];
  $name = $_POST['name'];
  $content = $_POST['content'];

  $name1 = treat_string ($name);
  $content1 = treat_string ($content);

  $q = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '$hisfnick' AND hisfnick = '$myfnick' AND hisurl = ''";
  $d = query ($q);
  $rdr = fetch_object ($d);
  if ($rdr)
  {
   $distrec = $rdr->distance;
  }
  else
  {
   $distrec = 40;
  }

  $q = "SELECT * FROM " . $prefix . "walls WHERE fnick = '$hisfnick' AND name = '$name1'";
  $d = query ($q);
  $r = fetch_object ($d);
  if (!$r)
  {
   echo "<p>'$hisfnick' n'a pas de mur nomm&eacute; '$name'";
  }
  else
  {
   /* if ($r->visible >= $distrec) */
   if (is_visible ($r->visible, $distrec))
   {
    $name1=treat_string($name);
    $q = "UPDATE " . $prefix . "walls SET content = '$content1' WHERE fnick = '$hisfnick' AND name = '$name1'";
    if (trace()) { echo "<p>$q"; }
    $s = query ($q);
    echo "<p>Modification enregistr&eacute;e"; 
   }
  }

 }
?>
<p>
<a href=members.php>Retour aux membres</a> -
<a href=menu.php>Retour au menu principal</a>

</body>
</html>

