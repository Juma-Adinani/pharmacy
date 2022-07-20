CREATE DATABASE pharmacydb;

USE pharmacydb;

CREATE TABLE roles(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    PRIMARY KEY (id)
);

#insert default roles
INSERT INTO
    roles (name)
VALUES
    ('admin'),
    ('pharmacy');

CREATE TABLE location(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    location_name VARCHAR(20) NOT NULL
);

INSERT INTO
    location (location_name)
VALUES
    ('MBEZI'),
    ('UBUNGO'),
    ('KIGAMBONI'),
    ('BUGURUNI'),
    ('MAGOMENI'),
    ('POSTA'),
    ('ILALA BOMA'),
    ('KIMARA TEMBONI'),
    ('PUGU KONA'),
    ('GONGO LA MBOTO');

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    surname VARCHAR(30) NOT NULL,
    company VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL UNIQUE,
    location_id INT NOT NULL,
    role_id INT NOT NULL,
    joined_on DATETIME DEFAULT CURRENT_TIMESTAMP,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles (id),
    FOREIGN KEY (location_id) REFERENCES location (id)
);

##insert DEFAULT admin account
INSERT INTO
    users (
        firstname,
        surname,
        company,
        email,
        phone,
        location_id,
        role_id,
        password
    )
VALUES
    (
        'admin',
        'admin',
        'ADMIN PHARMACY',
        'admin@gmail.com',
        '0',
        1,
        1,
        'admin123'
    );

CREATE TABLE units(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    unit VARCHAR(20) NOT NULL
);

INSERT INTO
    units (unit)
VALUES
    ('box'),
    ('packet');

CREATE TABLE medicines(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    quantity INT NOT NULL,
    unit_id INT NOT NULL,
    price INT NOT NULL,
    post_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    expire_date DATE,
    photo VARCHAR(300) NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (unit_id) REFERENCES units (id)
);

CREATE TABLE orders(
    id INT NOT NULL AUTO_INCREMENT,
    medicine_id INT NOT NULL,
    ordered_quantity INT NOT NULL,
    amount INT NOT NULL,
    phoneNumber VARCHAR(10) NOT NULL,
    user_id INT NOT NULL,
    paid_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE mpesa(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    balance INT NOT NULL,
    pin INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE
);