<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Rendez-vous</title>
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

  $fnick = get_fnick($nick);

  $number = $_GET['number'];
  $q = "SELECT * FROM " . $prefix . "events WHERE number = $number";
  $d = query($q);
  $r = fetch_object($d);

  $number = $_GET['number'];
  $q = "DELETE FROM " . $prefix . "events WHERE number = $number";
  $s = query($q);

?>

<h4>Modifier un rendez-vous</h4>
<form method=post action=sv_evnt.php>
<p>Titre :
<input type=text name=title size=60 value="<?php echo $r->title; ?>">
<p>Nombre maximum de participants :
<input type=text name=np size=5 value="<?php echo $r->np; ?>">
<p>Jour:
<input type=text name=day size=2 value="<?php echo $r->day; ?>">
mois:
<input type=text name=month size=2 value="<?php echo $r->month; ?>">
ann&eacute;e:
<input type=text name=year size=4 value="<?php echo $r->year; ?>">
heure:
<input type=text name=hour size=2 value="<?php echo $r->hour; ?>">
minutes:
<input type=text name=minute size=2 value="<?php echo $r->minute; ?>">
<p>Lieu:
<input type=text name=place size=60 value="<?php echo $r->place; ?>">
<p>Description :
<p>
<textarea name=descr rows=10 cols=60>
<?php echo $r->descr; ?>
</textarea>
<p>
<input type=submit value="Enregistrer"> 
</form>

<?php
 }
?>
</body>
</html>
 
