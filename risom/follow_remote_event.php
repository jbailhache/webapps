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

  $follow = $_GET['follow'];

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

   $urlask = $url . "ask_follow_event.php?follow=$follow&myfnick=$myfnick&myurl=$localurl&mypass=$mypass&number=$number";
   $s = get_url ($urlask);
   echo $s;

  }

 }
?>
<p>
<a href=menu.php>Retour au menu principal</a>
</body>
</html>


