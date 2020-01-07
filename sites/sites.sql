
CREATE TABLE sites (
   numero integer primary key autoincrement, 
   site varchar(120) NOT NULL,
   texte text NOT NULL,
   motdepasse varchar(30) NOT NULL
);
