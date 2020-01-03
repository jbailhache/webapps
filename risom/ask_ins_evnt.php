<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Rendez-vous</title>
</head>
<body>
";
 }

  session_start();

  $s = connexion();

  $myfnick = $_GET['myfnick'];
  $myurl = $_GET['myurl'];
  if (trace()) echo "<p>myurl='$myurl'";
  $mypass = $_GET['mypass'];

  $myurl1 = treat_string ($myurl);
  $mypass1 = treat_string ($mypass);

  $year = $_GET['year'];
  $month = $_GET['month'];
  $day = $_GET['day'];

  $from_hour = $_GET['from_hour'];
  $from_minute = $_GET['from_minute'];
  $to_hour = $_GET['to_hour'];
  $to_minute = $_GET['to_minute'];
  $np = $_GET['np'];
  $proba = $_GET['proba'];

  if (trace()) echo "<p>year=$year month=$month day=$day";

  $q = "SELECT * FROM " . $prefix . "incoming WHERE fnick = '$myfnick' AND url = '$myurl1' AND pass = '$mypass1'";
  if (trace()) { echo "<p>$q"; }
  $d = query ($q);
  $r = fetch_object ($d);
  if (!$r)
  {
   echo "<p>Identification incorrecte.";
  }
  else
  {

   $localurl = get_local_url();
   if (trace()) echo "<p>localorl='$localurl'";
   
   $number = $_GET['number'];

   if ($_GET['op'] == "ins")
   {
    $q = "INSERT INTO " . $prefix . "inscriptions_events (fnick, fnick_url,  event, year, month, day, from_hour, from_minute, to_hour, to_minute, proba, np) VALUES ('$myfnick', '$myurl1', $number, $year, $month, $day, $from_hour, $from_minute, $to_hour, $to_minute, $proba, $np)";
    if (trace()) echo "<p>$q";
    $s = query ($q); 
    echo "<p>Inscription enregistr&eacute;e";
   }
   else if ($_GET['op'] == "des")
   {
    $q = "DELETE FROM " . $prefix . "inscriptions_events WHERE fnick = '$myfnick' AND fnick_url = '$myurl1' AND event = $number AND from_hour = $from_hour AND from_minute = $from_minute AND to_hour = $to_hour AND to_minute = $to_minute AND np=$np AND proba = $proba";
    $s = query ($q);
    echo "<p>D&eacute;sinscription enregistr&eacute;e";
   }


  }
 
?>
