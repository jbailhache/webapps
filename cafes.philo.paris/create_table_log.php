<?php
 try {
  $pdo = new PDO('sqlite:db/cafes_philo_paris.sqlite');
  $pdo->query("DROP TABLE forums");
  $status = $pdo->query("CREATE TABLE log (
  numero integer primary key autoincrement,
  ip text DEFAULT NULL,
  date datetime DEFAULT NULL
)");
  if ($status) 
  {
   echo "<p>Table creee</p>";
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
