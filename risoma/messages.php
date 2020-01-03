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
?>

<form method=post action=send-msg.php>
Envoyer un message &agrave;
<input type=text name=recipient value="">
<p>
Sujet : 
<input type=text name=subject value="">
<p>
<textarea name=body rows=10 cols=60>
</textarea>
<p>
<input type=submit value="Envoyer">
</form>

<?php
 
 $q = "SELECT * FROM " . $prefix . "messages WHERE recipient = '$myfnick'";
 $d = query($q);
 echo "<ul>";
 while ($r=fetch_object($d))
 {
  if ($r->subject == "")
  {
   $subject = "pas de sujet";
  }
  else
  {
   $subject = $r->subject;
  }
  $dt = preg_split ('/ /',$r->date);
  $date = $dt[0];
  $time = $dt[1];
  if ($r->sender_url)
  {
   $site = '';
  }
  else
  {
   $site = " sur " . $r->sender_url;
  }
  echo "<li> " . $r->date . " " ;

  /* to do: ask sender fnick to remote site */
  $nick = get_nick($r->sender);
  if ($nick == '')
  {
   echo $r->sender;
  }
  else
  {
   echo $nick;
  }

  echo $site . " <a href=message.php?sender=" . $r->sender  . "&senderurl=" . $r->sender_url . "&date=$date&time=$time>" . $subject . "</a>";
 }
 echo "</ul>";

 }
?>
</body>
</html>

