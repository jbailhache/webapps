<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Membres</title>
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
  echo " <a href=menu.php>Retour au menu principal</a>";
  echo "<p><h3>Membres locaux : </h3><p>";
  $nick = $_SESSION['nick'];

  $s = connexion();

  $q = "SELECT * FROM " . $prefix . "members";
  $d = query ($q);
  echo "<ul>";
  while ($r = fetch_object ($d))
  {
   echo "<li><a href=member.php?nick=" . $r->nick . ">" . $r->nick . "</a>";
  }
  echo "</ul>";

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
     }
     echo "</ul>";
    }
   }
   catch (Exception $e)
   {
    echo "<p><h3>Site " . $rs->url . " hors service</h3>";
   }
  }

 }
?>
