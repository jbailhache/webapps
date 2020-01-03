<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-15\" />
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

?>

<form method=post action="create_group.php">
<p><h4>Cr&eacute;er un groupe</h4>
<p>Nom :
<input type=text name=name value="">
<p>Description :
<p>
<textarea name=desc rows=10 cols=60>
</textarea>
<p><input type=submit value="Cr&eacute;er le groupe">
</form>

<?php

  echo "<p><h3>Groupes locaux :</h3>";
  $q = "SELECT * FROM " . $prefix . "groups";
  if (trace()) { echo $q; }
  $d = query ($q);
  echo "<ul>";
  while ($r = fetch_object($d))
  {
   $q1 = "SELECT * FROM " . $prefix . "groups_members WHERE groupname = '" . treat_string ( $r->name ) . "' AND fnick = '$fnick'";
   if (trace()) { echo $q1; }
   $d1 = query($q1);
   $r1 = fetch_object($d1);
   echo "<li> <a href=group.php?name=" . $r->name . ">" . $r->name . "</a>";
   if ($r1)
   {
    echo " membre";
   }
  }
  echo "</ul>"; 

  $qs = "SELECT * FROM " . $prefix . "sites";
  $ds = query ($qs);
  while ($rs = fetch_object ($ds))
  {
    $a = get_array_url ('GROUPS', $rs->url . "ask_groups.php");
    if (trace()) { echo "<p>count=" . count($a); }
    
    echo "<p><h3>Groupes sur " . $rs->url . " :</h3><ul>";
    for ($i=0; $i<count($a); $i++)
    {
     $g = $a[$i];
     if (trace()) { echo "<p>g=$g"; }
     echo "<li> <a href=group.php?url=" . $rs->url . "&name=$g>$g</a>";
    }
    echo "</ul>"; 
  }
 }
?>
</body>
</html>

