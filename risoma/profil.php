<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Profil</title>
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
  if (connexion())
  {
   $q = "SELECT * FROM " . $prefix . "members WHERE nick = '" . $_SESSION['nick'] . "'";
   $d = query($q);
   $r = fetch_object($d);
   $fnick = $r->fnick;
   ?>
<h3>Modifier votre profil</h3>
<form method=post action=svprofil.php>
<p>Identifiant : <?php echo $_SESSION['nick']; ?>
<p>Mot de passe :
<input type=text name=pass value="<?php echo $r->pass; ?>">
<p>Pr&eacute;sentation :
<p> 
<textarea name=presentation rows=10 cols=60>
<?php echo $r->presentation; ?>
</textarea>

<?php
 $q = "SELECT * FROM " . $prefix . "fields WHERE fnick = '$fnick'";
 $d = query ($q);
 while ($r = fetch_object($d))
 {
  echo "<p>" . $r->field . " : " . "<input type=text name=" . $r->field . ' value="' . $r->value . '"> visibilit&eacute; <input type=text size=3  name=v_' . $r->field . " value=" . $r->visible . "> ";
 }
?>
<p>
<input type=text name=newfield value=""> :
<input type=text name=newvalue value="">
visibilit&eacute; 
<input type=text name=newv size=3 value="">
<p>(10=moi, 30=amis, 50=membres inscrits sur le m&ecirc;me site, 70: tous sauf ind&eacute;sirables, 90: tous)
<p><input type=submit value="Enregistrer">
</form>  
<?php
  }
 }
?>
</html>
</head>
