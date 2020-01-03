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
  if (trace()) echo "<p>localurl='$localurl'";

  $number = $_GET['number'];
  $url = $_GET['url'];

  $year = $_GET['year'];
  $month = $_GET['month'];
  $day = $_GET['day'];

  $year = $_GET['year'];
  $month = $_GET['month'];
  $day = $_GET['day'];

  $from_hour = $_GET['from_hour'];
  $from_minute = $_GET['from_minute'];
  $to_hour = $_GET['to_hour'];
  $to_minute = $_GET['to_minute'];
  $np = $_GET['np'];
  $proba = $_GET['proba'];

  if (trace()) echo "<p>url='$url'";
  $url1=treat_string($url);
  $myurl = $_GET['myurl'];
  if (trace()) echo "<p>myurl='$myurl'";
  $myurl1=treat_string($myurl);

  $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url1'";
  if (trace()) { echo "<p>$q"; }
  $d = query ($q);
  $r = fetch_object ($d);
  if ($r)
  {
   $mypass = $r->pass;

   if ($_GET['op'] == "ins")
   {
   
    $urlask = $url . "ask_ins_evnt.php?op=ins&myfnick=$myfnick&myurl=$localurl&mypass=$mypass&number=$number&year=$year&month=$month&day=$day&from_hour=$from_hour&from_minute=$from_minute&to_hour=$to_hour&to_minute=$to_minute&np=$np&proba=$proba";
    if (trace()) echo "<p>$urlask";
    $s = get_url ($urlask);
    echo $s;

   }
   else if ($_GET['op'] == "des")
   {
    $urlask = $url . "ask_ins_evnt.php?op=des&myfnick=$myfnick&myurl=$localurl&mypass=$mypass&number=$number&year=$year&month=$month&day=$day&from_hour=$from_hour&from_minute=$from_minute&to_hour=$to_hour&to_minute=$to_minute&np=$np&proba=$proba";
    $s = get_url ($urlask);
    echo $s;

   }
 
  }

 }
?>
<p>
<a href=events.php>Retour &agrave; la liste des rendez-vous</a> -
<a href=menu.php>Retour au menu principal</a>
</body>
</html>


