<?php
 
 include ("platform.php");
 include ("util.php");

 session_start();

 $s = connexion();

 $fnick = $_GET['fnick'];
 $number = $_GET['number'];
 $url = $_GET['url'];

 $all = $_GET['all'];
 $year = $_GET['year'];
 $month = $_GET['month'];
 $day = $_GET['day'];

 $q = "SELECT * FROM " . $prefix . "follow_events WHERE fnick = '$fnick' AND fnick_url = '' AND event = $number AND event_url = '$url' AND alldays = $all AND year = $year AND month = $month AND day = $day";
 $d = query ($q);
 $r = fetch_object ($d);
 if ($r)
  echo "yes";
 else
  echo "no";
?>

