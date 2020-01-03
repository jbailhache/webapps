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

  $fnick = get_fnick($nick);

  $name = $_GET['name'];
  $name1 = treat_string ($name);
  $q = "SELECT * FROM " . $prefix . "groups WHERE name = '$name1'";
  $d = query($q);
  $r = fetch_object($d);

  $q = "DELETE FROM " . $prefix . "groups WHERE name = '$name1'";
  echo $q;
  $s = query($q);

?>

<form method=post action="create_group.php">
<p><h4>Modifier un groupe</h4>
<p>Nom :
<?php echo $r->name; ?>
<!-- to do : name with special characters -->
<input type=hidden name=name value="<?php echo $r->name; ?>">
<p>Description :
<p>
<textarea name=desc rows=10 cols=60>
<?php echo $r->descr; ?>
</textarea>
<p><input type=submit value="Enregistrer">
</form>

<?php
 }
?>

</body>
</html>
