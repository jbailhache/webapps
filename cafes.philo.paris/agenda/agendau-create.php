<html>
<body>
<?php

  require("platform.php");

  connexion();

  echo ("<p>Base de donn&eacute;es ouverte");
  // query ('DROP TABLE agendau');
  query ('CREATE TABLE agendau (numero INTEGER PRIMARY KEY AUTOINCREMENT, code TEXT,  descr TEXT, annee INTEGER, mois INTEGER, jdm INTEGER, compl INTEGER, annul INTEGER)');
  echo ("<p>Table cr&eacute;&eacute;e");

?>
</body>
</html>
