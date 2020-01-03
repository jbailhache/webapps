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

  $s = connexion();

  $localurl = get_local_url();

  $myfnick = $_GET['myfnick'];
  $myurl = $_GET['myurl'];
  $mypass = $_GET['mypass'];
  
  $myurl1 = treat_string ($myurl);
  $mypass1 = treat_string ($mypass);

  $q = "SELECT * FROM " . $prefix . "incoming WHERE fnick = '$myfnick' AND url = '$myurl1' AND pass = '$mypass1'";
  $d = query ($q);
  $r = fetch_object ($d);
  if (!$r)
  {
   echo "<p>Identification incorrecte.";
  }
  else
  {
   if (trace()) { echo "<p>Identification correcte"; }
   
  $text = urldecode($_GET['text']);
  $q = "SELECT * FROM " . $prefix . "offers";
  $d = query ($q);
  echo "<h4>Offres sur ce site</h4><ul>";
  while ($r = fetch_object($d))
  {
   if (preg_match ('`' . $text . '`', $r->descr))
   {
    $nick = get_nick ($r->fnick);
    echo "<li> $nick : " . $r->descr;
   }
  }
  echo "</ul>";
 }
?>
</body>
</html>

