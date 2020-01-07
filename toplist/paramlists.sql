
CREATE TABLE paramlists (
   numero integer primary key autoincrement,
   nomlist varchar(120) NOT NULL,
   nomuser varchar(120) NOT NULL,
   urllogo varchar(120) NOT NULL,
   largeurlogo int(11) DEFAULT '0' NOT NULL,
   hauteurlogo int(11) DEFAULT '0' NOT NULL,
   urlbanniere varchar(120) NOT NULL,
   largeurbanniere int(11) DEFAULT '0' NOT NULL,
   hauteurbanniere int(11) DEFAULT '0' NOT NULL,
   couleurfond varchar(30) NOT NULL,
   couleurtexte varchar(30) NOT NULL,
   tailletexte int(11) DEFAULT '0' NOT NULL,
   fonte varchar(60) NOT NULL,
   ext tinyint(4) DEFAULT '0' NOT NULL,
   urlsite varchar(120) NOT NULL,
   couleurlien varchar(30) NOT NULL,
   couleurlienact varchar(30),
   couleurlienvis varchar(30) NOT NULL
);
