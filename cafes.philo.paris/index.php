<html>
<head>
<title>Caf&eacute;s philo de Paris</title>
</head>
<body>

<?php
 require('forum/platform.php');
 require('forum/util.php');
 connexion('.');
 query("INSERT INTO LOG (date, ip) VALUES (datetime('now'), '" . ip() . "')");
?>

<img src="fond_index.jpg" width="100%">

<div style="position:absolute;top:200px; width:100%; height:400px; z-index:2">
<center><font color="blue">
<p><h2>Caf&eacute;s philo de Paris</h2></p>
<p></p>
<p><a href="agenda.php"><h3>Agenda</h3></a></p>
<p></p>
<p><a href="forum/forum.php"><h3>Forum</h3></a></p>
<p></p>
<p><a href="liens.html"><h3>Liens</h3></a></p>
</font></center>
</div>

<p>Contact : <a href="mailto:jacques.bailhache@gmail.com">jacques.bailhache@gmail.com</a></p>

</body>
</html>
