USE eStore;

DROP TABLE IF EXISTS 'USER';
DROP TABLE IF EXISTS 'CHAT_LOG';
DROP TABLE IF EXISTS 'MESSAGE';
DROP TABLE IF EXISTS 'CATEGORY';
DROP TABLE IF EXISTS 'MOTORCYCLE';
DROP TABLE IF EXISTS 'ORDER';
DROP TABLE IF EXISTS 'ORDER_ITEM';

CREATE TABLE USER (
    /* PK */
    id int AUTO_INCREMENT PRIMARY KEY,

    /* ATTRIBUTES */
    username VARCHAR(32) NOT NULL,
    password VARCHAR(32) NOT NULL,
    email VARCHAR(32) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_role ENUM('Admin', 'Assistant', 'Customer') 
);

CREATE TABLE CHAT_LOG(
    /* PK */
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,

    /* FK */
    customer_id REFERENCES USER(id),
    assistant_id REFERENCES USER(id)
);

CREATE TABLE MESSAGE(
    /* PK */
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,

    /* ATTRIBUTES */
    content TEXT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    /* FK */
    sender_id REFERENCES USER(id),
    chat_id REFERENCES CHAT_LOG(id)
);

CREATE TABLE CATEGORY(
    /* PK */
    id int AUTO_INCREMENT PRIMARY KEY,

    /* ATTRIBUTES */
    name ENUM('Sport Bike', 'Touring', 'Motocross', 'Scooter', 'Naked', 'Cruiser')
);

CREATE TABLE MOTORCYCLE (
    /* PK */
    id int AUTO_INCREMENT NOT NULL PRIMARY KEY,

    /* ATTRIBUTES */
    bike_brand VARCHAR(32) NOT NULL,
    bike_type VARCHAR(32) NOT NULL,
    bike_year int NOT NULL,
    in_stock_ammount int NOT NULL, 
    price int NOT NULL,

    /* FK */
    FOREIGN KEY (bike_category) REFERENCES CATEGORY(id)
);

CREATE TABLE ORDER(
    /* PK */
    id int AUTO_INCREMENT NOT NULL PRIMARY KEY,

    /* ATTRIBUTES */
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    /* FK */
    FOREIGN KEY (user_id) REFERENCES USER(id)
);

CREATE TABLE ORDER_ITEM(
    /* PK */
    id int AUTO_INCREMENT PRIMARY KEY,

    /* FK */
    FOREIGN KEY (bike_id) REFERENCES MOTORCYCLE(id),
    FOREIGN KEY (order_id) REFERENCES ORDER(id)
);