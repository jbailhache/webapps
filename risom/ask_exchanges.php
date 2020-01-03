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
  $hisfnick = $_GET['hisfnick'];
  $hisurl = $_GET['hisurl'];

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
   

   $q = "SELECT * FROM " . $prefix . "exchanges WHERE byfnick = '$hisfnick' AND byurl = '$hisurl'";

   if (trace()) { echo "<p>$q"; }
   $d = query ($q);
   while ($r = fetch_object($d))
   {
    $tonick = get_nick ($r->tofnick);
    if ($r->tourl == "")
    {
     $tourl = "sur $localurl";
    }
    else
    {
     $tourl = "sur " . $r->tourl;
    }
    echo "<li> &agrave; $tonick $tourl le " . $r->day . "/" . $r->month . "/" . $r->year . " : " . $r->value . " minutes : " . $r->descr;
   }

  }
?>
</body>
</html>


