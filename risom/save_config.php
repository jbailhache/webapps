<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Enregistrement de la configuration RISOM</title>
</head>
<body>
<h2>Enregistrement de la configuration RISOM</h2>

<?php
 $url = $_POST['url'];
 $host = $_POST['host'];
 $user = $_POST['user'];
 $pass = $_POST['pass'];
 $db = $_POST['db'];
 $prefix = $_POST['prefix'];

 $f = fopen ('config.php', 'w');

 if (! $f)
  echo "<p>Erreur lors de l'enregistrement de la configuration";
 else
 {
 fputs ($f, "<?php

 " . '$prefix' . " = '$prefix';

 function get_local_url ()
 {
  return '$url';
 }

 function get_host ()
 {
  return '$host';
 }

 function get_user ()
 {
  return '$user';
 }
 
 function get_pass ()
 {
  return '$pass';
 }

 function get_db ()
 {
  return '$db';
 }


?>
");
 fclose ($f);

 echo "<p>Configuration enregistrée";

 echo "<p>Création des tables...";

 $s = file_get_contents ($url . 'create_tables.php');
 echo $s;
/*
 echo "<p>Tables créées";

 echo "<p>Commencez par remplir le formulaire d'inscription avec pour identifiant webmaster";

 echo "<p><a href=$url>Cliquez ici</a>"; 
*/
 }
?>


