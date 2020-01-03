<?php

 include ("platform.php");

 function head()
 {
  echo "
<html>
<head>
<title>Membres</title>
</head>
<body>
";
 }

 session_start();

  $s = connexion();

  $q = "SELECT * FROM " . $prefix . "members";
  $d = query ($q);
  while ($r = fetch_object ($d))
  {
   echo $r->fnick . "/" . $r->nick . ";";
  }

 
?>
