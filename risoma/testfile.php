<?php
 $f = fopen ("test.php", "w");
 fputs ($f, "<?php echo '<p>Test'; ?>");
 fclose ($f);
?>

