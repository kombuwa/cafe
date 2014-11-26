/* Written on 9/28/2014, cafeDB Create Schema Script */
 
/* Create Database and set MySQL to use it */
CREATE DATABASE cafeceyl_cafeDB;
USE cafeceyl_cafeDB;
 
GRANT ALL PRIVILEGES ON cafeceyl_cafeDB.* TO 'cafeceyl_cafeman'@'localhost' IDENTIFIED BY 'cA123456';
GRANT ALL PRIVILEGES ON cafeceyl_cafeDB.* TO 'cafeceyl_cafeman'@'%' IDENTIFIED BY 'cA123456';
 
/* Create Users Table */
DROP TABLE IF EXISTS users;
CREATE TABLE users
(
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
givenname VARCHAR(50),
surname VARCHAR(50),
username VARCHAR(50),
email VARCHAR(50),
photo VARCHAR(100),
password VARCHAR(100),
password_temp VARCHAR(100),
resetcode VARCHAR(100),
access VARCHAR(50),
active VARCHAR(5),
isdel VARCHAR(5),
last_login TIMESTAMP,
remember_token VARCHAR(75),
created_at TIMESTAMP,
updated_at TIMESTAMP
)engine=innodb;
 
/* Create Admin User */
INSERT INTO users(
id,givenname,surname,username,email,photo,password,password_temp,resetcode,access,
active,isdel,last_login,created_at,updated_at)
VALUES
(NULL,"Isuru Udana","Palihawadana","admin","isuruudana@gmail.com",NULL,"iS123456",NULL,NULL,"admin",
1,0,NULL,NULL,NULL);

/* Create Food Category Table */
DROP TABLE IF EXISTS foodcategory;
CREATE TABLE foodcategory
(
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50),
photo VARCHAR(100),
created_at TIMESTAMP,
updated_at TIMESTAMP
)engine=innodb;

/* Create Soup Food Category */
INSERT INTO foodcategory(
id,name,photo,created_at,updated_at)
VALUES
(NULL,"Soup",NULL,NULL,NULL);

/* Create Food Item Table */
DROP TABLE IF EXISTS fooditem;
CREATE TABLE fooditem
(
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fcid MEDIUMINT,
name VARCHAR(50),
photo VARCHAR(100),
provider VARCHAR(50),
description VARCHAR(255),
price DECIMAL(6,2),
created_at TIMESTAMP,
updated_at TIMESTAMP
)engine=innodb;

/* Create Soup Food Item */
INSERT INTO fooditem(
id,fcid,name,photo,provider,description,price,created_at,updated_at)
VALUES
(NULL,1,"French Onion Soup",NULL,"kitchen","Once you try this classic French Onion Soup recipe, you'll never try another. It culminates in a rich-tasting soup with melt-in-your-mouth onions.",427.70,NULL,NULL);

/* Create Food Ingredient Table */
DROP TABLE IF EXISTS foodingredient;
CREATE TABLE foodingredient
(
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50),
description VARCHAR(255),
measurement VARCHAR(50),
created_at TIMESTAMP,
updated_at TIMESTAMP
)engine=innodb;

/* Create Cooking oil Food Ingredient */
INSERT INTO foodingredient(
id,name,description,measurement,created_at,updated_at)
VALUES
(NULL,"Cooking oil","Vegetable/Sunflower","Litre",NULL,NULL);

/* Create Food Item to Ingredient relationship Table */
DROP TABLE IF EXISTS fooditem_ingredient;
CREATE TABLE fooditem_ingredient
(
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fiid MEDIUMINT,
inid MEDIUMINT,
qty DECIMAL(7,3),
created_at TIMESTAMP,
updated_at TIMESTAMP
)engine=innodb;

/* Create Food Stock Table */
DROP TABLE IF EXISTS foodstock;
CREATE TABLE foodstock 
(
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
inid MEDIUMINT,
isauto VARCHAR(5),
type VARCHAR(5),
cause VARCHAR(255),
qty DECIMAL(7,3),
created_at TIMESTAMP,
updated_at TIMESTAMP
)engine=innodb;

/* Create Orders Table */
DROP TABLE IF EXISTS orders;
CREATE TABLE orders 
(
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
agent VARCHAR(50),
location VARCHAR(50),
description VARCHAR(255),
created_at TIMESTAMP,
updated_at TIMESTAMP
)engine=innodb;

/* Create Order Item Table */
DROP TABLE IF EXISTS orderitem;
CREATE TABLE orderitem 
(
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
orid MEDIUMINT,
fiid MEDIUMINT,
qty TINYINT,
isreq VARCHAR(5),
created_at TIMESTAMP,
updated_at TIMESTAMP
)engine=innodb;

/* Create Order request Table */
DROP TABLE IF EXISTS orderrequest;
CREATE TABLE orderrequest
(
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
orid MEDIUMINT,
location VARCHAR(50),
provider VARCHAR(50),
created_at TIMESTAMP,
updated_at TIMESTAMP
)engine=innodb;

/* Create Order request item Table */
DROP TABLE IF EXISTS orderrequest_item;
CREATE TABLE orderrequest_item
(
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
reid MEDIUMINT,
oiid MEDIUMINT,
fiid MEDIUMINT,
qty TINYINT,
created_at TIMESTAMP,
updated_at TIMESTAMP
)engine=innodb;