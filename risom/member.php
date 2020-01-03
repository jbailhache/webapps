<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Informations concernant un membre</title>
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
  echo "<a href=menu.php>Retour au menu principal</a>";
  $mynick = $_SESSION['nick'];

  $s = connexion();

  $myfnick = get_fnick($mynick);

  /* echo "<p>url=(" . $_GET['url'] . ")"; */

  if (!isset ($_GET['url']))
  {

  $q = "SELECT * FROM " . $prefix . "members WHERE nick = '$mynick'";
  $d = query ($q);
  $r = fetch_object ($d);
  $myfnick = $r->fnick;

  $nick = $_GET['nick'];
  $hisnick = $nick;
  $hisfnick = get_fnick($hisnick);
  echo "<p><h2>" . $nick . "</h2>";
?>
  <!-- <p><img src="upload/<?php echo $hisfnick; ?>.jpg" width=600> -->

<?php
  $q = "SELECT * FROM " . $prefix . "members WHERE nick = '$nick'";
  $d = query ($q);
  $r = fetch_object ($d);
  $hisfnick = $r->fnick;

  if ($r->image != '' && $r->image != NULL)
   echo '<p><img src="' . $r->image . '" width=600>';

  $q = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '$myfnick' AND hisfnick = '$hisfnick' AND hisurl = ''";
  $d = query ($q);
  $rd = fetch_object ($d);
  if ($rd)
  {
   $distance = $rd->distance;
  }
  else
  {
   $distance = 40;
  }

  $q = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '$hisfnick' AND hisfnick = '$myfnick' AND hisurl = ''";
  $d = query ($q);
  $rdr = fetch_object ($d);
  if ($rdr)
  {
   $distrec = $rdr->distance;
  }
  else
  {
   $distrec = 40;
  }

  $q = "SELECT * FROM " . $prefix . "comments_members WHERE myfnick = '$myfnick' AND hisfnick = '$hisfnick' AND hisurl = ''";
  $d = query ($q);
  $rc = fetch_object ($d);
  if ($rc)
  {
   $comment = $rc->comment;
  }
  else
  {
   $comment = "";
  }

?>

<p><a href=blog.php?hisfnick=<?php echo $hisfnick; ?>>blog</a>

<p><form method=post action=send-msg.php>
Envoyer un message &agrave; 
<?php echo $hisnick; ?>
<input type=hidden name=recipient value="<?php echo $hisnick; ?>">
<p>
Sujet : 
<input type=text name=subject value="">
<p>
<textarea name=body rows=10 cols=60>
</textarea>
<p>
<input type=submit value="Envoyer">
</form>


<form method=post action=svmember.php>
<p>Distance : 
<input type=text name=distance size=30 value=<?php echo $distance; ?>>
<p>Commentaire : <p><textarea name=comment rows=10 cols=60>
<?php echo $comment; ?>
</textarea>
<input type=hidden name=myfnick value='<?php echo $myfnick; ?>'>
<input type=hidden name=hisfnick value='<?php echo $hisfnick; ?>'>
<input type=hidden name=hisnick value='<?php echo $hisnick; ?>'>
<p><input type=submit value="Modifier">
</form>
<?php
  echo "<h4>Pr&eacute;sentation</h4><p>" . $r->presentation;

  /* if ($r->m_wall >= $distrec) */
  if (is_visible ($r->m_wall, $distrec))
  {
   ?>
<h4>Mur : </h4><form method=post action=m_wall.php>
<p><textarea name=wall rows=10 cols=60>
<?php echo $r->wall; ?>
</textarea>
<input type=hidden name=nick value="<?php echo $hisnick; ?>">
<p><input type=submit value=Modifier>
</form>
<?php
  }
  /* else if  ($r->v_wall >= $distrec)*/
  else if (is_visible ($r->v_wall, $distrec))
  {
   echo "<h4>Mur</h4><p>" . $r->wall;
  }

  $q = "SELECT * FROM " . $prefix . "walls WHERE fnick = '" . $r->fnick . "'";
  $d = query ($q);
  echo "<p><h4>Murs</h4><ul>";
  while ($rwall = fetch_object($d))
  {
   /* if ($rwall->visible >= $distrec) */
   if (is_visible ($rwall->visible, $distrec))
   {
    echo "<li> <a href=display_wall.php?fnick=$hisfnick&name=" . urlencode($rwall->name) . ">" . $rwall->name . "</a>";
   }
  }
  echo "</ul>";

  $q = "SELECT * FROM " . $prefix . "fields WHERE fnick = '" . $r->fnick . "' AND visible >= $distrec";
  $d = query ($q);
  while ($rf = fetch_object($d))
  {
   echo "<p><li> $rf->field : $rf->value";
  }

?>
<form method=post action=friends.php>
<p>Afficher les membres jusqu'&agrave; la distance 
<input type=text name=distance size=3 value="30">
<input type=submit value="Afficher">
<p>(10=moi, 30=amis, 50=membres inscrits sur le m&ecirc;me site, 70: tous sauf ind&eacute;sirables, 90: tous)
</form>
<?php

  echo "<p><h4>Journal</h4><p><ul>";
  $q = "SELECT * FROM " . $prefix . "diary WHERE fnick = '$hisfnick' AND visible > $distrec  ORDER BY date DESC";
  $d = query ($q);
  while ($rdiary = fetch_object($d))
  {
   echo "<li> " . $rdiary->date . " : " . $rdiary->message;
  }
  echo "</ul>";

?>

<p><h4>Inscrit aux rendez-vous : </h4>

<?php

 $q = "SELECT * FROM " . $prefix . "inscriptions_events WHERE fnick = '$hisfnick' AND fnick_url = '' ORDER BY date";
 if (trace()) echo "<p>$q";
 $d = query ($q);
 echo "<ul>";
 while ($r = fetch_object($d))
 {
  $q1 = "SELECT * FROM " . $prefix . "events WHERE number = $r->event";
  if (trace()) echo "<p>$q";
  $d1 = query ($q1);
  while ($r1 = fetch_object($d1))
  {
   $nick = get_nick($r1->fnick);
   echo "<li> " . $r1->day . "/" . $r1->month . "/" . $r1->year . " " . $r1->hour . ":" . $r1->minute . " " . $r1->place . " " . $nick . " <a href=event.php?number=" . $r1->number . ">" . $r1->title . "</a>";
  }
 }
 echo "</ul>";

?>

<p><h4>Echanges</h4>

<?php
   echo "<p>Ce membre a fourni " . (0+$r->given ) . " minutes de services, ";
   echo "a re&ccedil;u " . (0+$r->received) . " minutes de services, ";
   if ($r->given > $r->received)
   {
    echo "et doit recevoir " .  ($r->given - $r->received) . " minutes de services pour &ecirc;tre quitte.";
   }
   else if ($r->received > $r->given)
   {
    echo "et doit fournir " . ($r->received - $r->given) . " minutes de services pour &ecirc;tre quitte.";
   }
   else
   {
    echo "et est quitte.";
   }
?>

<form method=post action=declare_exchange.php>
<input type=hidden name=hisfnick value=<?php echo $hisfnick; ?>>
<p>Je d&eacute;clare avoir b&eacute;n&eacute;fici&eacute; de 
<input type=text name=value size=5 value="">
minutes de service de la part de ce membre le 
<p>jour:<input type=text name=day size=2 value="">
mois:<input type=text name=month size=2 value="">
ann&eacute;e:<input type=text name=year size=4 value="">
pour le service suivant :
<p><textarea name=descr rows=10 cols=60>
</textarea>
<p><input type=submit value=Valider> 
</form>

<?php

   echo "<p><h4>Offres</h4><p><ul>";
   $q = "SELECT * FROM " . $prefix . "offers WHERE fnick = '$hisfnick'";
   if (trace()) { echo "<p>$q"; }
   $d = query($q);
   while ($r=fetch_object($d))
   {
    echo "<li> " . $r->descr;
   }
   echo "</ul>";

   echo "<p><h4>Demandes</h4><p><ul>";
   $q = "SELECT * FROM " . $prefix . "needs WHERE fnick = '$hisfnick'";
   if (trace()) { echo "<p>$q"; }
   $d = query($q);
   while ($r=fetch_object($d))
   {
    echo "<li> " . $r->descr;
   }
   echo "</ul>";

   echo "<p><h4>Services re&ccedil;us</h4><ul>";
   $q = "SELECT * FROM " . $prefix . "exchanges WHERE tofnick = '$hisfnick'";
   $d = query ($q);
   while ($r = fetch_object($d))
   {
    $bynick = get_nick ($r->byfnick);
    if ($bynick == "")
    {
     $bynick = $r->byfnick;
    }
    if ($r->byurl == "")
    {
     $byurl = "";
    }
    else
    {
     $byurl = "sur " . $r->byurl;
    }
    echo "<li> de $bynick $byurl le " . $r->day . "/" . $r->month . "/" . $r->year . " : " . $r->value . " minutes : " . $r->descr;
   }
   echo "</ul>";

   echo "<p><h4>Services rendus</h4><ul>";
   $q = "SELECT * FROM " . $prefix . "exchanges WHERE byfnick = '$hisfnick'";
   $d = query ($q);
   while ($r = fetch_object($d))
   {
    $tonick = get_nick ($r->tofnick);
    if ($r->tourl == "")
    {
     $tourl = "";
    }
    else
    {
     $tourl = "sur " . $r->tourl;
    }
    echo "<li> &agrave; $tonick $tourl le " . $r->day . "/" . $r->month . "/" . $r->year . " : " . $r->value . " minutes : " . $r->descr;
   }

   echo "<p>Services rendus &agrave; des membres inscrits sur d'autres sites";

   $qs = "SELECT * FROM " . $prefix . "sites";
   $ds = query ($qs);
   while ($rs = fetch_object ($ds))
   {
    
    $url = $rs->url;
    echo "<p>$url";


    $localurl = get_local_url();
    $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url'";
    if (trace()) { echo "<p>$q"; }
    $d = query ($q);
    $r = fetch_object ($d);
    if ($r)
    {
     $mypass = $r->pass;
     $urlask = $url . "ask_exchanges.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&hisfnick=$hisfnick&hisurl=$localurl";
     if (trace()) { echo "<p>$urlask"; }
     $s = get_url ($urlask);
     echo $s;
    }    

   }

   echo "</ul>";

   
  }
  else
  {
   $url = $_GET['url'];
   $fnick = $_GET['fnick'];
   $nick = $_GET['nick'];
   
   echo "<p><h3>$nick sur $url</h3>";

   $localurl = get_local_url();

   $url1=treat_string($url);
   $q = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '$myfnick' AND hisfnick = '$fnick' AND hisurl = '$url1'";
   if (trace()) echo "<p>$q";
   $d = query ($q);
   $rd = fetch_object ($d);
   if ($rd)
   {
    $distance = $rd->distance;
   }
   else
   {
    $distance = 40;
   }

   $q = "SELECT * FROM " . $prefix . "comments_members WHERE myfnick = '$myfnick' AND hisfnick = '$hisfnick' AND hisurl = '$url1'";
   $d = query ($q);
   $rc = fetch_object ($d);
   if ($rc)
   {
    $comment = $rc->comment;
   }
   else
   {
    $comment = "";
   }

   $enc_comment = urlencode($comment);

   $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url1'";
   if (trace()) echo "<p>$q";
   $d = query ($q);
   $r = fetch_object ($d);
   if ($r)
   {
    $mypass = $r->pass;
    $urlask = $url . "ask_member.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&fnick=$fnick&nick=$nick&distance=$distance&comment=$enc_comment";
    if (trace()) { echo "<p>$urlask"; }
    $s = get_url ($urlask);
    echo $s;

    $hisurl = $url;
    $hisfnick = $fnick;

   /* echo "<p><h4>Services rendus</h4><ul>"; */
   echo "<p><ul>";
   $q = "SELECT * FROM " . $prefix . "exchanges WHERE byfnick = '$hisfnick'";
   $d = query ($q);
   while ($r = fetch_object($d))
   {
    $tonick = get_nick ($r->tofnick);
    if ($r->tourl == "")
    {
     $tourl = "";
    }
    else
    {
     $tourl = "sur " . $r->tourl;
    }
    echo "<li> &agrave; $tonick $tourl le " . $r->day . "/" . $r->month . "/" . $r->year . " : " . $r->value . " minutes : " . $r->descr;
   }

   echo "<p>Services rendus &agrave; des membres inscrits sur d'autres sites";

   $qs = "SELECT * FROM " . $prefix . "sites";
   $ds = query ($qs);
   while ($rs = fetch_object ($ds))
   {
    
    $url = $rs->url;
    echo "<p>$url";

    $localurl = get_local_url();
    $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url'";
    if (trace()) { echo "<p>$q"; }
    $d = query ($q);
    $r = fetch_object ($d);
    if ($r)
    {
     $mypass = $r->pass;
     $urlask = $url . "ask_exchanges.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&hisfnick=$hisfnick&hisurl=$hisurl";
     if (trace()) { echo "<p>$urlask"; }
     $s = get_url ($urlask);
     echo $s;
    }    

   }

   }
   else 
   {
    echo "<p>'$myfnick' n'est pas enregistr&eacute; sur '$url'";
   }
  }

 }
?>
