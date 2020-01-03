<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Configuration site RISOM</title>
</head>
<body>
<h2>Configuration site RISOM</h2>
<p>
<form method=post action=save_config.php>
<p> URL du site : <input type=text name=url value="http://" size=40>
<p> Hôte MySQL : <input type=text name=host size=40>
<p> Utilisateur MySQL : <input type=text name=user>
<p> Mot de passe MySQL : <input type=text name=pass>
<p> Nom de la base de données MySQL : <input type=text name=db>
<p> Préfixe des noms des tables : <input type=text name=prefix value="risom_">
<p> <input type=submit value="Enregistrer">
</form>
<p> L'URL du site est le nom complet de votre site avec le nom du répertoire dans lequel vous devrez copier les fichiers PHP de la distribution RISOM, terminé par / (exemple : http://www.nomdemonsite.fr/risom/ )
<p> L'hôte, l'utilisateur, le mot de passe et le nome de la base de données MySQL vous sont normalement fournis par votre hébergeur web et doivent être indiqués dans les champs correspondant.
<p> Il est possible de créer plusieurs sites RISOM sur un même site web en copiant les fichiers PHP de la distribution RISOM dans plusieurs répertoires (URL du site) et en indiquant des préfixes des noms de tables différents. Dans ce cas la configuration devra être effectuée pour chaque site RISOM. Exemple :
<ul>
<li> Site 1 :
<ul>
<li> URL du site : http://www.nomdemonsite.fr/risom1/
<li> Préfixe des noms des tables : risom1_
</ul>
<li> Site 2 :
<ul>
<li> URL du site : http://www.nomdemonsite.fr/risom2/
<li> Préfixe des noms des tables : risom2_
</ul>
</ul>
Dans l'exemple ci-dessus les fichiers php de la distribution RISOM devront être copiés à la fois dans les répertoires risom1 et risom2.

</body>
</html>


