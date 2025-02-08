CREATE TABLE types
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE motorcycles
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(255) NOT NULL,
    type_id      INT,
    discontinued TINYINT(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (type_id) REFERENCES types (id)
);

INSERT INTO types (name)
VALUES ('Sport'),
       ('Cruiser'),
       ('Touring');

INSERT INTO motorcycles (name, type_id, discontinued)
VALUES ('Yamaha YZF-R1', 1, 0),
       ('Honda CBR600RR', 1, 0),
       ('Suzuki GSX-R1000', 1, 0),
       ('Kawasaki Ninja ZX-10R', 1, 1),
       ('Ducati Panigale V4', 1, 0),
       ('Harley-Davidson Softail', 2, 0),
       ('Indian Chief', 2, 0),
       ('Yamaha V Star', 2, 1),
       ('Honda Rebel', 2, 0),
       ('Suzuki Boulevard', 2, 0),
       ('BMW R1200GS', 3, 0),
       ('Triumph Tiger 900', 3, 0),
       ('Honda Gold Wing', 3, 1),
       ('Yamaha FJR1300', 3, 0),
       ('KTM 1290 Super Duke', 1, 0),
       ('Ducati Monster', 1, 0),
       ('Harley-Davidson Street Glide', 2, 0),
       ('Indian Scout', 2, 0),
       ('BMW K1600GT', 3, 0),
       ('Moto Guzzi V7', 3, 1);

