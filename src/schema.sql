CREATE TABLE names(id SERIAL PRIMARY KEY, name varchar(9), position int);
CREATE TABLE date(id SERIAL PRIMARY KEY, next_date varchar(10), hour int, min int);
CREATE TABLE admins(id SERIAL PRIMARY KEY, username varchar(20), password varchar(32));
INSERT INTO date(next_date,hour,min) values ('01.01.2015',12,0);
INSERT INTO admins(username,password) values ('admin','eaf988f6700d58463d41efabb43cf263');
INSERT INTO names (name,position) values ('Ayush', 1);