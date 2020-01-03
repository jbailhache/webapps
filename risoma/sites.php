<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Gestion des sites</title>
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
 else if ($_SESSION['nick'] != 'webmaster')
 {
  head();
  echo "<p>Cette page est r&eacute;serv&eacute;e au webmaster.<p><a href=index.php>Cliquez ici pour vous identifier</a>";
 }
 else 
 {
  head();
  echo "<p><h3>Gestion des sites</h3>";
  echo "<p><h3>Je suis " . $_SESSION['nick'] . "</h3>";
  $nick = $_SESSION['nick'];

  $s = connexion();

?>

<p>Fusionner avec un autre r&eacute;seau :
<br>Indiquez l'URL d'un des sites du r&eacute;seau avec lequel vous voulez fusionner :
<br>Exemple : http://jacquesb.no-ip.org/risom1/
<br>
<form method=post action=fusion.php>
URL: <input type=text name=url size=40 value="">
<input type=submit value="Fusionner">
</form>

<p>Ajouter un site :
<form method=post action=sv_site.php>
URL: <input type=text name=url size=40 value="">
<input type=submit value="Enregistrer">
</form>
<p>
Sites: <ul>
<?php

  $q = "SELECT * FROM " . $prefix . "sites";
  $d = query ($q);
  while ($r = fetch_object ($d))
  {
   echo "<li> " . $r->url . " <a href=del_site.php?number=" . $r->number . ">Supprimer</a>";
  }
 }
?>

</ul>
<p>
</body>
</html>

  


