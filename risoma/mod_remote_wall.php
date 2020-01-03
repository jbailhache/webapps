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
  $localurl = get_local_url();

  $hisfnick = $_POST['hisfnick'];
  $hisurl = $_POST['hisurl'];
  $name = $_POST['name'];
  $content = $_POST['content']; 

  $hisurl1=treat_string($hisurl);

  $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$hisurl1'";
  echo "<p>$q";
  $d = query ($q);
  $r = fetch_object ($d);
  if ($r)
  {
    $mypass = $r->pass;
    $urlask = $hisurl . "ask_mod_wall.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&hisfnick=$hisfnick&name=" . urlencode($name) . "&content=" . urlencode($content);
    if (trace()) { echo "<p>urlask='$urlask'"; }
    $s = get_url ($urlask);
    if (trace()) { echo "<p>R&eacute;sultat:"; }
    echo $s;
  }
 }

?>
<p>
<a href=members.php>Retour aux membres</a> -
<a href=menu.php>Retour au menu principal</a>
</body>
</html>


