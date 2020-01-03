<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Informations concernant un membre</title>
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
  $s = connexion ();
  $myfnick = get_fnick($mynick);

  $nick = $_POST['nick'];
  $wall = $_POST['wall'];

  $wall1=treat_string($wall);

  if (!isset ($_POST['url']))
  {
   echo "<p>Membre ($nick) local";
   $q = "UPDATE " . $prefix . "members SET wall = '$wall1' WHERE nick = '$nick'";
   $s = query ($q);
  }
  else
  {
   echo "<p>Membre ($nick) distant";
   $url = $_POST['url'];
   $url1=treat_string($url);
   $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url1'";
   echo "<p>$q";
   $d = query ($q);
   $r = fetch_object ($d);
   if ($r)
   {
    echo "<p>Trouv&eacute";
    $mypass = $r->pass;
    $myurl = get_local_url();
    $url = $_POST['url'];
    $encwall = urlencode($wall);
    $urlask = $url . "ask_m_wall.php?myfnick=$myfnick&myurl=$myurl&mypass=$mypass&nick=$nick&encwall=$encwall";
    echo "<p>$urlask";
    $s = get_url ($urlask);
    echo "<p>R&eacute;sultat : <p>$s";
   }  
  }
 
  echo "<p>Modification enregistr&eacute;e";

  echo "<p><a href=menu.php>Retour au menu principal</a>";


 }
?>
</body>
</html>

