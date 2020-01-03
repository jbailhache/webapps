<?php
 try {
  $pdo = new PDO('sqlite:cafes_philo_paris.sqlite');
  // $pdo->query("DROP TABLE forums");

  $status = $pdo->query("CREATE TABLE forums (
  numero integer primary key autoincrement,
  forum text  DEFAULT NULL,
  discussion int(11) DEFAULT NULL,
  titre text  DEFAULT NULL,
  reponse int(11) DEFAULT NULL,
  auteur text  DEFAULT NULL,
  ip text DEFAULT NULL,
  date datetime DEFAULT NULL,
  dat datetime DEFAULT NULL,
  statut int(11) DEFAULT NULL,
  texte text  DEFAULT NULL,
  supprimepar text NULL,
  motif text NULL
)");
  if ($status) 
  {
   echo "<p>Table forums creee</p>";
  }
  else
  {
   echo "<p>Erreur creation table<br><pre>";
   print_r($pdo->errorInfo());
  }

  $status = $pdo->query("CREATE TABLE log (
  numero integer primary key autoincrement,
  ip text DEFAULT NULL,
  date datetime DEFAULT NULL
)");
  if ($status) 
  {
   echo "<p>Table log creee</p>";
  }
  else
  {
   echo "<p>Erreur creation table<br><pre>";
   print_r($pdo->errorInfo());
  }


 } catch (Exception $e) { 
  echo "<pre>"; print_r($e); 
 }
?>


