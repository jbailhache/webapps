<HTML>
<head>
<title>Enregistrement du but</title>
</head>
<body>
<?php
 include ("util.php");
 if (connexion() > 0)
 {
  $query = "INSERT INTO afbut (but) VALUES ('$but')";
  $r = mysql_query ($query);
  if (!$r)
   echo ("Requ�te $query incorrecte");
  else
   echo ("But $but enregistr�");
 }
 echo ("<p><a href=affinite.php?action=$action>Retour</a>");
?>
<p>
</body>
</HTML>
