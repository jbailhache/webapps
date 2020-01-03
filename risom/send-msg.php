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

  $sender = get_fnick($nick);
  $recipientnick = $_POST['recipient'];
  $recipient = get_fnick($_POST['recipient']);
  if (trace()) { echo "<p>(1) recipient='$recipient'"; }
  $subject = $_POST['subject'];
  $body = $_POST['body'];

  $subject1 = treat_string ($subject);
  $body1 = treat_string ($body);

  if (!isset($_POST['url']))
  {

  $q = "INSERT INTO " . $prefix . "messages (sender, sender_url, recipient, subject, body) VALUES ('$sender', '', '$recipient', '$subject1', '$body1')";

 if (trace()) { echo $q; }

 $s = query ($q);

 if (trace()) { echo "<p>" . $s; }

 }
 else
 {
  $url = $_POST['url'];

  $senderurl = get_local_url();
  $encsubject = urlencode($subject);
  $encbody = urlencode($body);
  $myfnick = $sender;

  $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url'";
   if (trace()) { echo "<p>$q"; }
   $d = query ($q);
   $r = fetch_object ($d);
   if ($r)
   {
    $pass = $r->pass;

    if (trace()) { echo "<p>(2) recipient='$recipient'"; }

    $url1 = $url . "send-msg-remote.php?sender=$sender&senderurl=$senderurl&pass=$pass&recipientnick=$recipientnick&subject=$encsubject&body=$encbody";
    if (trace()) { echo $url1; }
    $s = get_url($url1);
    echo $s;
  }
 }


?>
<p>Message envoy&eacute;
<p><a href="messages.php">Retour aux messages</a>
<p><a href="menu.php">Retour au menu principal</a>

<?php
 }
?>

</body>
</html>

