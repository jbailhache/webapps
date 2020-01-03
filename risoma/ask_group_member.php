<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Groupes</title>
</head>
<body>
";
 }

  session_start();

  $s = connexion();

  $myfnick = $_GET['myfnick'];
  $myurl = $_GET['myurl'];
  $mypass = $_GET['mypass'];
  $url = get_local_url();

  $myurl1 = treat_string ($myurl);
  $mypass1 = treat_string ($mypass);
  $url1 = treat_string($url);

  $q = "SELECT * FROM " . $prefix . "incoming WHERE fnick = '$myfnick' AND url = '$myurl1' AND pass = '$mypass1'";
  $d = query ($q);
  $r = fetch_object ($d);
  if (!$r)
  {
   echo "<p>Identification incorrecte.";
  }
  else
  {
  $op = $_GET['op'];
  $name = $_GET['name'];
  $name1 = treat_string ($name);

  if ($op == "leave")
  {
   $q = "DELETE FROM " . $prefix . "groups_members WHERE groupname = '$name1' AND fnick = '$myfnick' AND url = '$myurl1'";
   if (trace()) { echo "<p>$q"; }
   $s = query ($q);
   echo "<p>Vous n'&ecirc;tes plus membre du groupe $name.";
  }
  else if ($op == "join")
  {
   $q = "INSERT INTO " . $prefix . "groups_members (groupname, fnick, url, distance) VALUES ('$name1', '$myfnick', '$myurl1', 20)";
   if (trace()) { echo "<p>$q"; }
   $s = query ($q);
   echo "<p>Vous &ecirc;tes d&eacute;sormais membre du groupe $name.";
  }

  }
 
?>
