CREATE DATABASE mitiendita;
USE mitiendita;

CREATE TABLE products(
    idProduct INT AUTO_INCREMENT,
    name VARCHAR(120) NOT NULL,
    price DECIMAL(7,2) NOT NULL,
    status INT NOT NULL,

    CONSTRAINT pk_products_idProduct PRIMARY KEY(idProduct)
);