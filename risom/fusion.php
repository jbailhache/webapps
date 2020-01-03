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


function ask_sites ($url)
{
 return get_array_url ('SITES', $url . 'ask_sites.php');
}


function add_sites ($url, $sites)
{
/*
 echo "<p>nombre de sites: " . count($sites);
 echo "<p>(" . $sites[0] . ")";
*/
 if (count($sites)>0)
 {
  $url1 = $url . 'add_sites.php?url0=' . $sites[0];
  for ($i=1; $i<count($sites); $i++)
  {
   echo " i=$i ";
   $url1 = $url1 . "&url$i=" . $sites[$i];
  }
  echo "<p>add_sites: " . $url1;
  $s = get_url ($url1); 
 }
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

  $url = $_POST['url'];
  echo "<p>Fusion avec le r&eacute;seau du site " . $url;

  $sites = ask_sites ($url);
  if ($sites == 0)
  {
   echo "<p>Site hors service";
  }
  else
  {

   $sites[] = $url;

   echo "<p>Sites de ce r&eacute;seau : <ul>";
   for ($i=0; $i<count($sites); $i++)
   {
    echo "<li> " . $sites[$i];
   }
   echo "</ul>";
  
   $local_url = get_local_url();
   echo "<p>Site local : " . $local_url;
   
   $mysites = array($local_url); 
   $q = "SELECT * FROM " . $prefix . "sites";
   $d = query ($q);
   echo "<p>Autres sites du r&eacute;seau local :<ul>";
   while ($r = fetch_object ($d))
   {
    echo "<li> " . $r->url;
    $mysites[] = $r->url;
    add_sites ($r->url, $sites); 
   }
   echo "</ul>";

   add_sites ($local_url, $sites); 
   
   echo "<p>count(mysites)=" . count($mysites);

   /* add_sites ($url, $mysites);*/
   for ($i=0; $i<count($sites); $i++)
   {
    add_sites ($sites[$i], $mysites);
   }
  
   echo "<p>Fusion effectu&eacute;e";
  }
 }
?>
<p>
<a href=sites.php>Retour &agrave; la gestion des sites</a> -
<a href=menu.php>Retour au menu principal</a>
</body>
</html>

