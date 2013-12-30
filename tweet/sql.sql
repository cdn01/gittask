create table reply(
id int primary key auto_increment,
user varchar(255),
pid bigint,
isreply int not null default 0,
gettime datetime,
replytime datetime,
replyer varchar(255)
)default character  set = utf8;