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

  $q = "SELECT * FROM " . $prefix . "events WHERE number = $number";
  $d = query ($q);
  $r = fetch_object ($d);

  $nick = get_nick ($r->fnick);

  echo "<p><a href=events.php>Retour &agrave; la liste des rendez-vous</a> - <a href=menu.php>Retour au menu principal</a>";

  echo "<p><h4>" . $r->title . "</h4>";
  echo "Rendez-vous organis&eacute; par " . $nick;
  /* echo "<br>le " . $r->day . "/" . $r->month . "/" . $r->year . " &agrave; " . $r->hour . "h" . $r->minute; */
  echo "<br>le $day/$month/$year &agrave; " . $r->hour . "h" . $r->minute;
  $dayname = array ('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
  if ($r->period)
  {
   if ($r->nth == 0)
    echo " et tous les " . $dayname[$r->dayofweek] . "s";
   else
    echo " et tous les " . $r->nth . "e " . $dayname[$r->dayofweek] . "s du mois";
  }
  echo "<br>Lieu : " . $r->place;

  $title = urlencode ($r->title);
  $place = urlencode ($r->place);
  $descr = urlencode ($r->descr);

  if ($r->period)
  {
  $qf = "SELECT * FROM " . $prefix . "follow_events WHERE fnick = '$myfnick' AND fnick_url = ''  AND event = $number AND event_url = '' AND alldays = 0 AND year = $year AND month = $month AND day = $day";
  /* echo "<p>$qf"; */
  $df = query ($qf);
  $rf = fetch_object($df);
   if ($rf)
    echo "<p><a href=follow_event.php?follow=0&number=$number&url=&all=0&year=$year&month=$month&day=$day&dayofweek=-1&nth=-1&title=title&np=$r->np&hour=$r->hour&minute=$r->minute&place=$place&descr=$descr>Ne plus suivre ce rendez-vous pour ce jour</a>";
   else
    echo "<p><a href=follow_event.php?follow=1&number=$number&url=&all=0&year=$year&month=$month&day=$day&dayofweek=-1&nth=-1&title=$title&np=$r->np&hour=$r->hour&minute=$r->minute&place=$place&descr=$descr>Suivre ce rendez-vous pour ce jour</a>";

  $qf = "SELECT * FROM " . $prefix . "follow_events WHERE fnick = '$myfnick' AND fnick_url = ''  AND event = $number AND event_url = '' AND alldays = 1";
  /* echo "<p>$qf"; */
  $df = query ($qf);
  $rf = fetch_object($df);
   if ($rf)
    echo "<p><a href=follow_event.php?follow=0&number=$number&url=&all=1&year=0&month=0&day=0&dayofweek=-1&nth=-1&title=$title&np=$r->np&hour=$r->hour&minute=$r->minute&place=$place&descr=$descr>Ne plus suivre ce rendez-vous pour tous les jours</a>";
   else
    echo "<p><a href=follow_event.php?follow=1&number=$number&url=&all=1&year=0&month=0&day=0&dayofweek=$r->dayofweek&nth=$r->nth&title=$title&np=$r->np&hour=$r->hour&minute=$r->minute&place=$place&descr=$descr>Suivre ce rendez-vous pour tous les jours</a>";

   
  }
  else 
  {
  $qf = "SELECT * FROM " . $prefix . "follow_events WHERE fnick = '$myfnick' AND fnick_url = ''  AND event = $number AND event_url = ''";
  /* echo "<p>$qf"; */
  $df = query ($qf);
  $rf = fetch_object($df);
  if ($rf)
  {
   echo "<p><a href=follow_event.php?follow=0&number=$number&url=&all=0&year=$year&month=$month&day=$day&dayofweek=-1&nth=-1&title=$title&np=$r->np&hour=$r->hour&minute=$r->minute&place=$place&descr=$descr>Ne plus suivre ce rendez-vous</a>";
  }
  else
  {
   echo "<p>follow_event.php?follow=1&number=$number&url=&all=0&year=$year&month=$month&day=$day&dayofweek=-1&nth=-1&title=$r->title&np=$r->np&hour=$r->hour&minute=$r->minute&place=$r->place&descr=$r->descr";
   echo "<p><a href=follow_event.php?follow=1&number=$number&url=&all=0&year=$year&month=$month&day=$day&dayofweek=-1&nth=-1&title=$title&np=$r->np&hour=$r->hour&minute=$r->minute&place=$place&descr=$descr>Suivre ce rendez-vous</a>";
  } 
  }

  echo "<p>" . $r->inscriptions . " inscrits pour " . $r->np . " places";
/*
  $q1 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $number AND fnick = '$myfnick' AND fnick_url = '' AND year = $year AND month = $month AND day = $day";  
  $d1 = query ($q1);
  $r1 = fetch_object ($d1);
  if ($r1)
  {
   echo "<p>Je suis inscrit";
   echo " le $r1->day/$r1->month/$r1->year";
   echo " - <a href=ins_evnt.php?op=des&number=" . $number . ">Je me d&eacute;sinscris</a>";
  }
  else
  { 
   echo "<p><a href=ins_evnt.php?op=ins&number=$number&year=$year&month=$month&day=$day>Je m'inscris</a>";
  }
*/
  $q1 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $number AND fnick = '$myfnick' AND fnick_url = '' AND year = $year AND month = $month AND day = $day"; /* a verifier */
  $d1 = query ($q1);
  echo "<p>Inscriptions :<p><ul>";
  while ($r1=fetch_object($d1))
  {
   echo "<li> pour $r1->np personnes de $r1->from_hour h $r1->from_minute &agrave; $r1->to_hour h $r1->to_minute $r1->proba % <a href=ins_evnt.php?op=des&number=$number&from_hour=$r1->from_hour&from_minute=$r1->from_minute&to_hour=$r1->to_hour&to_minute=$r1->to_minute&np=$r1->np&proba=$r1->proba>Je me d&eacute;sinscris</a>";
  }
  echo "</ul>";

   echo "
<form method=get action=ins_evnt.php>
<input type=hidden name=op value=ins>
<input type=hidden name=number value=$number>
<input type=hidden name=year value=$year>
<input type=hidden name=month value=$month>
<input type=hidden name=day value=$day>
<p>Je m'inscris pour
<input type=text name=np size=3>
personnes
<p>entre  <input type=text name=from_hour size=3> h <input type=text name=from_minute size=3> et <input type=text name=to_hour size=3> h <input type=text name=to_minute size=3>
<p>probabilit&eacute; de pr&eacute;sence : <input type=text name=proba size=3 value=90> %
<input type=submit value=\"Je m'inscris\">
</form>";
  
  if ($nick==$mynick)
  {
   echo "<p><a href=mod_evnt.php?number=$number>Modifier</a>";
  }
  echo "<p>Description :<br>" . $r->descr;

  /* $q2 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $number ORDER BY date"; */
  $q2 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $number AND year = $year AND month = $month AND day = $day"; /* a verifier */
  $d2 = query ($q2);
  echo "<p>Inscrits : <ul>";
  $i = 0;
  while ($r2 = fetch_object ($d2))
  {
   $i = $i + 1;
   if ($i > $r->np)
   {
    echo "<p>Liste d'attente : ";
   }
   $nick = get_nick ($r2->fnick);
   echo "<li> $r2->day/$r2->month/$r2->year : $nick";
   if ($r2->fnick_url != '')
   {
    echo " sur " . $r2->fnick_url;
   } 
  }
  echo "</ul>";

  echo "<p>Commentaires : <ul>";
  $q3 = "SELECT * FROM " . $prefix . "messages_events WHERE event = $number ORDER BY date";
  $d3 = query ($q3);
  while ($r3 = fetch_object ($d3))
  {
   echo "<li> " . $r3->date . " " . get_nick($r3->fnick) . "<br>" . $r3->body; 
  }
  echo "</ul>";
?>
<p>Ecrire un commentaire :
<form method=post action=svmsgevt.php>
<textarea name=body rows=10 cols=60>
</textarea>
<input type=hidden name=number value=<?php echo $number; ?>>
<p><input type=submit value="Envoyer">
</form>
<?php

 }
?>
</body>
</html>

