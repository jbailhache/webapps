
CREATE TABLE afcateg (
   numero integer primary key autoincrement,
   categorie varchar(60) NOT NULL,
   x1 tinyint(4) DEFAULT '0' NOT NULL,
   position double DEFAULT '0' NOT NULL
);
