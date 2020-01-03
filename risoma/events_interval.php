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

  $events = array();

  $q = "SELECT * FROM " . $prefix . "events WHERE period = 0 AND day = $dm AND month = $m AND year = $y";
  if (trace()) echo "<p>$q";
  $d = query ($q);
  /*echo "<ul>";*/
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
   if (trace()) echo "<p>$r->title: visible=$r->visible distrec=$distrec test";
   if (trace()) echo "<p>test";
   if ($r->visible >= $distrec) 
   {
   if (trace()) echo "<p>visible";
   $when = $r->hour * 60 + $r->minute;

   $q1 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $r->number ORDER BY date";
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

  $events[$when][$r->number] = array ('url'=>'', 'year'=>$y, 'month'=>$m, 'day'=>$dm, 'hour'=>$r->hour, 'minute'=>$r->minute, 'place'=>$r->place, 'nick'=>$nick, 'number'=>$r->number, 'title'=>$r->title, 'inscr'=>$inscr);

  /* if (trace()) print_r($events[$when]); */
   }
  }
  /*echo "</ul>";*/

  $q = "SELECT * FROM " . $prefix . "events WHERE period = 1 AND dayofweek = $dw AND (nth = $nth OR nth = 0)";
  if (trace()) echo "<p>$q";
  $d = query ($q);
  /*echo "<ul>";*/
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
   /*if ($r->visible >= $distrec) */
   if (is_visible ($r->visible, $distrec))
   {
/*
   echo "<p><li> " . $r->hour . ":" . $r->minute . " " . $r->place . " " . $nick . " <a href=event.php?number=" . $r->number . ">" . $r->title . "</a>";
*/

   $q1 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $r->number AND year = $y AND month = $m AND day = $dm ORDER BY date";
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

  $nick = get_nick($r->fnick);

  $events[$when][$r->number] = array ('url'=>'', 'hour'=>$r->hour, 'minute'=>$r->minute, 'place'=>$r->place, 'nick'=>$nick, 'number'=>$r->number, 'title'=>$r->title, 'inscr'=>$inscr, 'year'=>$y, 'month'=>$m, 'day'=>$dm);

  if (trace()) print_r($events[$when]);
   }
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

     $urlask = $rs->url . "raw_events.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&year=$y&month=$m&day=$dm";
     if (trace()) echo "<p>$urlask";
     $s = get_url ($urlask);
     if (trace()) echo "<p>$s";
     /* echo $s; */
     $lines = explode ("\n", $s);
     foreach ($lines as $line)
     {
     if (trace()) echo "<p>$line";
     if ($line != '')
     { 
      $event = array('url'=>$rs->url);
      $items = explode (";", $line);
      foreach ($items as $item)
      {
       $data = explode ("=", $item);
       $event[$data[0]] = $data[1];
      }
      if (trace()) { echo "<p>$line"; echo "<p>"; print_r($event); }
      if ( ($event['period']=='0' && $event['year']==$y && $event['month']==$m && $event['day']==$dm) || ($event['period']=='1' && $event['dayofweek']==$dw && ($event['nth']==$nth || $event['nth']==0)) )
      {
       if (trace()) echo " date ok";
      /* $when = mktime ($event['hour'], $event['minute'], 0, $event['month'], $event['day'], $event['year']); */
       $when = $event['hour'] * 60 + $event['minute'];
       
       /* a verifier */
       $event['year'] = $y;
       $event['month'] = $m;
       $event['day'] = $dm;

$events[$when][$event['number']] = $event;
      }
     }
     }

    }
   }
   catch (Exception $e)
   {
    echo "<p><h3>Site " . $rs->url . " hors service</h3>";
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
    echo "<p><li> " . $event['hour'] . ":" . $event['minute'] . " " . $event['place'] . " " . $event['nick'] . " <a href=event.php?number=" . $event['number'] . "&year=" . $event['year'] . "&month=" . $event['month'] . "&day=" . $event['day'] . ">" . $event['title'] . "</a> sur ce site - " . $event['inscr'];
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

