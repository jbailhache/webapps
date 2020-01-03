<html>
<head>
<title>Inscription</title>
</head>
<body>

<?php
 include ("platform.php");
 include ("util.php");
 if (connexion() > 0)
 {
  $nick1 = $_POST['nick'];
  $nick = filter($nick1);
  $pass = $_POST['pass'];
  $presentation = $_POST['presentation'];

  $presentation1 = treat_string($presentation);

  $q = "SELECT * FROM " . $prefix . "members WHERE nick = '$nick' OR fnick = '$nick'";
  /* echo "<p>" . $q; */
  $data = query ($q);
  $rec = fetch_object ($data);
  if ($rec)
  {
   echo "Cet identifiant existe d&eacute;ja.<p><a href=index.php>Cliquez ici pour en choisir un autre</a>";
  }
  else
  {
   $q = "INSERT INTO " . $prefix . "members (fnick, nick, pass, presentation) VALUES ('$nick', '$nick', '$pass', '$presentation1')";
   /* echo "<p>" . $q; */
   $status = query ($q);
   if (!$status)
   {
    echo "<p>Erreur dans l'enregistrement de l'inscription: " . mysql_error() . "<p>Requ&ecirc;te : <p>" . $q;
   }
   else
   {
    echo "<p>Inscription enregistr&eacute;e.<p>Votre identifiant est : $nick<p><a href=index.php>Cliquez ici pour vous connecter</a>";
   }

   $q = "SELECT * FROM " . $prefix . "sites";
   if (trace()) echo "<p>sites: $q";
   $d = query ($q);
   while ($r = fetch_object ($d))
   {
    $url = $r->url;
    $url1=treat_string($url);
    if (trace()) echo "<p>url: $url";
    $pass = gen_pass ();
    $q2 = "INSERT INTO " . $prefix . "outgoing (fnick, url, pass) VALUES ('$nick', '$url1', '$pass')";
    if (trace()) echo "<p>$q2";
    $s2 = query ($q2);
    create_remote_account ($nick, $url, $pass);
   }

  }
 }
?>
</body>
</html>

