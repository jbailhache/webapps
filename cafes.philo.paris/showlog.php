<?php
 require('forum/platform.php');
 connexion('.');
 $query = "SELECT * FROM log ORDER BY date DESC";
 $data = query($query);
 echo "<ul>";
 while ($rec = fetch_object($data))
 {
  echo "<li> " . $rec->date . " : " . $rec->ip;
 }
 echo "</ul>";
?>
