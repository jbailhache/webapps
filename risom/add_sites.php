<?php
 include "platform.php";
 include "util.php";

function random($car) {
$string = "";
$chaine = "abcdefghijklmnpqrstuvwxy";
srand((double)microtime()*1000000);
for($i=0; $i<$car; $i++) {
$string .= $chaine[rand()%strlen($chaine)];
}
return $string;
}

function gen_pass1 ()
{
 $pass = random(32);
 return $pass;
}

 function treat_url ($url)
 {
  global $prefix;

  $url1 = treat_string($url);
  $q1 = "INSERT INTO " . $prefix . "sites (url) VALUES ('$url1')";
  $s1 = query ($q1);

  $q2 = "SELECT * FROM " . $prefix . "members";
  $d2 = query ($q2);
  while ($r2 = fetch_object ($d2))
  {
   $pass = gen_pass ();
   $fnick = $r2->fnick;
   $q3 = "INSERT INTO " . $prefix . "outgoing (fnick, url, pass) VALUES ('$fnick', '$url1', '$pass')";
   $s3 = query ($q3);
   create_remote_account ($fnick, $url, $pass);
  }
 }

 connexion();

 /* echo '(' . gen_pass() . ')'; */

 for ($i=0; ; $i++)
 {
  /*
  echo "<p>";
  echo 'url' . $i;
  echo " ";
  */
  if (!isset ($_GET['url' . $i]))
  {
   break;
  }
  else
  {
   $url = $_GET['url' . $i];
   /* echo $url; */
   treat_url ($url);
  }  
  
 }
?>


