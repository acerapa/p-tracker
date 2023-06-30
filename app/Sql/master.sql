CREATE DATABASE 'p_tracker_db';

USE 'p_tracker_db';

/* drop table user if exist */
DROP TABLE IF EXISTS users;

/* create table */
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
    username VARCHAR(255) NOT NULL UNIQUE COMMENT 'unique username',
    first_name VARCHAR(255) NULL COMMENT 'user first name',
    last_name VARCHAR(255) NULL COMMENT 'user last name',
    email VARCHAR(255) NOT NULL UNIQUE COMMENT 'unique user email',
    password VARCHAR(255) NOT NULL COMMENT 'password',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'current timestamp upon record create',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'current timestamp upon record create',
    deleted_at TIMEsTAMP NULL COMMENT 'used if the user decided to soft delete',

    -- primary key
    PRIMARY KEY (id)
)


/* drop table todos if exist */
DROP TABLE IF EXISTS todos;

/* create table */
CREATE TABLE todos (
    id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
    user_id INT(11) NOT NULL COMMENT 'foreign key to user table',
    title VARCHAR(255) NOT NULL COMMENT 'todo title',
    description VARCHAR(255) NOT NULL COMMENT 'todo description',
    status VARCHAR(255) NOT NULL COMMENT 'todo status',
    date_to_fullfill DATE DEFAULT NULL COMMENT 'date to fullfill the todo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'current timestamp upon record create',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'current timestamp upon record create',
    deleted_at TIMEsTAMP NULL COMMENT 'used if the user decided to soft delete',

    -- foreign key
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
)