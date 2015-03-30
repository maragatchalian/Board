CREATE DATABASE IF NOT EXISTS board;
GRANT SELECT, INSERT, UPDATE, DELETE ON board.* TO board_root@localhost IDENTIFIED BY 'board_root';
FLUSH PRIVILEGES;

Use board;
CREATE TABLE IF NOT EXISTS thread (
id                  INT(11) NOT NULL AUTO_INCREMENT,
user_id             INT(11) NOT NULL,
title               VARCHAR(50) NOT NULL,
category            VARCHAR(30) NOT NULL,
created             TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS comment (
id                  INT(11) NOT NULL AUTO_INCREMENT,
thread_id           INT(11) NOT NULL,
user_id             INT(11) NOT NULL,
username            VARCHAR(11) NOT NULL,
body                VARCHAR(140) NOT NULL,
created             TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id),
INDEX (thread_id, created)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS user(
id                  INT(11) NOT NULL AUTO_INCREMENT,
username            VARCHAR(20) NOT NULL,
first_name          VARCHAR(50) NOT NULL,
last_name           VARCHAR(50) NOT NULL,
password            VARCHAR(50) NOT NULL,
email               VARCHAR(50) UNIQUE NOT NULL,
PRIMARY KEY (id)
);  

CREATE TABLE IF NOT EXISTS favorite(
id                  INT(11) NOT NULL AUTO_INCREMENT,
comment_id          INT(11) NOT NULL,
user_id             INT(11) NOT NULL,
comment_body        VARCHAR(140) NOT NULL,
PRIMARY KEY (id)
);  

CREATE TABLE IF NOT EXISTS follow(
id                  INT(11) NOT NULL AUTO_INCREMENT,
user_id             INT(11) NOT NULL,
username            VARCHAR(20) NOT NULL,
PRIMARY KEY (id)
); 

