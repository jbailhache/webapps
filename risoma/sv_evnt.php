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
  $nick = $_SESSION['nick'];

  $s = connexion();

  $fnick = get_fnick ($nick);
/*
 query ('CREATE TABLE " . $prefix . "events (number INTEGER, title TEXT, fnick TEXT, np INTEGER, year INTEGER, month INTEGER, day INTEGER, hour INTEGER, minute INTEGER, place TEXT, descr TEXT, inscriptions INTEGER)');
*/

  $title = $_POST['title'];
  $np = $_POST['np'];
  if ($np == '') $np = 0;

  $period = $_POST['period'];
  
  $year = $_POST['year'];
  if ($year == '') $year = 0;
  $month = $_POST['month'];
  if ($month == '') $month = 0;
  $day = $_POST['day'];
  if ($day == '') $day = 0;

  $dayofweek = $_POST['dayofweek'];
  $nth = $_POST['nth'];
  if ($nth == '') $nth = 0;

  $hour = $_POST['hour'];
  if ($hour == '') $hour = -1;
  $minute = $_POST['minute'];
  if ($minute == '') $minute = -1;

  $place = $_POST['place'];
  $descr = $_POST['descr'];
  $visible = $_POST['visible'];

  $title1 = treat_string ($title);
  $place1 = treat_string($place);
  $descr1 = treat_string ($descr);

  $q = "INSERT INTO " . $prefix . "events (title, fnick, np, period, year, month, day, dayofweek, nth, hour, minute, place, descr, inscriptions, visible) VALUES ('$title1', '$fnick', $np, $period, $year, $month, $day, $dayofweek, $nth, $hour, $minute, '$place1', '$descr1', 0, $visible)";
  $s = query ($q);

  echo "<p>Rendez-vous enregistr&eacute;";
 }
?>
<p>
<a href=menu.php>Retour au menu principal</a>

</body>
</html>


