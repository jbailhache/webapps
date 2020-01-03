<?php

 include ("platform.php");

 function head()
 {
  echo "
<html>
<head>
<title>Sites</title>
</head>
<body>
";
 }

 session_start();

  $s = connexion();

  echo "SITES:";

  $q = "SELECT * FROM " . $prefix . "sites";
  $d = query ($q);
  while ($r = fetch_object ($d))
  {
   echo $r->url . ";";
  }

 
?>
