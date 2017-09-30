create database videoPlayer;
use videoPlayer;
create table user(UID int auto_increment not null, username char(30) not null, password char(30) not null, bio varchar(500), picFile char(40), primary key(uid));
create table pm(toID int not null, fromID int not null, t timestamp not null, message varchar(500), primary key(fromID, toID));

create table video(VID int auto_increment not null, title char(50) not null, tags char(100), descr varchar(500), viewCount int, likes int, dislikes int, primary key(VID));
create table videoMeta(VID int not null, url varchar(500), thumb char(100), primary key(VID, url));

create table history(UID int not null, VID int not null, primary key(UID,VID));
create table upload(UID int not null, VID int not null, primary key(UID, VID));
create table comments(UID int not null, VID int not null, contents varchar(300) not null, frame Time, primary key(UID,VID));

insert into user (`username`, `password`, `bio`, `picFile`) values("jcina", "badpass123", "I love cats", "jcina.jpeg");
insert into user (`username`, `password`, `bio`, `picFile`) values ("stevejobs", "turtleneckpower", "I love dogs.", "stevejobs.png");
insert into video (`title`,`tags`,`descr`,`viewCount`,`likes`, `dislikes`) values ("How to move up in the world", "technology", "Subscribe!", 1000000, 757, 83);
insert into videoMeta(`url`,`thumb`)values("video/macbook.mp4", "thumbnails/macbook.png");
insert into history values(1, 1);
insert into comments(`UID`,`VID`,`contents`) values (2,1, "Share this with your frainds");
insert into upload values(2,1);



