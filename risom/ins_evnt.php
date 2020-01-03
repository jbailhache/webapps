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

  $number = $_GET['number'];

  $year = $_GET['year'];
  $month = $_GET['month'];
  $day = $_GET['day'];

  $from_hour = $_GET['from_hour'];
  $from_minute = $_GET['from_minute'];
  $to_hour = $_GET['to_hour'];
  $to_minute = $_GET['to_minute'];
  $np = $_GET['np'];
  $proba = $_GET['proba'];

  if ($_GET['op'] == "ins")
  {
   /* echo "<p>ins"; */
   $q = "INSERT INTO " . $prefix . "inscriptions_events (fnick, fnick_url,  event, year, month, day, from_hour, from_minute, to_hour, to_minute, proba, np) VALUES ('$myfnick', '', $number, $year, $month, $day, $from_hour, $from_minute, $to_hour, $to_minute, $proba, $np)";
   /* echo "<p>$q"; */
   $s = query ($q); 
   echo "<p>Inscription enregistr&eacute;e";
  }
  else if ($_GET['op'] == "des")
  {
   /* echo "<p>des"; */
   $q = "DELETE FROM " . $prefix . "inscriptions_events WHERE fnick = '$myfnick' AND fnick_url = '' AND event = $number AND from_hour = $from_hour AND from_minute = $from_minute AND to_hour = $to_hour AND to_minute = $to_minute AND np=$np AND proba = $proba";
   $s = query ($q);
   echo "<p>D&eacute;sinscription enregistr&eacute;e";
  }
  /* else
   echo "<p>other:" . $_GET['op'] . ".";
  */
 }
?>
<p>
<a href=events.php>Retour &agrave; la liste des rendez-vous</a> -
<a href=menu.php>Retour au menu principal</a>
</body>
</html>


