
CREATE TABLE afinscr (
   numero integer primary key autoincrement,
   pseudo varchar(30) NOT NULL,
   prenom varchar(30) NOT NULL,
   nom varchar(40) NOT NULL,
   adresse varchar(60) NOT NULL,
   telephone varchar(60) NOT NULL,
   email varchar(60) NOT NULL,
   web varchar(60) NOT NULL,
   photo varchar(60) NOT NULL,
   x1 tinyint(4) DEFAULT '0' NOT NULL,
   x2 tinyint(4) DEFAULT '0' NOT NULL,
   x3 tinyint(4) DEFAULT '0' NOT NULL,
   x4 tinyint(4) DEFAULT '0' NOT NULL,
   autre varchar(250) NOT NULL,
   motdepasse varchar(30) NOT NULL
);
