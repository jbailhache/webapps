<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-15\" />
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
  $nick = $_SESSION['nick'];

  $s = connexion();
 
  $q = "SELECT * FROM " . $prefix . "members WHERE nick = '$nick'";
  $d = query ($q);
  $r = fetch_object ($d);
  $fnick = $r->fnick;
  $wall = $r->wall;

  if (isset($_POST['wall']))
  {
   $wall = $_POST['wall'];
   $wall1 = treat_string($wall);
   $v_wall = $_POST['v_wall'];
   $m_wall = $_POST['m_wall'];
   $q = "UPDATE " . $prefix . "members SET wall = '$wall1', v_wall = $v_wall, m_wall = $m_wall WHERE nick = '$nick'";
   /* echo $q; */
   $s = query ($q);
  }
  else
  {
   $wall = $r->wall;
   $v_wall = $r->v_wall;
   $m_wall = $r->m_wall;
  }

  if (isset($_POST['message']) && ($_POST['message'] != ""))
  {
   $message = $_POST['message'];
   $message1 = treat_string ($message);
   $visible = $_POST['visible'];
   $q = "INSERT INTO " . $prefix . "diary (fnick, message, visible) VALUES ('$fnick', '$message1', '$visible')";
   $s = query ($q); 
  }
  ?>

<p><li><a href=doc.htm>Documentation</a>

<p><li><a href=risom.zip>T&eacute;l&eacute;chargement</a>

<p><li><a href=walls.php>Murs</a>

<p><li><a href=messages.php>Messagerie</a>

<p><li><a href=profil.php>Modifier mon profil</a>

<p><li><a href=members.php>Membres</a>

<p><li><a href=groups.php>Groupes</a>

<form method=post action=events_interval.php>
<p><li>Rendez-vous entre J + <input type=text name=eventssince size=3 value="-1">
et J + <input type=text name=eventsuntil size=3 value="8">
<input type=submit value="Afficher">
</form>

<form method=post action=agenda_interval.php>
<p><li>Agenda entre J + <input type=text name=eventssince size=3 value="-1">
et J + <input type=text name=eventsuntil size=3 value="8">
<input type=submit value="Afficher">
</form>

<p><li><a href=events_date.php>Rendez-vous class&eacute;s par date</a>

<p><li><a href=events_future.php>Rendez-vous &agrave; venir</a>

<p><li><a href=events_past.php>Rendez-vous pass&eacute;s</a>

<p><li><a href=events.php>Rendez-vous class&eacute;s par site</a>

<p><li><a href=cre_evnt.php>Cr&eacute;er un rendez-vous</a>

<p><li><a href=exchanges.php>Echanges</a>

<?php
 if ($nick == 'webmaster')
 {
  echo "<p><li><a href=sites.php>Gestion des sites</a>";
 }
?>

<!--
<p><img src="upload/<?php echo $fnick; ?>.jpg" width=600>
-->

<?php
 if ($r->image != '' && $r->image != NULL)
  echo '<p><img src="' . $r->image . '" width=600>';
?>

<p>Envoyer une image :<p>

<form method="POST" action="upload.php" enctype="multipart/form-data">
     <!-- On limite le fichier à 100Ko -->
     <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
     Fichier : <input type="file" name="image">
     <input type="submit" name="envoyer" value="Envoyer le fichier">
</form>


<p><li>Mon mur :
<form method=post action=menu.php>
<p>
<textarea name=wall rows=10 cols=60>
<?php echo $wall; ?>
</textarea>
<p>Visibilit&eacute; 
<input type=text name=v_wall size=30 value=<?php echo $v_wall; ?>>
 Modifiabilit&eacute; 
<input type=text name=m_wall size=30 value=<?php echo $m_wall; ?>>
<p>(10=moi, 30=amis, 50=membres inscrits sur le m&ecirc;me site, 70: tous sauf ind&eacute;sirables, 90: tous)
<p><input type=submit value="Modifier">
</form>

<p>

<p><li>Ecrire dans mon journal :
<p>
<form method=post action=menu.php>
<textarea name=message rows=10 cols=60>
</textarea>
<p>visibilit&eacute;  
<input type=text name=visible size=30 value="70">

<p><input type=submit value="Envoyer">
</form>

<li>Mon journal (10 derni&egrave;s notes) :
<?php
 $q = "SELECT * FROM " . $prefix . "diary WHERE fnick = '$fnick' ORDER BY date DESC";
 $d = query ($q);
 $i = 0;
 echo "<ul>";
 while (($r = fetch_object ($d)) && $i < 10)
 {
  echo "<li> " . $r->date . " : " . $r->message;
  $dt = preg_split ('/ /',$r->date);
  $date = $dt[0];
  $time = $dt[1];
  echo " - <a href=delete_from_diary.php?date=$date&time=$time>Effacer</a>";
 }
 echo "</ul>";
?>

<form method=post action=diary.php>
<p><li> Afficher le journal des membres jusqu'&agrave; la distance
<input type=text name=distance size=30 value="30">
<p>(10=moi, 30=amis, 50=membres inscrits sur le m&ecirc;me site, 70: tous sauf ind&eacute;sirables, 90: tous)
<p>entre le 
jour:<input type=text name=fromday size=2 value="">
mois:<input type=text name=frommonth size=2 value="">
ann&eacute;e:<input type=text name=fromyear size=4 value="">
et le
jour:<input type=text name=untilday size=2 value="">
mois:<input type=text name=untilmonth size=2 value="">
ann&eacute;e:<input type=text name=untilyear size=4 value="">
<p>uniquement les notes contenant
<input type=text name=search value="">
<p><input type=submit value="Afficher">
</form>

<p>
<form method=post action=broadcast.php>
Diffuser un message aux membres situ&eacute;s &agrave; une distance inf&eacute;rieure &agrave;
<input type=text name=distance size=30 value=30>
<p>Sujet :
<input type=text name=subject size=60>
<p>Message :
<p>
<textarea name=body rows=10 cols=60>
</textarea>
<p>
<input type=submit value=Envoyer>
</form>
</ul>
 <?php
 }
?>
</body>
</html>

