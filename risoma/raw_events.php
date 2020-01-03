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
  $mypass = $_GET['mypass'];

  $year = $_GET['year'];
  $month = $_GET['month'];
  $day = $_GET['day'];

  $myurl1=treat_string($myurl);
  $mypass1=treat_string($mypass);

  $q = "SELECT * FROM " . $prefix . "incoming WHERE fnick = '$myfnick' AND url = '$myurl1' AND pass = '$mypass1'";
  /* if (trace()) { echo "<p>$q"; } */
  $d = query ($q);
  $r = fetch_object ($d);
  if (!$r)
  {
   /* echo "<p>Identification incorrecte."; */
  }
  else
  {

   $localurl = get_local_url();

   /* echo "<h4>Sur $localurl : </h4>"; */
   $q = "SELECT * FROM " . $prefix . "events ORDER BY year, month, day, hour, minute";
   $d = query ($q);
   /* echo "<p><ul>"; */
   while ($r = fetch_object ($d))
   {
    /* if (trace()) { echo "<p>"; print_r($r); } */
    /* check if event is visible */
    $qdr = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '$r->fnick' AND hisfnick = '$myfnick' AND hisurl = '$myurl1'";
    $ddr = query ($qdr);
    $rdr = fetch_object ($ddr);
    if ($rdr)
     $distrec = $rdr->distance;
    else
     $distrec = 60;

    /* if ($r->visible >= $distrec) */
    if (is_visible ($r->visible, $distrec))
    {

    /* if (trace()) echo "<p>visible";*/
    $nick = get_nick ($r->fnick);

    $q1 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $r->number AND year = $year AND month = $month AND day = $day ORDER BY date";
    /* if (trace()) echo "<p>$q1"; */
    $d1 = query ($q1);
    $i = 0;
    $found = 0;
    /* if (trace()) echo "<p>myfnick='$myfnick' myurl='$myurl'"; */
    /* if (trace()) echo "***debut***"; 
    while ($r1 = fetch_object ($d1))
    {
      if (trace()) echo "<p>((( event=$r1->event fnick='$r1->fnick' fnick_url='$r1->fnick_url' )))"; 
    }
    if (trace()) echo "***fin***"; */
    while ($r1 = fetch_object ($d1))
    {
     /* if (trace()) { echo "<p>inscription: "; print_r($r1); } */
      /* if (trace()) echo "<p>event=$r1->event fnick='$r1->fnick' fnick_url='$r1->fnick_url'"; */
     $i = $i + 1;
     if ($r1->fnick == $myfnick && $r1->fnick_url == $myurl)
     {
      /* if (trace()) echo "<p>found"; */
      $found = 1;
      break;
     }
    }
    $inscr = 'non inscrit';
    if ($found)
    {
     if ($i < $r->np)
      $inscr = "inscrit";
     else
      $inscr = "en liste d'attente";
    }

    /* echo "<p><li> " . $r->day . "/" . $r->month . "/" . $r->year . " " . $r->hour . ":" . $r->minute . " " . $r->place . " " . $nick . " <a href=remote_event.php?url=$localurl&number=" . $r->number . ">" . $r->title . "</a>"; */
    echo "period=$r->period;day=$r->day;month=$r->month;year=$r->year;dayofweek=$r->dayofweek;nth=$r->nth;hour=$r->hour;minute=$r->minute;place=$r->place;nick=$nick;number=$r->number;title=$r->title;inscr=$inscr\n";

    }

   }
   /* echo "</ul>"; */


  }
 
?>
