<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Echanges</title>
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
  $myfnick = get_fnick($mynick);

  echo "<p><a href=members.php>Retour aux membres</a> - <a href=menu.php>Retour au menu principal</a>";
  echo "<p><h3>Echanges</h3>";

  if (isset($_POST['myurl']))
  {
   $myurl = $_POST['myurl'];
  }
  else
  {
   $myurl = "";
  }
  if (isset($_POST['hisurl']))
  {
   $hisurl = $_POST['hisurl'];
  }
  else
  {
   $hisurl = "";
  }
  $hisfnick = $_POST['hisfnick'];
  $value = $_POST['value'];
  $day = $_POST['day'];
  $month = $_POST['month'];
  $year = $_POST['year'];
  $descr = $_POST['descr'];

  $q = "INSERT INTO " . $prefix . "exchanges (tofnick, tourl, byfnick, byurl, value, day, month, year, descr) VALUES ('$myfnick', '$myurl', '$hisfnick', '$hisurl', $value, $day, $month, $year, '$descr')";
  if (trace()) { echo "<p>$q"; }
  $s = query ($q);

  $qme = "SELECT * FROM " . $prefix . "members WHERE fnick = '$myfnick'";
  if (trace()) { echo "<p>$qme"; }
  $dme = query ($qme);
  $rme = fetch_object ($dme);
  if ($rme)
  {
   $qhe = "SELECT * FROM " . $prefix . "members WHERE fnick = '$hisfnick'";
   if (trace()) { echo "<p>$qhe"; }
   $dhe = query ($qhe);
   $rhe = fetch_object ($dhe);
   if (!$rhe)
   {
    echo "<p>Membre '$hisfnick' non trouv&eacute;'";
   }
   else
   {
    $q = "UPDATE " . $prefix . "members SET received = " . ($rme->received + $value) . " WHERE fnick = '$myfnick'";
    $s = query ($q);
    $q = "UPDATE " . $prefix . "members SET given = " . ($rhe->given + $value) . " WHERE fnick = '$hisfnick'";
    $s = query ($q);
   }
  }
  else
  {
   echo "<p>Membre '$myfnick' non trouv&eacute; sur le site local";

   $localurl = get_local_url();

   $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$hisurl'";
   echo "<p>$q";
   $d = query ($q);
   $r = fetch_object ($d);
   if ($r)
   {
    $mypass = $r->pass;
    $urlask = $hisurl . "ask_declare_exchange.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&hisfnick=$hisfnick&hisurl=$hisurl&value=$value&day=$day&month=$month&year=$year&descr=$descr";
    if (trace()) { echo "<p>$urlask"; }
    $s = get_url ($urlask);
    echo $s;
   }
   else 
   {
    echo "<p>'$myfnick' n'est pas enregistr&eacute; sur '$url'";
   }

  }
  


  echo "<p>D&eacute;claration enregistr&eacute;e";
  

 }
?>
</body>
</html>

