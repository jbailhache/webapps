<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Murs</title>
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
  $myfnick = get_fnick ($mynick);

  echo "<p><a href=members.php>Retour aux membres</a> - <a href=menu.php>Retour au menu principal</a>";

  $hisfnick = $_GET['fnick'];
  $name = $_GET['name'];

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

  $name1 = treat_string ($name);
  $q = "SELECT * FROM " . $prefix . "walls WHERE fnick = '$hisfnick' AND name = '$name1'";
  $d = query ($q);
  $r = fetch_object ($d);
  if ($r)
  {
   /* if ($r->visible >= $distrec) */
   if (is_visible ($r->visible, $distrec))
   {
    echo "<p><h4>Mur $name de $hisfnick</h4>";

    /* if ($r->modifiable >= $distrec) */
    if (is_visible ($r->modifiable, $distrec))
    {
   ?>
<form method=post action=mod_wall.php>
<p><textarea name=content rows=10 cols=60>
<?php echo $r->content; ?>
</textarea>
<input type=hidden name=hisfnick value="<?php echo $hisfnick; ?>">
<input type=hidden name=name value="<?php echo $name; ?>">
<p><input type=submit value=Modifier>
</form>
<?php
    }
    else
    {
     echo "<p>" . $r->content;
    }

   }
  }


 }
?>
</body>
</html>

