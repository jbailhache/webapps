<?php
 $cnx = mysql_connect ("mysql3.000webhost.com", "a8681132_res", "reseau240162");
 if (! $cnx)
 {
  echo "<p>Connexion impossible";
 }
 else
 {
  echo "<p>Connect&eacute;";
  $s = mysql_select_db ("a8681132_res");
  if (! $s)
  {
   echo "<p>Impossible d'acc&eacute;der &agrave; la base de donn&eacute;es";
  }
  else
  {
   echo "<p>Base de donn&eacute;es s&eacute;lectionn&eacute;e";
  
   $q = "CREATE TABLE test (champ TEXT)";
   mysql_query ($q);
   
   $q = "INSERT INTO test (champ) VALUES ('azerty')";
   mysql_query ($q);

   $q = "SELECT * FROM test";
   $d = mysql_query ($q);
   $r = mysql_fetch_object ($d);
   echo "<p>" . $r->champ;

  }
 }


?>
   



