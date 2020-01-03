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

  $group = $_GET['group'];
  $myfnick = $_GET['myfnick'];
  $myurl = $_GET['myurl'];
  $mypass = $_GET['mypass'];

  $myurl1 = treat_string ($myurl);
  $mypass1 = treat_string ($mypass);

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

   echo "<h4>Sur $localurl : </h4>";
   $q = "SELECT * FROM " . $prefix . "events ORDER BY year, month, day, hour, minute";
   $d = query ($q);
   echo "<p><ul>";
   while ($r = fetch_object ($d))
   {
    $nick = get_nick ($r->fnick);
    if (remote_is_member ($myfnick, $myurl, $group, $r->fnick)) 
     echo "<p><li> " . $r->day . "/" . $r->month . "/" . $r->year . " " . $r->hour . ":" . $r->minute . " " . $r->place . " " . $nick . " <a href=remote_event.php?url=$localurl&number=" . $r->number . ">" . $r->title . "</a>";
    
   }
   echo "</ul>";
  }
 
?>
