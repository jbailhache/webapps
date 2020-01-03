<?php

 include ("platform.php");
 include ("util.php");
 include ("fb.php");

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
 initfb();
 if(!isset($_SESSION['nick']) && !identified_fb()) 
 {
  head();
  echo "<p>Vous n'&ecirc;tes pas identifi&eacute;<p><a href=index.php>Cliquez ici pour vous identifier</a>";
  /* print_r($_SESSION); */
 }
 else
 {
  head();
 
  if (isset($_SESSION['nick']))
   echo "<p><h3>Je suis " . $_SESSION['nick'] . "</h3>";

  $mynick = $_SESSION['nick'];

  $s = connexion();

  $myfnick = get_fnick ($mynick);

  $localurl = get_local_url();
  if (trace()) { echo "<p>Local URL: '$localurl'"; }

?>

<p><a href=menu.php>Retour au menu principal</a>

<p><h4>Sorties &agrave; suivre</h4>

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

  $events = array();

  $q = "SELECT * FROM " . $prefix . "follow_events WHERE fnick = '$myfnick' AND  fnick_url = '' AND fbid = $myfbid AND alldays = 0 AND day = $dm AND month = $m AND year = $y";
  if (trace()) echo "<p>$q";
  $d = query ($q);
  /*echo "<ul>";*/

  while ($r = fetch_object ($d))
  {
   if (trace()) echo "<p>followed event found url=($r->event_url)";

   $when = $r->hour * 60 + $r->minute;

   $q1 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $r->event ORDER BY date";
   if (trace()) echo "<p>$q1";
   $d1 = query ($q1);
   $i = 0;
   $found = 0;
   while ($r1 = fetch_object ($d1))
   {
    $i = $i + 1;
    if ($r1->fnick == $myfnick && $r1->fnick_url == '') /* a verifier */
    {
     if (trace()) echo "<p>found";
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

/*
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
*/

  $nick = get_nick($r->fnick);

  $events[$when][$r->event] = array ('url'=>$r->event_url, 'year'=>$y, 'month'=>$m, 'day'=>$dm, 'hour'=>$r->hour, 'minute'=>$r->minute, 'place'=>$r->place, 'nick'=>$nick, 'number'=>$r->event, 'title'=>$r->title, 'inscr'=>$inscr);

  if (trace()) 
  {
   echo "<p>" . count($events) . " events when=($when) number=($r->event)<p>";
   print_r($events[$when]);
  }
   
  }
  /*echo "</ul>";*/

  $q = "SELECT * FROM " . $prefix . "follow_events WHERE fnick = '$myfnick' AND  fnick_url = '' AND fbid = $myfbid AND  alldays = 1 AND dayofweek = $dw AND (nth = $nth OR nth = 0)";
  if (trace()) echo "<p>$q";
  $d = query ($q);
  /*echo "<ul>";*/
  while ($r = fetch_object ($d))
  {


   $q1 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE  event = $r->event AND year = $y AND month = $m AND day = $dm ORDER BY date";
   if (trace()) echo "<p>$q1";
   $d1 = query ($q1);
   $i = 0;
   $found = 0;
   while ($r1 = fetch_object ($d1))
   {
    $i = $i + 1;
    if ($r1->fnick == $myfnick && $r1->fnick_url == '' && fbid == $myfbid) /* a verifier */
    {
     if (trace()) echo "<p>found";
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

  $nick = get_nick($r->fnick);

  $events[$when][$r->event] = array ('url'=>$r->event_url, 'hour'=>$r->hour, 'minute'=>$r->minute, 'place'=>$r->place, 'nick'=>$nick, 'number'=>$r->event, 'title'=>$r->title, 'inscr'=>$inscr, 'year'=>$y, 'month'=>$m, 'day'=>$dm);

  if (trace()) 
  {
   echo "<p>" . count($events) . " events when=($when) number=($r->event)<p>";
   print_r($events[$when]);
  }

  }

  array_multisort (array_keys($events), $events);

  echo "<p><ul>";
  foreach ($events as $when => $levent)
  foreach ($levent as $number => $event)
  {
   $when = mktime ($event['hour'], $event['minute'], 0, $m, $dm, $y);
   /* if (trace()) echo "<p>when=$when now=$now"; */
 /* if ($when >= $now) */
   {
   if ($event['title'] != '')
   {
   if ($event['url'] == '')
   {
    if (trace()) echo "<p>event.php?number=" . $event['number'] . "&year=" . $event['year'] . "&month=" . $event['month'] . "&day=" . $event['day'] . ">" . $event['title'];
    echo "<p><li> " . $event['hour'] . ":" . $event['minute'] . " " . $event['place'] . " " . $event['nick'] . " <a href=event.php?number=" . $event['number'] . "&year=" . $event['year'] . "&month=" . $event['month'] . "&day=" . $event['day'] . ">" . $event['title'] . "</a> sur ce site - " . $event['inscr'];
   }
   else
   {
    if (trace()) echo "<p>remote_event.php?url=" . $event['url'] . "&number=" . $event['number'] . "&year=" . $event['year'] . "&month=" . $event['month'] . "&day=" . $event['day']. ">" . $event['title'];
    echo "<p><li> " . $event['hour'] . ":" . $event['minute'] . " " . $event['place'] . " " . $event['nick'] . " <a href=remote_event.php?url=" . $event['url'] . "&number=" . $event['number'] . "&year=" . $event['year'] . "&month=" . $event['month'] . "&day=" . $event['day']. ">" . $event['title'] . "</a> sur " . $event['url'] . ' - ' . $event['inscr']; 
    }
   }
   }
  }
  echo "</ul>";




 
 }
 echo "</ul>";

}

?>
</body>
</html>

