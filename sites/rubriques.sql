
CREATE TABLE rubriques (
   numero integer primary key autoincrement, 
   site varchar(120) NOT NULL,
   rubrique varchar(120) NOT NULL,
   position float DEFAULT '0' NOT NULL
);
