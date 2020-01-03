<?php
 include 'platform.php';
 include 'util.php';

 connexion();

 $fnick = $_GET['fnick'];
 $url = $_GET['url'];
 $pass = $_GET['pass'];

 $url1 = treat_string ($url);
 $pass1 = treat_string ($pass);

 $q = "INSERT INTO " . $prefix . "incoming (fnick, url, pass) VALUES ('$fnick', '$url1', '$pass1')";
 $s = query ($q);
?>



