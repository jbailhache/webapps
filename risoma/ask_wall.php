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
  $s = connexion();
  $localurl = get_local_url();

  $myfnick = $_GET['myfnick'];
  $myurl = $_GET['myurl'];
  $mypass = $_GET['mypass'];

  $myurl1 = treat_string ($myurl);
  $mypass1 = treat_string ($mypass);

  $q = "SELECT * FROM " . $prefix . "incoming WHERE fnick = '$myfnick' AND url = '$myurl1' AND pass = '$mypass1'";
  $d = query ($q);
  $r = fetch_object ($d);
  if (!$r)
  {
   echo "<p>Identification incorrecte.";
  }
  else
  {

  echo "<p><a href=members.php>Retour aux membres</a> - <a href=menu.php>Retour au menu principal</a>";

  $hisfnick = $_GET['fnick'];
  $name = $_GET['name'];
  $name1 = treat_string ($name);

  $q = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '$hisfnick' AND hisfnick = '$myfnick' AND hisurl = '$myurl1'";
  $d = query ($q);
  $rdr = fetch_object ($d);
  if ($rdr)
  {
   $distrec = $rdr->distance;
  }
  else
  {
   $distrec = 60;
  }

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
<form method=post action=mod_remote_wall.php>
<p><textarea name=content rows=10 cols=60>
<?php echo $r->content; ?>
</textarea>
<input type=hidden name=hisfnick value="<?php echo $hisfnick; ?>">
<input type=hidden name=hisurl value="<?php echo $localurl; ?>">
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


