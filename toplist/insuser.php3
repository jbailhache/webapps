<HTML>
<head>
<title>Inscription d'un utilisateur</title>
</head>
<!--body-->

<?php
	include ("look.php3");
	formheader ("Inscription", "enruser.php3");
?>

<!--
<h2>Inscription</h2>
-->

<!--form method="post" action="enruser.php3"-->

<p>
Votre nom :
<input type="text" name="nomuser" value="">

<p>
Choisissez un mot de passe :
<input type="text" name="password" value="">

<p>
Votre adresse email :
<input type="text" name="email" value="">

<p>
URL de votre site web :
<input type="text" name="urlsite" value="http://" size=30>

<p>
<input type="submit" value="Valider">

<?php
	formend ();
?>

<!--/form-->
<!--/body-->
</HTML>
