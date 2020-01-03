<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Enregistrement du profil</title>
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
  if (!connexion())
  {
   echo "<p>Erreur lors de la connexion &agrave; la base de donn&eacute;es";
  }
  else
  {
   $nick = $_SESSION['nick'];
   $pass = $_POST['pass'];
   $presentation = $_POST['presentation'];

   $presentation1 = treat_string ($presentation);
   
   $q = "SELECT * FROM " . $prefix . "members WHERE nick = '$nick'";
   $d = query ($q);
   $r = fetch_object ($d);
   $fnick = $r->fnick;
   $q = "UPDATE " . $prefix . "members  SET pass = '$pass', presentation='$presentation1' WHERE nick = '$nick'";
   if (trace()) echo "<p>$q";
   $s = query ($q);
   if (!$s)
   {
    echo "<p>Erreur dans la mise &agrave; jouir du profil - Requ&ecirc;te:<p>" . $q;
   }
   else
   {
    $q = "SELECT * FROM " . $prefix . "fields WHERE fnick = '$fnick'";
    if (trace()) echo "<p>$q";
    $d = query ($q);
    while ($r = fetch_object($d))
    {
     $fld = $r->field;
     $value = $_POST[$fld];
     if (trace()) echo "<p>fld=($fld) value=($value)";
     $visible = $_POST["v_".$fld];

     $field1 = treat_string($r->field);
     $value1 = treat_string($value);

     if ($value)
     { 
      $q = "UPDATE " . $prefix . "fields SET value = '$value1', visible = '$visible' WHERE fnick = '$fnick' AND field = '$field1'";
     }
     else
     {
      $field1 = treat_string ($r->field);
      $q = "DELETE FROM " . $prefix . "fields WHERE fnick = '$fnick' AND field = '$field1'";
     }
     if (trace()) echo "<p>$q";
     $s = query ($q);
    }

    /* print_r($_POST); */
    $newfield = $_POST['newfield'];
    $newvalue = $_POST['newvalue'];

    $newfield1 = treat_string ($newfield);
    $newvalue1 = treat_string ($newvalue);

    $newv = $_POST['newv'];
    $q = "DELETE FROM " . $prefix . "fields WHERE fnick = '$fnick' AND field = '$newfield1'";
    $s = query ($q);
    if ($newfield)
    {
     $q = "INSERT INTO " . $prefix . "fields (fnick, field, value, visible) VALUES ('$fnick', '$newfield1', '$newvalue1', '$newv')";
     if (trace()) echo "<p>$q";
     $s = query ($q);
    }     
    
    echo "<p>Profil mis à jour";
   }
  }
 }
 echo "<p><a href=menu.php>Retour au menu principal</a>";
?>
</body>
</html>
  
