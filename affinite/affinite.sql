
CREATE TABLE affinite (
   numero integer primary key autoincrement,
   type char(1) NOT NULL,
   but varchar(60) NOT NULL,
   nom varchar(60) NOT NULL,
   pseudo varchar(60) NOT NULL,
   categorie varchar(60) NOT NULL,
   caractere varchar(60) NOT NULL,
   valeur float DEFAULT '0' NOT NULL,
   action varchar(30) NOT NULL,
   profil varchar(60) NOT NULL,
   reponse varchar(60) NOT NULL
);
