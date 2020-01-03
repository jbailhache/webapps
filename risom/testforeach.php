<?php
 $a = array ( 10 => 'dix', 30 => 'trente', 20 => 'vingt' );
 array_multisort (array_keys($a), $a);
 foreach ($a as $x)
  echo "<p>$x";
?>

