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
 

  $s = connexion();

  $myfnick = $_GET['sender'];
  $myurl = $_GET['senderurl'];
  $mypass = $_GET['pass'];

  $myurl1=treat_string($myurl);
  $mypass1=treat_string($mypass);

  $q = "SELECT * FROM " . $prefix . "incoming WHERE fnick = '$myfnick' AND url = '$myurl1' AND pass = '$mypass1'";
  if (trace()) { echo "<p>$q"; }
  $d = query ($q);
  $r = fetch_object ($d);
  if (!$r)
  {
   echo "<p>Identification incorrecte.";
  }
  else
  {
  $recipient = $_GET['recipient'];

  if (trace()) { echo "<p>recipient='$recipient'"; }

  $sender = $_GET['sender'];
  $senderurl = $_GET['senderurl'];
  $recipientnick = $_GET['recipientnick'];
  $recipient = get_fnick($recipientnick);
  $subject = $_GET['subject'];
  $body = $_GET['body'];

  $subject1 = treat_string ($subject);
  $body1 = treat_string ($body);

  $q = "INSERT INTO " . $prefix . "messages (sender, sender_url, recipient, subject, body) VALUES ('$sender', '$senderurl', '$recipient', '$subject1', '$body1')";

 if (trace()) { echo $q; }

 $s = query ($q);

 if (trace()) { echo "<p>" . $s; }

 
 }
?>
</body>
</html>
