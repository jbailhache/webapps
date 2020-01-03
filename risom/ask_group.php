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

  $s = connexion();

  $myfnick = $_GET['myfnick'];
  $myurl = $_GET['myurl'];
  $mypass = $_GET['mypass'];
  $nick = $_GET['nick'];
  /* $fnick = get_fnick($nick); */
  $fnick = $_GET['fnick'];
  $localurl = get_local_url();
  $name = $_GET['name'];


  $myurl1 = treat_string ($myurl);
  $mypass1 = treat_string ($mypass);
  $localurl1 = treat_sring($localurl);
  $name1 = treat_string ($name);

  $hisfnick = $fnick;

  $q = "SELECT * FROM " . $prefix . "incoming WHERE fnick = '$myfnick' AND url = '$myurl1' AND pass = '$mypass1'";
  $d = query ($q);
  $r = fetch_object ($d);
  if (!$r)
  {
   echo "<p>Identification incorrecte.";
  }
  else
  {
   $q = "SELECT * FROM " . $prefix . "groups WHERE name = '$name1'";
   $d = query ($q);
   $r = fetch_object ($d);
   if (!$r)
   {
    echo "<p>Pas de groupe nomm&eacute; $name sur ce site"; 
   }
   else
   {
    
   echo "<p>" . $r->descr;

   if (is_member_remote ($r->name, $myfnick, $myurl))
   {
    echo "<p><a href=group_member_remote.php?op=leave&myfnick=$myfnick&myurl=$myurl&url=$localurl&name=" . $r->name . ">Quitter</a>";
   }
   else
   {
    echo "<p><a href=group_member_remote.php?op=join&myfnick=$myfnick&myurl=$myurl&url=$localurl&name=" . $r->name . ">Rejoindre</a>";
   }

/*
   if ($r->fnick == $fnick)
   {
    echo "<p><a href=mod_grp.php?name=" . $r->name . ">Modifier</a>";
   }
*/

   echo "<p><h4>Membres : </h4><p><ul>";
  $q = "SELECT * FROM " . $prefix . "groups_members WHERE groupname = '" . treat_string($r->name) . "'";
   $d = query ($q);
   while ($r = fetch_object($d))
   {
    $nick = get_nick ($r->fnick);
    $url = $r->url;
    /* echo "<p><li> $nick "; */
    if ($url == '')
     $url1 = get_local_url();
    else if ($url == $myurl)
     $url1 = '';
    else
     $url1 = $url; 
    if (trace()) echo "<p>url1=($url1)";
    if ($url1 == '')
     echo "<li> <a href=member.php?fnick=" . $r->fnick . "&nick=" . $nick . ">" . $nick . "</a>";
    else
     echo "<li> <a href=member.php?url=" . $url1 . "&fnick=" . $r->fnick . "&nick=" . $nick . ">" . $nick . "</a>";
    if ($url != '')
    {
     echo " sur $url";
    }
   
    }
    echo "</ul>";

  echo "<p><h4>Rendez-vous sur ce site : </h4><p>";

  $q = "SELECT * FROM " . $prefix . "events ORDER BY year, month, day, hour, minute";
  $d = query ($q);
  echo "<p><ul>";
  while ($r = fetch_object($d))
  {
   $nick = get_nick ($r->fnick);

   if (is_member ($name, $r->fnick))
   {
   /* 
   $q1 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $r->number AND fnick = '$myfnick'";
   $d1 = query ($q1);
   $r1 = fetch_object ($d1);
   */

   $q1 = "SELECT * FROM " . $prefix . "inscriptions_events WHERE event = $r->number ORDER BY date";
   $d1 = query ($q1);
   $i = 0;
   $found = 0;
   while ($r1 = fetch_object ($d1))
   {
    $i = $i + 1;
    if ($r1->fnick == $myfnick)
    {
     $found = 1;
     break;
    }
   }
   echo "<p><li> " . $r->day . "/" . $r->month . "/" . $r->year . " " . $r->hour . ":" . $r->minute . " " . $r->place . " " . $nick . " <a href=event.php?number=" . $r->number . ">" . $r->title . "</a>";

   if ($found)
   {
    if ($i <= $r->np)
    {
     echo " inscrit";
    }
    else
    {
     echo " en liste d'attente";
    }
   }
   }
  }
  echo "</ul>";
 
  $qs = "SELECT * FROM " . $prefix . "sites";
  $ds = query ($qs);
  while ($rs = fetch_object ($ds))
  {
   /* echo "<p>" . $rs->url; */
   try
   {
    $url = $rs->url;
    $url1 = treat_string($url);
    $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url1'";
    if (trace()) { echo "<p>$q"; }
    $d = query ($q);
    $r = fetch_object ($d);
    if ($r)
    {
     $mypass = $r->pass;

     $urlask = $rs->url . "ask_events_group.php?group=$name&myfnick=$myfnick&myurl=$localurl&mypass=$mypass";
     if (trace()) echo "<p>$urlask";
     $s = get_url ($urlask);
     echo $s;

    }
   }
   catch (Exception $e)
   {
    echo "<p><h3>Site " . $rs->url . " hors service</h3>";
   }
  }



   }
 
  }

 
?>
