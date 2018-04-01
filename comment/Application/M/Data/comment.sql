DROP DATABASE IF EXISTS comment;
create database if not exists comment default character set utf8;
use comment;
create table db_user(
  user_id int auto_increment primary key,
  user_name varchar(20) not null,
  user_password varchar(20) not null,
  user_email varchar(30) not null
);
create table db_admin(
  admin_id int auto_increment primary key,
  admin_name varchar(20) not null,
  admin_password varchar(20) not null,
  admin_email varchar(30) not null
  
);
create table db_usercomment(
  item_id int auto_increment primary key,
  item_name varchar(50) not null,
  item_content varchar(5000) not null,
  item_date date not null,
  user_id int not null
  user_ip varchar(255)
);
create table db_reply(
  reply_id int auto_increment primary key,
  item_id int not null,
  replyer_tag int not null,
  replyer_id int not null,
  reply_content varchar(5000) not null,
  reply_date date not null
);
insert db_admin value(1,"Cutey333","123456","1320046636@qq.com");


