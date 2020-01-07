<?php
	header('Content-Type: text/html; charset=ISO-8859-15');
	include("platform.php");
?>
<HTML>
<head>
<title>Inscription</title>
</head>
<body>
<h2>Inscription d'un site sur la toplist</h2>

<form method="post" action="enreg.php3">

<input type=hidden name=nomlist value=<?php echo($nomlist); ?>>

Votre nom :
<input type="text" name="nom" value="">

<p>
Mot de passe :
<input type="text" name="password" value="">

<p>
Adresse email :
<input type="text" name="email" value="">

<p>
Titre du site :
<input type="text" name="titre" value="">

<p>
URL du site :
<input type="text" name="urlsite" value="http://">

<!--
<p>
Logo du site : 
URL  
<input type="text" name="urllogo" value="http://">
largeur 
<input type="text" name="largeurlogo" value="">
hauteur
<input type="text" name="hauteurlogo" value="">
-->

<p>
Bannière publicitaire :
URL
<input type="text" name="urlbanniere" value="http://">
largeur
<input type="text" name="largeurbanniere" value="468">
hauteur
<input type="text" name="hauteurbanniere" value="60">

<!--
<p>
Couleur du fond :
<input type="text" name="couleurfond" value="white">
<p>
Couleur du texte :
<input type="text" name="couleurtexte" value="black">
<p>
Taille du texte :
<input type="text" name="tailletexte" value="3">
<p>
Fonte :
<input type="text" name="fonte" value="Arial">
-->

<p>
Description du site :<br>
<textarea name="description" rows=6 cols=40>
</textarea>

<p>

<input type="submit" value="Valider">
</form>
</body>
</HTML>


 
