CREATE DATABASE bnb_projet2;

USE bnb_projet2;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(45) NOT NULL,
    pass VARCHAR(45) NOT NULL,
    mail VARCHAR(45) NOT NULL,
    status VARCHAR(45));

CREATE TABLE room (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(45) NOT NULL,
    description TEXT NOT NULL,
    pic_path VARCHAR(250) NOT NULL,
    location VARCHAR(45) NOT NULl,
    caracs VARCHAR(45) NOT NULL,
    price FLOAT NOT NULL);

CREATE TABLE booking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    begin_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    nb_person INT NOT NULL,
    options VARCHAR(45) NOT NULL,
    room_id INT,
    FOREIGN KEY (room_id) REFERENCES room(id),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    total_price FLOAT NOT NULL);

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    grade VARCHAR(45) NOT NULL,
    comment TEXT NOT NULL,
    room_id INT,
    FOREIGN KEY (room_id) REFERENCES room(id));


INSERT INTO users (username, pass, mail, status) VALUES ('admin', 'admin', 'admin@mail.fr', 'Administrator');
INSERT INTO users (username, pass, mail, status) VALUES ('tom', 'tom', 'tom@mail.fr', 'User');
INSERT INTO users (username, pass, mail, status) VALUES ('clelia', 'clelia', 'clelia@mail.fr', 'User');
INSERT INTO users (username, pass, mail, status) VALUES ('herve', 'herve', 'herve@mail.fr', 'User');
INSERT INTO users (username, pass, mail, status) VALUES ('quentin', 'quentin', 'quentin@mail.fr', 'User');
INSERT INTO users (username, pass, mail, status) VALUES ('heyliam', 'heyliam', 'heyliam@mail.fr', 'User');

INSERT INTO room (name, description, pic_path, location, caracs, price) VALUES ('USA', 'something', 'usa.png', 'USA', 'dej_repas_separateBed', 0.0);
INSERT INTO room (name, description, pic_path, location, caracs, price) VALUES ('Japon', 'something', 'japan.png', 'Japan', 'dej_separateBed', 0.0);
INSERT INTO room (name, description, pic_path, location, caracs, price) VALUES ('Tailande', 'something', 'thailand.png', 'Thailand', 'dej_repas', 0.0);
INSERT INTO room (name, description, pic_path, location, caracs, price) VALUES ('France', 'something', 'france.png', 'France', 'dej', 0.0);
INSERT INTO room (name, description, pic_path, location, caracs, price) VALUES ('Africa', 'something', 'africa.png', 'Africa', 'dej_repas', 0.0);

INSERT INTO feedback (user_id, grade, comment, room_id) VALUES (2, '4.5/5', 'this is an awesome room', 1);
INSERT INTO feedback (user_id, grade, comment, room_id) VALUES (3, '4.5/5', 'this is an awesome room', 2);
INSERT INTO feedback (user_id, grade, comment, room_id) VALUES (6, '4.5/5', 'this is an awesome room', 3);
INSERT INTO feedback (user_id, grade, comment, room_id) VALUES (4, '4.5/5', 'this is an awesome room', 4);
INSERT INTO feedback (user_id, grade, comment, room_id) VALUES (5, '4.5/5', 'this is an awesome room', 5);

INSERT INTO booking (begin_date, end_date, nb_person, options, room_id, user_id, total_price) VALUES ('2018-12-01', '2018-12-31', 2, 'dej_separateBed', 1, 2, 100.00);
INSERT INTO booking (begin_date, end_date, nb_person, options, room_id, user_id, total_price) VALUES ('2019-01-01', '2019-01-31', 2, 'dej_separateBed', 4, 1, 100.00);
INSERT INTO booking (begin_date, end_date, nb_person, options, room_id, user_id, total_price) VALUES ('2019-03-01', '2019-03-30', 2, 'dej_separateBed', 3, 3, 100.00);
INSERT INTO booking (begin_date, end_date, nb_person, options, room_id, user_id, total_price) VALUES ('2018-07-22', '2019-07-31', 2, 'dej_separateBed', 2, 5, 100.00);
