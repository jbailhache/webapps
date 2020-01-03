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

  $dt = $_GET['date'] . " " . $_GET['time'];
  $dt1=treat_string($dt);
  $q = "SELECT * FROM " . $prefix . "messages WHERE recipient='$myfnick' AND date='$dt1'";
  echo $q;
  $d = query($q);
  $r = fetch_object($d);
  echo "<p><a href=messages.php>Retour aux messages</a>";
  echo "<p><a href=menu.php>Retour au menu principal</a>";
  echo "<p>Message de ";
  $nick = get_nick($r->sender);
  if ($nick=='')
  {
   echo $r->sender;
  }
  else
  {
   echo $nick;
  }
  /* to do: ask sender fnick to rete site */
  if ($r->sender_url != '')
  {
   echo " sur " . $r->sender_url;
  }
  echo "<p>envoy&eacute; le " . $r->date;
  echo "<p>Sujet: " . $r->subject;
  echo "<p><a href=del-msg.php?sender=" . $r->sender . "&date=" . $_GET['date'] . "&time=" . $_GET['time'] . ">Supprimer</a>";
  echo "<p>" . $r->body;
 
 }
?>
</body>
</html>
