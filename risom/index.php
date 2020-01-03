<html>
<head>
<title>Accueil</title>
</head>
<body>
<p><h3><a href=doc.htm>Documentation</h3>
<p><h3><a href=risom.zip>T&eacute;l&eacute;chargement</a>
<p><h3>Connexion</h3>
<form method=post action=login.php>
<p>Identifiant : 
<input type=text name=nick size=30 value="">
<p>Mot de passe :
<input type=password name=pass size=30 value="">
<p>
<input type=submit value="Connexion">
</form>
<p><h3>Inscription</h3>
<form method=post action=inscription.php>
<p>Identifiant : 
<input type=text name=nick size=30 value="">
<p>(Evitez les accents et les caract&egrave;res sp&eacute;ciaux dans l'identifiant)
<p>Mot de passe :
<input type=text name=pass size=30 value="">
<p>Pr&eacute;sentation
<p>
<textarea name=presentation rows=10 cols=60>
</textarea>
<p>
<input type=submit value="Inscription">
</form>


</body>
</html>
