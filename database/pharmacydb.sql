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

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    surname VARCHAR(30) NOT NULL,
    company VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(10) NOT NULL UNIQUE,
    location VARCHAR(50) NOT NULL,
    role_id INT NOT NULL,
    joined_on DATETIME DEFAULT CURRENT_TIMESTAMP,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles (id)
);

##insert DEFAULT admin account
INSERT INTO
    users (
        firstname,
        surname,
        company,
        email,
        phone,
        location,
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
        'DAR ES SALAAM',
        1,
        'admin123'
    );

CREATE TABLE medicines(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    quantity INT NOT NULL,
    unit VARCHAR(10) NOT NULL,
    price INT NOT NULL,
    post_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    photo VARCHAR(300) NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES users (id)
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
    phone VARCHAR(10) NOT NULL UNIQUE,
    balance INT NOT NULL,
    pin INT NOT NULL
);

##set sample mpesa accounts
INSERT INTO
    mpesa(phone, balance, pin)
VALUES
    ('0756789045', 1000000, 1234),
    ('0743568908', 500000, 2020),
    ('0767565988', 300000, 9045);