<?php

 include ("platform.php");

 function head()
 {
  echo "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-15\" />
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

?>

<h4>Cr&eacute;er un rendez-vous</h4>
<form method=post action=sv_evnt.php>
<p>Titre :
<input type=text name=title size=60 value="">
<p>Nombre maximum de participants :
<input type=text name=np size=5 value="">
<p><input type=radio name=period value=0>Rendez-vous unique :
<p>Jour:
<input type=text name=day size=2 value="">
mois:
<input type=text name=month size=2 value="">
ann&eacute;e:
<input type=text name=year size=4 value="">
<p><input type=radio name=period value=1> Rendez-vous p&eacute;riodique :
<input type=text name=nth size=3> i&egrave;me
<select name=dayofweek>
<?php
 $jours = array ('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
 for ($j=0; $j<7; $j++)
  echo '<option value=' . $j . '>' . $jours[$j] . '</option>\n'; 
?>
</select>
 du mois
<p> (indiquer 0 i&egrave;me pour les rendez-vous hebdomadaire)
<p>
heure:
<input type=text name=hour size=2 value="">
minutes:
<input type=text name=minute size=2 value="">
<p>Lieu:
<input type=text name=place size=60 value="">
<p>Visibilit&eacute;:
<input type=text name=visible size=30 value="70">
(10=moi, 30=amis, 50=membres inscrits sur le m&ecirc;me site, 70: tous sauf ind&eacute;sirables, 90: tous) 
<p>Description :
<p>
<textarea name=descr rows=10 cols=60>
</textarea>
<p>
<input type=submit value="Enregistrer"> 
</form>

<?php
 }
?>
</body>
</html>
 
