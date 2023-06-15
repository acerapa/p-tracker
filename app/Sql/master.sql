CREATE DATABASE 'p_tracker_db';

USE 'p_tracker_db';

/* drop table user if exist */
DROP TABLE IF EXISTS users;

/* create table */
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
    username VARCHAR(255) NOT NULL UNIQUE COMMENT 'unique username',
    first_name VARCHAR(255) NOT NULL COMMENT 'user first name',
    last_name VARCHAR(255) NOT NULL COMMENT 'user last name',
    email VARCHAR(255) NOT NULL UNIQUE COMMENT 'unique user email',
    password VARCHAR(255) NOT NULL COMMENT 'password',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'current timestamp upon record create',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'current timestamp upon record create',
    deleted_at TIMEsTAMP NULL COMMENT 'used if the user decided to soft delete',

    -- primary key
    PRIMARY KEY (id)
)
