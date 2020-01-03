<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Messagerie</title>
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
  $myfnick = get_fnick($nick);
  $sender = $_GET['sender'];
  $dt = $_GET['date'] . " " . $_GET['time'];

  $q = "DELETE FROM " . $prefix . "messages WHERE recipient = '$myfnick' AND sender = '$sender' AND date = '$dt'";
  echo $q;
  $s = query($q);
?>
<p>Message supprim&eacute;
<p><a href=messages.php>Retour aux messages</a>
<a href=menu.php>Retour au menu principal</a>

<?php

 }

?>
</body>
</html>
