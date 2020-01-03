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
  $url = $_GET['url'];
  $follow = $_GET['follow'];

  $all = $_GET['all'];
  $year = $_GET['year'];
  $month = $_GET['month'];
  $day = $_GET['day'];
  
  $dayofweek = $_GET['dayofweek'];
  $nth = $_GET['nth'];

  $title = urldecode($_GET['title']);
  $np = $_GET['np'];
  $hour = $_GET['hour'];
  $minute = $_GET['minute'];
  $place = urldecode($_GET['place']);
  $descr = urldecode($_GET['place']);

  if ($follow)
  {
   $q = "INSERT INTO " . $prefix . "follow_events (fnick, fnick_url, event, event_url, alldays, year, month, day, dayofweek, nth, title, np, hour, minute, place, descr) VALUES ('$myfnick', '', $number, '$url', $all, $year, $month, $day, $dayofweek, $nth, '$title', $np, $hour, $minute, '$place', '$descr')"; 
   if (trace()) echo "<p>$q"; 
   $r = query ($q);
   echo "<p>Vous suivez maintenant ce rendez-vous";
  }
  else
  {
   $q = "DELETE FROM " . $prefix . "follow_events WHERE fnick = '$myfnick' AND fnick_url = '' AND event = $number AND event_url = '$url' AND alldays = $all AND year = $year AND month = $month AND day = $day"; 
   if (trace()) echo "<p>$q"; 
   $r = query ($q);
   echo "<p>Vous ne suivez plus ce rendez-vous";
  }

  echo "<p><a href=menu.php>Retour au menu principal</a>";
 }
?>
</body>
</html>

