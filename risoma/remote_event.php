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

  if (trace()) echo "<p>$day/$month/$year";

  $nick = get_nick ($r->fnick);

  $localurl = get_local_url();

  echo "<p><a href=events.php>Retour &agrave; la liste des rendez-vous</a> - <a href=menu.php>Retour au menu principal</a>";

  $url = $_GET['url'];
  $url1=treat_string($url);

  $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url1'";
  if (trace()) { echo "<p>$q"; }
   $d = query ($q);
  $r = fetch_object ($d);
  if ($r)
  {
   $mypass = $r->pass;

   $urlask = $url . "ask_event.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&number=$number&year=$year&month=$month&day=$day";
   $s = get_url ($urlask);
   echo $s;

  }
 }
?>
</body>
</html>

