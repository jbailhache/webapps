
CREATE TABLE afprofil (
   numero integer primary key autoincrement,
   profil varchar(60) NOT NULL,
   pseudo varchar(60) NOT NULL,
   action varchar(30) NOT NULL,
   x tinyint(4) DEFAULT '0' NOT NULL
);
