<html>
<body>

<?php
 include ('platform.php');
 connexion();


 query ('CREATE TABLE IF NOT EXISTS `' . $prefix . 'blog` (
  `numero` int(11) NOT NULL AUTO_INCREMENT,
  `fnick` text NOT NULL,
  `date` int(11) NOT NULL,
  `forum` text NOT NULL,
  `motcle` text NOT NULL,
  `motscles` text NOT NULL,
  `titre` text NOT NULL,
  `reponsea` int(11) NOT NULL,
  `modifde` int(11) NOT NULL,
  `auteur` text NOT NULL,
  `motdepasse` text NOT NULL,
  `visible` int(11) NOT NULL,
  `texte` text NOT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24');

 query ('CREATE TABLE IF NOT EXISTS `' . $prefix . 'motscles` (
  `numero` int(11) NOT NULL AUTO_INCREMENT,
  `fnick` text NOT NULL,
  `motcle` text NOT NULL,
  `motscles` text NOT NULL,
  `titre` text NOT NULL,
  `reponsea` int(11) NOT NULL,
  `auteur` text NOT NULL,
  `motdepasse` text NOT NULL,
  `texte` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1');



?>

</body>
</html>
