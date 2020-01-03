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

 $days = array ('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');

 $eventssince = $_POST['eventssince'];
 $eventsuntil = $_POST['eventsuntil'];

 $now = time();
 $secondsinday = 24 * 60 * 60;
 echo "<ul>";
 for ($dayplus=$eventssince; $dayplus<=$eventsuntil; $dayplus++)
 {
  $day = $now + $dayplus * $secondsinday;
  $dm = gmdate ('d', $day);
  $m = gmdate ('n', $day);
  $y = gmdate ('Y', $day);
  $dw = gmdate ('w', $day);
  $nth = ($dm - 1 - (($dm - 1) % 7)) / 7 + 1;
  echo '<p><li> ' . $days[$dw] . ' ' . $dm . '/' . $m . '/' . $y . ' : ';

  $q = "SELECT * FROM " . $prefix . "events WHERE period = 0 AND day = $dm AND month = $m AND year = $y";
  if (trace()) echo "<p>$q";
  $d = query ($q);
  echo "<ul>";
  while ($r = fetch_object ($d))
  {
   /* check if event is visible */
   $qd = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '" . $r->fnick . "' AND hisfnick = '" . $myfnick . "'";
   if (trace()) echo "<p>$qd";
   $dd = query ($qd);
   $rd = fetch_object ($dd);
   if ($rd)
    $distrec = $rd->distance;
   else
    $distrec = 40;
   if (trace()) echo "<p>$r->title: visible=$r->visible distrec=$distrec";
   if ($r->visible >= $distrec) 
   {

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
   /* echo "<p><li> " . $r->day . "/" . $r->month . "/" . $r->year . " " . $r->hour . ":" . $r->minute . " " . $r->place . " " . $nick . " <a href=event.php?number=" . $r->number . ">" . $r->title . "</a>"; */
   if (trace()) echo "<p>+event";
   $inscr = 'non inscrit';
   if ($found)
   {
    if ($i < $r->np)
     $inscr = 'inscrit';
    else
     $inscr = "en liste d'attente";
   }

   echo "<p><li> " . $r->hour . ":" . $r->minute . " " . $r->place . " " . $nick . " <a href=event.php?number=" . $r->number . ">" . $r->title . "</a>";

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
  echo "</ul>";

  $q = "SELECT * FROM " . $prefix . "events WHERE period = 1 AND dayofweek = $dw AND (nth = $nth OR nth = 0)";
  if (trace()) echo "<p>$q";
  $d = query ($q);
  echo "<ul>";
  while ($r = fetch_object ($d))
  {
   /* check if event is visible */
   $qd = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '" . $r->fnick . "' AND hisfnick = '" . $myfnick . "'";
   if (trace()) echo "<p>$qd";
   $dd = query ($qd);
   $rd = fetch_object ($dd);
   if ($rd)
    $distrec = $rd->distance;
   else
    $distrec = 40;
   if (trace()) echo "<p>$r->title: visible=$r->visible distrec=$distrec";
   if ($r->visible >= $distrec) 
   {

   echo "<p><li> " . $r->hour . ":" . $r->minute . " " . $r->place . " " . $nick . " <a href=event.php?number=" . $r->number . ">" . $r->title . "</a>";
   }
  }
  echo "</ul>";
 
 }
 echo "</ul>";

}

?>
</body>
</html>

