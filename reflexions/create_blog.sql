CREATE TABLE blog (
  numero int(11) NOT NULL auto_increment,
  date int(11) NOT NULL default '0',
  titre text NOT NULL,
  reponsea int(11) NOT NULL default '0',
  modifde int(11) NOT NULL default '0',
  motscles text NOT NULL,
  auteur text NOT NULL,
  motdepasse text NOT NULL,
  visible int(11) NOT NULL default '0',
  texte text NOT NULL,
  UNIQUE KEY numero (numero)
) TYPE=MyISAM;

