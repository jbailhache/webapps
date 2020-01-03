<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Menu principal</title>
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

  $myfnick = $_POST['myfnick'];
  $hisfnick = $_POST['hisfnick'];
  $distance = $_POST['distance'];
  $comment = $_POST['comment'];
  $hisnick = $_POST['hisnick'];
  if (isset ($_POST['hisurl']))
  {
   $hisurl = $_POST['hisurl'];
  }
  else
  {
   $hisurl = "";
  }
  
  $comment1 = treat_string ($comment);

  $hisurl1=treat_string($hisurl);
  $q = "SELECT * FROM " . $prefix . "distances WHERE myfnick='$myfnick' AND hisfnick = '$hisfnick' AND hisurl = '$hisurl1'";
  if (trace()) { echo "<p>$q"; }
  $d = query ($q);
  $r = fetch_object ($d);
  if ($r)
  {
   $q = "UPDATE " . $prefix . "distances SET distance=$distance WHERE myfnick='$myfnick' AND hisfnick = '$hisfnick' AND hisurl = '$hisurl1'";
   if (trace()) { echo "<p>" . $q; } 
   $s = query ($q);
  }
  else
  {
   $q = "INSERT INTO " . $prefix . "distances (myfnick, hisfnick, hisurl, distance) VALUES ('$myfnick', '$hisfnick', '$hisurl', $distance)";
   if (trace()) { echo "<p>" . $q; } 
   $s = query ($q);
  }

  $q = "SELECT * FROM " . $prefix . "comments_members WHERE myfnick='$myfnick' AND hisfnick = '$hisfnick' AND hisurl = '$hisurl'";
  $d = query ($q);
  $r = fetch_object ($d);
  if ($r)
  {
   $q = "UPDATE " . $prefix . "comments_members SET comment='$comment1' WHERE myfnick='$myfnick' AND hisfnick = '$hisfnick' AND hisurl = '$hisurl1'";
   /* echo "<p>" . $q; */ 
   $s = query ($q);
  }
  else
  {
   $q = "INSERT INTO " . $prefix . "comments_members (myfnick, hisfnick, hisurl, comment) VALUES ('$myfnick', '$hisfnick', '$hisurl1', '$comment1')";
   /* echo "<p>" . $q; */ 
   $s = query ($q);
  }
 }
?>
<p>Modification enregistr&eacute;e
<p><a href="member.php?nick=<?php echo $hisnick; ?>>Retour</a>

</body>
</html>

