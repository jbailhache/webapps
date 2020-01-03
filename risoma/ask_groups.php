<?php

 include ("platform.php");

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

  $q = "SELECT * FROM " . $prefix . "groups";
  $d = query ($q);
  echo "GROUPS:";
  while ($r = fetch_object ($d))
  {
   echo $r->name . ";";
  }

 
?>
