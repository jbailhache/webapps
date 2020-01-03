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

  $localurl = get_local_url();
  if (trace()) { echo "<p>Local URL: '$localurl'"; }

?>

<p><a href=menu.php>Retour au menu principal</a>

<p><h4>Rendez-vous</h4>

<?php

/*
 query ('CREATE TABLE " . $prefix . "events (number INTEGER, title TEXT, fnick TEXT, np INTEGER, year INTEGER, month INTEGER, day INTEGER, hour INTEGER, minute INTEGER, place TEXT, descr TEXT, inscriptions INTEGER)');
*/

  $now = time();

  echo "<p><h4>Sur ce site : </h4><p>";

  $q = "SELECT * FROM " . $prefix . "events ORDER BY year, month, day, hour, minute";
  $d = query ($q);
  echo "<p><ul>";
  while ($r = fetch_object($d))
  {

   /* check if event is visible */
   $qd = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '" . $r->fnick . "' AND hisfnick = '" . $myfnick . "'";
   $dd = query ($qd);
   $rd = fetch_object ($dd);
   if ($rd)
    $distrec = $rd->distance;
   else
    $distrec = 40;
   if (trace()) echo "<p>$r->title: visible=$r->visible distrec=$distrec";
   if ($r->visible >= $distrec) 
   {

   $when = mktime (0, 0, 0, $r->month, $r->day, $r->year);
   $dif = floor (($now - $when) / (60*60*24));
   /* if ($dif <= 31) */
   {

   $nick = get_nick ($r->fnick);

   /* 
   $q1 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $r->number AND fnick = '$myfnick'";
   $d1 = query ($q1);
   $r1 = fetch_object ($d1);
   */

   $q1 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $r->number ORDER BY date";
   $d1 = query ($q1);
   $i = 0;
   $found = 0;
   while ($r1 = fetch_object ($d1))
   {
    $i = $i + 1;
    if ($r1->fnick == $myfnick)
    {
     $found = 1;
     break;
    }
   }
   echo "<p><li> " . $r->day . "/" . $r->month . "/" . $r->year . " " . $r->hour . ":" . $r->minute . " " . $r->place . " " . $nick . " <a href=event.php?number=" . $r->number . ">" . $r->title . "</a>";

   if ($found)
   {
    if ($i <= $r->np)
    {
     echo " inscrit";
    }
    else
    {
     echo " en liste d'attente";
    }
   }
  }
  }
  }
  echo "</ul>";
  
 }

  $qs = "SELECT * FROM " . $prefix . "sites";
  $ds = query ($qs);
  while ($rs = fetch_object ($ds))
  {
   /* echo "<p>" . $rs->url; */
   try
   {
    $url = $rs->url;
    $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url'";
    if (trace()) { echo "<p>$q"; }
    $d = query ($q);
    $r = fetch_object ($d);
    if ($r)
    {
     $mypass = $r->pass;

     $urlask = $rs->url . "ask_events.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass";
     if (trace()) echo "<p>$urlask";
     $s = get_url ($urlask);
     echo $s;

    }
   }
   catch (Exception $e)
   {
    echo "<p><h3>Site " . $rs->url . " hors service</h3>";
   }
  }


?>
</body>
</html>
 
