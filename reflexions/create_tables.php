<html>
<body>
<?php
  header("Content-Type: text/html; charset=ISO-8859-15");
  require("platform.php");
  connexion();

  echo ("<p>Base de données ouverte");
  
  query ('CREATE TABLE blog (numero INTEGER PRIMARY KEY AUTOINCREMENT, forum TEXT, date INTEGER, titre TEXT, reponsea INTEGER, modifde INTEGER, motscles TEXT, auteur TEXT, motdepasse TEXT, visible INTEGER, texte TEXT)');
  query ('INSERT INTO blog(forum) VALUES(\'\')');
  echo ("<p>Table blog créée");

  query ('CREATE TABLE motscles (numero INTEGER PRIMARY KEY AUTOINCREMENT, motcle TEXT, motscles TEXT, titre TEXT, reponsea INTEGER, auteur TEXT, motdepasse TEXT, texte TEXT, date INTEGER)');
  echo ("<p>Table motscles créée");

?>
</body>
</html>
