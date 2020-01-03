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

  echo "<p><a href=menu.php>Retour au menu principal</a>";
  echo "<p><h3>Echanges</h3>";

  $text = $_POST['text'];
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

  echo "<p><h4>Offres sur d'autres sites</h4>";
   $qs = "SELECT * FROM " . $prefix . "sites";
   $ds = query ($qs);
   while ($rs = fetch_object ($ds))
   {
    
    $url = $rs->url;
    echo "<p><h4>sur $url :</h4><ul>";

    $localurl = get_local_url();
    $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url'";
    if (trace()) { echo "<p>$q"; }
    $d = query ($q);
    $r = fetch_object ($d);
    if ($r)
    {
     $mypass = $r->pass;
     $etext = urlencode($text);
     $urlask = $url . "ask_offer.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&text=$etext";
     if (trace()) { echo "<p>$urlask"; }
     $s = get_url ($urlask);
     echo $s;
    }   
    echo "</ul>"; 

   }


 }
?>
</body>
</html>

