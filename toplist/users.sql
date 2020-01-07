
CREATE TABLE users (
   numero integer primary key autoincrement,
   nomuser varchar(120) NOT NULL,
   password varchar(60) NOT NULL,
   email varchar(60) NOT NULL,
   urlsite varchar(120) NOT NULL
);
