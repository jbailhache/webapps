
CREATE TABLE toplist (
   numero integer primary key autoincrement,
   position int(11) DEFAULT '0' NOT NULL,
   nom varchar(120) NOT NULL,
   email varchar(60) NOT NULL,
   password varchar(60) NOT NULL,
   nomsite varchar(120) ,
   urlsite varchar(120) NOT NULL,
   urlbanniere varchar(120) NOT NULL,
   largeurbanniere int(11) DEFAULT '0' NOT NULL,
   hauteurbanniere int(11) DEFAULT '0' NOT NULL,
   urllogo varchar(120) ,
   largeurlogo int(11) DEFAULT '0' NOT NULL,
   hauteurlogo int(11) DEFAULT '0' NOT NULL,
   description text NOT NULL,
   couleurfond varchar(20) NOT NULL,
   couleurtexte varchar(20) NOT NULL,
   tailletexte varchar(4) NOT NULL,
   fonte varchar(60) NOT NULL,
   remarques varchar(120) ,
   ext int(11) DEFAULT '0' NOT NULL,
   entrees int(11) DEFAULT '0' NOT NULL,
   sorties int(11) DEFAULT '0' NOT NULL,
   nomlist varchar(60) NOT NULL,
   titre varchar(120) NOT NULL
);
