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

  $s = connexion();

  $myfnick = $_GET['myfnick'];
  $myurl = $_GET['myurl'];
  $mypass = $_GET['mypass'];
  $nick = $_GET['nick'];
  $fnick = get_fnick($nick); 
  /* $fnick = $_GET['fnick']; */
  $url = get_local_url();

  $myurl1 = treat_string ($myurl);
  $mypass1 = treat_string ($mypass);

  $q = "SELECT * FROM " . $prefix . "incoming WHERE fnick = '$myfnick' AND url = '$myurl1' AND pass = '$mypass1";
  $d = query ($q);
  $r = fetch_object ($d);
  if (!$r)
  {
   echo "<p>Identification incorrecte.";
  }
  else
  {
   echo "<p>Identification correcte";
   $encwall = $_GET['encwall'];
   $wall = urldecode($encwall);
   $wall1 = treat_string($wall);

   $q = "UPDATE " . $prefix . "members SET wall = '$wall1' WHERE nick = '$nick'";
   echo "<p>$q";
   $s = query ($q);

  }
?>



