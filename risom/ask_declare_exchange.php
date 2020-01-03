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

  $s = connexion();

  $myfnick = $_GET['myfnick'];
  $myurl = $_GET['myurl'];
  $mypass = $_GET['mypass'];
  $hisfnick = $_GET['hisfnick'];
  $hisurl = $_GET['hisurl'];
  $value = $_GET['value'];
  $day = $_GET['day'];
  $month = $_GET['month'];
  $year = $_GET['year'];
  $descr = $_GET['descr'];

  $myurl1  = treat_string ($myurl);
  $mypass1 = treat_string ($mypass);
  $hisurl1 = treat_string ($hisurl);
  $descr1 = treat_string ($descr);

  $q = "SELECT * FROM " . $prefix . "incoming WHERE fnick = '$myfnick' AND url = '$myurl1' AND pass = '$mypass1'";
  $d = query ($q);
  $r = fetch_object ($d);
  if (!$r)
  {
   echo "<p>Identification incorrecte.";
  }
  else
  {

   $q = "INSERT INTO " . $prefix . "exchanges (tofnick, tourl, byfnick, byurl, value, day, month, year, descr) VALUES ('$myfnick', '$myurl1', '$hisfnick', '$hisurl1', $value, $day, $month, $year, '$descr1')";
   if (trace()) { echo "<p>$q"; }
   $s = query ($q);

   $qhe = "SELECT * FROM " . $prefix . "members WHERE fnick = '$hisfnick'";
   if (trace()) { echo "<p>$qhe"; }
   $dhe = query ($qhe);
   $rhe = fetch_object ($dhe);
   if ($rhe)
   {
    $q = "UPDATE " . $prefix . "members SET given = " . ($rhe->given + $value) . " WHERE fnick = '$hisfnick'";
    if (trace()) { echo "<p>$q"; }
    $s = query ($q);
   }
   else
   {
    echo "<p>Membre '$hisfnick' non trouv&eacute; sur le site '$hisurl'";
   }

  }
?>
</body>
</html>

