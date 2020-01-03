<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Murs</title>
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
  $localurl = get_local_url ();

  echo "<p><a href=members.php>Retour aux membres</a> - <a href=menu.php>Retour au menu principal</a>";

  $fnick = $_GET['fnick'];
  $url = $_GET['url'];
  $name = $_GET['name'];

  $url1 = treat_string($url);

   $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url'";
   echo "<p>$q";
   $d = query ($q);
   $r = fetch_object ($d);
   if ($r)
   {
    $mypass = $r->pass;

    $urlask = $url . "ask_wall.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&fnick=$fnick&name=" . urlencode($name);
    if (trace()) { echo "<p>urlask='$urlask'"; }
    $s = get_url ($urlask);
    echo $s;

   }

 }
?>
</body>
</html>

