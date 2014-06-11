CREATE TABLE names(id SERIAL PRIMARY KEY, name varchar(9), position int);
CREATE TABLE date(id SERIAL PRIMARY KEY, next_date varchar(10), hour int, min int);
CREATE TABLE admins(id SERIAL PRIMARY KEY, username varchar(20), password varchar(32), manager boolean);
INSERT INTO date(next_date,hour,min) values ('01.07.2014',12,0);
INSERT INTO admins(username,password,manager) values ('admin','eaf988f6700d58463d41efabb43cf263',TRUE);
INSERT INTO names (name,position) values ('Ayush', 1);