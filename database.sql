CREATE DATABASE mal_db;

USE mal_db;

CREATE TABLE anime(
    status VARCHAR(20),
    main_picture VARCHAR(200),
    title VARCHAR(100),
    score INT,
    episodes INT
);

CREATE TABLE manga(
    status VARCHAR(20),
    main_picture VARCHAR(200),
    title VARCHAR(100),
    score INT,
    chapters INT,
    volumes INT
);

INSERT INTO manga(status,main_picture,title,score,chapters,volumes)
VALUES ("on_hold","https://cdn.mangaupdates.com/image/i386156.jpg","Switch on",10,52,1)