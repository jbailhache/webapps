
CREATE TABLE pages (
   numero integer primary key autoincrement, 
   site varchar(120) NOT NULL,
   rubrique varchar(120) NOT NULL,
   position float DEFAULT '0' NOT NULL,
   titre varchar(120) NOT NULL,
   motscles varchar(250) NOT NULL,
   head text,
   attributs text,
   texte text NOT NULL,
   test varchar(120) 
);
