<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Groupes</title>
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

  $fnick = get_fnick ($nick);
  $myfnick = $fnick;

  echo "<p><a href=groups.php>Retour aux groupes</a> - <a href=menu.php>Retour au menu principal</a>";

  $name = $_GET['name'];

  $localurl = get_local_url();

  if (!isset($_GET['url']))
  {
   $name1 = treat_string ($name);
   $q = "SELECT * FROM " . $prefix . "groups WHERE name = '$name1'";
   $d = query ($q);
   $r = fetch_object ($d);
   echo "<p><h4>Groupe " . $r->name . "</h4><p>" . $r->descr;

   if (is_member ($r->name, $fnick))
   {
    echo "<p><a href=group_member.php?op=leave&name=" . $r->name . ">Quitter</a>";
   }
   else
   {
    echo "<p><a href=group_member.php?op=join&name=" . $r->name . ">Rejoindre</a>";
   }

   if ($r->fnick == $fnick)
   {
    echo "<p><a href=mod_grp.php?name=" . $r->name . ">Modifier</a>";
   }

   echo "<p><h4>Membres :</h4><p><ul>";
  $q = "SELECT * FROM " . $prefix . "groups_members WHERE groupname = '" .   treat_string ( $r->name ) . "'";
   $d = query ($q);
   while ($r = fetch_object($d))
   {
    $nick = get_nick ($r->fnick);
    /* echo "<p><li> $nick"; */
    echo "<li> <a href=member.php?fnick=" . $r->fnick . "&nick=" . $nick . ">" . $nick . "</a>";
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
  else
  {
   $url = $_GET['url'];
   $url1=treat_string($url);
   echo "<p><h3>Groupe $name sur $url : </h3>";

   $localurl = get_local_url();

   $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url1'";
   echo "<p>$q";
   $d = query ($q);
   $r = fetch_object ($d);
   if ($r)
   {
    $mypass = $r->pass;
    $urlask = $url . "ask_group.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&name=$name";
    echo "<p>$urlask";
    $s = get_url ($urlask);
    echo $s;
   }
   else 
   {
    echo "<p>Le groupe '$name' n'existe pas sur '$url'";
   }

  }

 }
?>
</body>
</html>

