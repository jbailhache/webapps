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

 $s = session_start();
 if (trace()) echo "<p>session_start -> ($s)";
 if(!isset($_SESSION['nick'])) 
 {
  head();
  echo "<p>Vous n'&ecirc;tes pas identifi&eacute;<p><a href=index.php>Cliquez ici pour vous identifier</a>";
  if (trace()) { echo "<p>"; print_r($_SESSION); }
 }
 else
 {
  head();
  echo "<p><h3>Je suis " . $_SESSION['nick'] . "</h3>";
  $mynick = $_SESSION['nick'];

  $s = connexion();
 
  $q = "SELECT * FROM " . $prefix . "members WHERE nick = '$mynick'";
  $d = query ($q);
  $r = fetch_object ($d);
  $myfnick = $r->fnick;

  $distance = $_POST['distance'];
  $subject= $_POST['subject'];
  $body = $_POST['body'];
  echo "<p>body='$body'";

  $subject1 = treat_string ($subject);
  $body1 = treat_string ($body);
  echo "<p>body1='$body1'";

  $q = "SELECT * FROM " . $prefix . "members";
  $d = query ($q);
  while ($r = fetch_object ($d))
  {
   $dist = get_distance ($myfnick, $r->fnick);
   if (is_visible ($distance, $dist))
   {
    $q = "INSERT INTO " . $prefix . "messages (sender, sender_url, recipient, subject, body) VALUES ('$myfnick', '', '$r->fnick', '$subject1', '$body1')";
    if (trace()) { echo $q; }
    $s = query ($q);
    if (trace()) { echo "<p>" . $s; }
   }
  }

  $qs = "SELECT * FROM " . $prefix . "sites";
  $ds = query ($qs);
  while ($rs = fetch_object ($ds))
  {
   /* echo "<p>" . $rs->url; */
   try
   {
    $members_string = @file_get_contents ($rs->url . "raw_members.php");
    if (trace()) echo "<p>members_string=($members_string)" . ord($members_string);
    /* echo "<p>" . $members_string; */

    if (ord($members_string) == 13)
    {
     $members_string = substr ($members_string, 1);
    }

    if (ord($members_string) == 10)
    {
     $members_string = substr ($members_string, 1);
    }

    if (! $members_string)
    {
     echo "<p><h3>Site " . $rs->url . " hors service</h3>";
    }
    else
    {
     $members_array = preg_split ('/;/', $members_string);
     echo "<p><h3>Membres sur " . $rs->url . " :</h3><ul>";
     for ($i=0; $i<count($members_array)-1; $i++)
     {
      $a = preg_split ('/\//', $members_array[$i]);
      $fnick = $a[0];
      $nick = $a[1];
      if (trace()) echo "***test***";
      if (trace()) echo "<p>fnick=($fnick) nick=($nick)";
      echo "<li> <a href=member.php?url=" . $rs->url . "&fnick=" . $fnick . "&nick=" . $nick . ">" . $nick . "</a>";

      $dist = get_distance_remote ($myfnick, $fnick, $rs->url);
      if (is_visible ($distance, $dist))
      {
        $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$rs->url'";
        if (trace()) { echo "<p>$q"; }
        $d = query ($q);
        $r = fetch_object ($d);
        if ($r)
        {
         $pass = $r->pass;

         if (trace()) { echo "<p>(2) recipient='$recipient'"; }

         $myurl = get_local_url();
         $subject2 = urlencode ($subject1);
         $body2 = urlencode ($body1);
         $url1 = $rs->url . "send-msg-remote.php?sender=$myfnick&senderurl=$myurl&pass=$pass&recipientnick=$fnick&subject=$subject2&body=$body2";
         if (trace()) { echo $url1; }
         echo $url1;
         $s = get_url($url1);
         echo $s;
       }
      }
     }
     echo "</ul>";
    }
   }
   catch (Exception $e)
   {
    echo "<p><h3>Site " . $rs->url . " hors service</h3>";
   }
  }


  echo "<p>Message diffus&eacute;";
  
 }
?>
<p><a href="menu.php">Retour au menu principal</a>
</body>
</html>
