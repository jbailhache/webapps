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
  $nick = $_SESSION['nick'];

  $s = connexion();

  $fnick = get_fnick ($nick);
  $myfnick = $fnick;

  $op = $_GET['op'];
  $name = $_GET['name'];

  if (isset ($_GET['url']))
  {
   $url = $_GET['url'];
  }
  else
  {
   $url = '';
  }
  $url1=treat_string($url);
  if (trace()) { echo "<p>url='$url'"; }

   $localurl = get_local_url();
   $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url1'";
   if (trace()) { echo "<p>$q"; }
   $d = query ($q);
   $r = fetch_object ($d);
   if ($r)
   {
    $mypass = $r->pass;
    $urlask = $url . "ask_group_member.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&op=$op&name=$name";
    echo "<p>$urlask";
    $s = get_url ($urlask);
    echo $s;
   }
   else 
   {
    echo "<p>'$myfnick' n'est pas enregistr&eacute; sur '$url'";
   }
  


  echo "<p><a href=groups.php>Retour aux groupes</a> - <a href=menu.php>Retour au menu principal</a>";

 }
?>
</body>
</html>
