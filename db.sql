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

use phpnews;

create table category(
                         cid int auto_increment primary key,
                         cat_name varchar(255) unique
);


create table news(
                     nid int primary key auto_increment,
                     category_id int,
                     foreign key(category_id) references category(cid) on delete restrict on update cascade,
                     posted_by int,
                     foreign key(posted_by) references users(id) on delete restrict on update cascade,
                     title varchar(255),
                     slug varchar(255) unique,
                     image varchar(255) null,
                     summary text,
                     description text,
                     meta_title varchar(2500),
                     meta_description text,
                     page_visite int default 0
);
