<?php

 include ("platform.php");
 include ("util.php");

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
   $hisfnick = $_GET['hisfnick'];
   $name = $_GET['name'];
   $content = $_GET['content'];
   $content1 = treat_string ($content);

   $q = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '$hisfnick' AND hisfnick = '$myfnick' AND hisurl = '$myurl1'";
   $d = query ($q);
   $rdr = fetch_object ($d);
   if ($rdr)
   {
    $distrec = $rdr->distance;
   }
   else
   {
    $distrec = 40;
   }

   $q = "SELECT * FROM " . $prefix . "walls WHERE fnick = '$hisfnick' AND name = '$name'";
   if (trace()) { echo "<p>$q"; }
   $d = query ($q);
   $r = fetch_object ($d);
   if (!$r)
   {
    echo "<p>Mur non trouv&eacute;";
   }
   else
   {
    /* if ($r->modifiable < $distrec) */
    if (s_visible ($r->modifiable, $distrec))
    {
     echo "<p>Vous n'&ecirc;tes pas autoris&eacute; &agrave; modifier ce mur";
    }
    else
    {
     $q = "UPDATE " . $prefix . "walls SET content = '$content1' WHERE fnick = '$hisfnick' AND name = '$name'";
     if (trace()) { echo "<p>$q"; }
     $s = query ($q);
     echo "<p>Modification enregistr&eacute;e";
    }
   }

  }
?>
