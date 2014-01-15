create table reply( 
pid bigint primary key not null,
user varchar(255),
isreply int not null default 0,
gettime datetime,
replytime datetime,
replyer varchar(255)
)default character  set = utf8;