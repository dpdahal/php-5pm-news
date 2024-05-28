CREATE DATABASE phpnews;


CREATE TABLE users(
id int AUTO_INCREMENT PRIMARY KEY,
name varchar(100),
email varchar(100) UNIQUE,
password varchar(100),
gender ENUM("male","female"),
role set ("admin","user") DEFAULT "user",
image varchar(100) null,
created_at datetime,
updated_at datetime

);

