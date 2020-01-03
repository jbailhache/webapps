<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-15\" />
<title>Echanges</title>
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
  $mynick = $_SESSION['nick'];
  $s = connexion();
  $myfnick = get_fnick($mynick);

  echo "<p><a href=menu.php>Retour au menu principal</a>";
  echo "<p><h3>Echanges</h3>";

  $q = "SELECT * FROM " . $prefix . "members WHERE fnick = '$myfnick'";
  $d = query($q);
  $r = fetch_object($d);
  if (!$r)
  {
   echo "<p>Membre '$myfnick' non trouv&eacute;";
  }
  else
  {
   echo "<p>J'ai fourni " . (0+$r->given ) . " minutes de services";
   echo "<p>J'ai re&ccedil;u " . (0+$r->received) . " minutes de services";
   if ($r->given > $r->received)
   {
    echo "<p>Je dois recevoir " .  ($r->given - $r->received) . " minutes de services pour &ecirc;tre quitte";
   }
   else if ($r->received > $r->given)
   {
    echo "<p>Je dois fournir " . ($r->received - $r->given) . " minutes de services pour &ecirc;tre quitte";
   }
   else
   {
    echo "<p>Je suis quitte.";
   }

?>

<form method=post action=search_offer.php>
<p>Rechercher 
<input type=text name=text value="">
dans les offres 
<input type=submit value="Rechercher">
</form>

<form method=post action=search_need.php>
<p>Rechercher 
<input type=text name=text value="">
dans les demandes 
<input type=submit value="Rechercher">
</form>

<form method=post action=add_offer.php>
<p>Ajouter une offre :
<p><textarea name=descr rows=10 cols=60>
</textarea>
<p><input type=submit value="Enregistrer">
</form>


<form method=post action=add_need.php>
<p>Ajouter une demande :
<p><textarea name=descr rows=10 cols=60>
</textarea>
<p><input type=submit value="Enregistrer">
</form>

<?php

   echo "<p><h4>Mes offres</h4><p><ul>";
   $q = "SELECT * FROM " . $prefix . "offers WHERE fnick = '$myfnick'";
   $d = query($q);
   while ($r=fetch_object($d))
   {
    echo "<li> " . $r->descr . " - <a href=mod_offer.php?number=" . $r->number . ">Modifier</a>";
   }
   echo "</ul>";

  echo "<p><h4>Mes demandes</h4><p><ul>";
   $q = "SELECT * FROM " . $prefix . "needs WHERE fnick = '$myfnick'";
   $d = query($q);
   while ($r=fetch_object($d))
   {
    echo "<li> " . $r->descr . " - <a href=mod_need.php?number=" . $r->number . ">Modifier</a>";
   }
   echo "</ul>";
  }

 }
?>
</body>
</html>
