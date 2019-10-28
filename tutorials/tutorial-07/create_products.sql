create table Product
(
    id                int auto_increment,
    name              varchar(50) not null,
    purchase_price    DECIMAL(8, 2),
    sale_price        DECIMAL(8, 2),
    country_of_origin varchar(40),
    constraint Product_pk
        primary key (id)
);

INSERT INTO Product (id, name, purchase_price, sale_price, country_of_origin)
VALUES (1, 'New Product', 40, 80, 'Australia');
INSERT INTO Product (id, name, purchase_price, sale_price, country_of_origin)
VALUES (2, 'Old Product', 15, 30, 'Indonesia');
INSERT INTO Product (id, name, purchase_price, sale_price, country_of_origin)
VALUES (3, 'Current Product', 20, 50, 'India');
